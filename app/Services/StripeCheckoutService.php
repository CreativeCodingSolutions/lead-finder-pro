<?php

namespace App\Services;

use App\Models\User;
use Stripe\StripeClient;
use Stripe\Checkout\Session as CheckoutSession;
use Stripe\Webhook;
use Stripe\Event;
use Illuminate\Support\Facades\Log;

class StripeCheckoutService
{
    protected StripeClient $stripe;

    public function __construct()
    {
        $this->stripe = new StripeClient(config('stripe.secret'));
    }

    /**
     * Create a Stripe Checkout Session for a subscription.
     */
    public function createCheckoutSession(User $user, string $plan): CheckoutSession
    {
        $priceId = $plan === 'business'
            ? config('stripe.price_business')
            : config('stripe.price_pro');

        return $this->stripe->checkout->sessions->create([
            'customer_email' => $user->email,
            'line_items' => [[
                'price' => $priceId,
                'quantity' => 1,
            ]],
            'mode' => 'subscription',
            'success_url' => route('checkout.success') . '?session_id={CHECKOUT_SESSION_ID}',
            'cancel_url' => route('checkout.cancel'),
            'metadata' => [
                'user_id' => $user->id,
                'plan' => $plan,
            ],
        ]);
    }

    /**
     * Handle successful checkout.
     */
    public function handleSuccess(string $sessionId): void
    {
        $session = $this->stripe->checkout->sessions->retrieve($sessionId, [
            'expand' => ['subscription'],
        ]);

        $user = User::findOrFail($session->metadata->user_id);
        $subscription = $session->subscription;

        $user->update([
            'stripe_id' => $subscription->customer ?? null,
            'plan' => $session->metadata->plan ?? 'pro',
            'plan_expires_at' => now()->addMonth(),
            'reports_limit' => ($session->metadata->plan ?? null) === 'business' ? 999999 : 50,
        ]);
    }

    /**
     * Handle Stripe webhook events.
     */
    public function handleWebhook(string $payload, string $sigHeader): Event
    {
        return Webhook::constructEvent(
            $payload,
            $sigHeader,
            config('stripe.webhook_secret')
        );
    }

    /**
     * Cancel a user's subscription.
     */
    public function cancelSubscription(User $user): void
    {
        if (!$user->stripe_id) {
            return;
        }

        $subscriptions = $this->stripe->subscriptions->all([
            'customer' => $user->stripe_id,
            'status' => 'active',
        ]);

        foreach ($subscriptions->data as $subscription) {
            $this->stripe->subscriptions->cancel($subscription->id);
        }

        $user->update([
            'plan' => 'free',
            'plan_expires_at' => null,
            'reports_limit' => 3,
        ]);
    }

    /**
     * Handle subscription updated webhook.
     */
    public function handleSubscriptionUpdated(\Stripe\Subscription $subscription): void
    {
        $user = User::where('stripe_id', $subscription->customer)->first();
        if (!$user) {
            return;
        }

        if ($subscription->status === 'active') {
            $plan = $subscription->metadata->plan ?? 'pro';
            $user->update([
                'plan' => $plan,
                'plan_expires_at' => now()->addMonth(),
                'reports_limit' => $plan === 'business' ? 999999 : 50,
            ]);
        } elseif (in_array($subscription->status, ['canceled', 'unpaid', 'past_due'])) {
            $user->update([
                'plan' => 'free',
                'reports_limit' => 3,
            ]);
        }
    }
}
