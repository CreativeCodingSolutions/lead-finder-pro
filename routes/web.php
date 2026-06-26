<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LeadController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\LeadVerificationController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DemoController;
use App\Http\Controllers\GuestScoreController;
use App\Http\Controllers\StripeController;
use App\Http\Controllers\BlogController;

/*
|--------------------------------------------------------------------------
| Public Routes
|--------------------------------------------------------------------------
*/
Route::get('/', [HomeController::class, 'index'])->name('home');

// Demo — public search demo (no login required)
Route::get('/demo', [DemoController::class, 'index'])->name('demo.index');
Route::post('/demo/search', [DemoController::class, 'search'])->name('demo.search');

// Guest Score — public lead analysis (no login required)
Route::get('/guest-score', [GuestScoreController::class, 'index'])->name('guest.score.index');
Route::post('/guest-score/analyze', [GuestScoreController::class, 'analyze'])->name('guest.score.analyze');
Route::get('/guest-score/{uuid}', [GuestScoreController::class, 'show'])->name('guest.score.show');
Route::post('/guest-score/{uuid}/capture', [GuestScoreController::class, 'captureEmail'])->name('guest.score.capture');

// Lead Email Verification (Double-Opt-In DSGVO)
Route::get('/lead/verify', [LeadVerificationController::class, 'show'])->name('lead.verification.notice');
Route::get('/lead/verify/{id}/{hash}', [LeadVerificationController::class, 'verify'])->name('lead.verification.verify')->middleware('signed');
Route::post('/lead/resend', [LeadVerificationController::class, 'resend'])->name('lead.verification.resend');

// Legal Pages
Route::get('/impressum', function () { return view('legal.impressum'); })->name('legal.impressum');
Route::get('/datenschutz', function () { return view('legal.datenschutz'); })->name('legal.datenschutz');
Route::get('/agb', function () { return view('legal.agb'); })->name('legal.agb');

// Blog Routes
Route::get('/blog', [BlogController::class, 'index'])->name('blog.index');
Route::get('/blog/{slug}', [BlogController::class, 'show'])->name('blog.show');

Route::middleware('guest')->group(function () {
    Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [LoginController::class, 'login']);
    Route::get('/register', [RegisterController::class, 'showRegisterForm'])->name('register');
    Route::post('/register', [RegisterController::class, 'register']);

    // Password Reset
    Route::get('/password/reset', function () { return redirect('/forgot-password', 301); });
    Route::get('/forgot-password', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
    Route::post('/forgot-password', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');
    Route::get('/reset-password/{token}', [ForgotPasswordController::class, 'showResetForm'])->name('password.reset');
    Route::post('/reset-password', [ForgotPasswordController::class, 'reset'])->name('password.update');
});

/*
|--------------------------------------------------------------------------
| Protected Routes (Auth Required)
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->group(function () {
    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

    // Profile
    Route::get('/profile', [ProfileController::class, 'show'])->name('profile.show');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::patch('/profile/password', [ProfileController::class, 'updatePassword'])->name('profile.password');

    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Search
    Route::get('/search', [SearchController::class, 'create'])->name('search.create');
    Route::post('/search', [SearchController::class, 'store'])->name('search.store');
    Route::get('/search/{search}/results', [SearchController::class, 'results'])->name('search.results');
    Route::delete('/search/{search}', [SearchController::class, 'destroy'])->name('search.destroy');

    // Leads
    Route::get('/leads', [LeadController::class, 'index'])->name('leads.index');
    Route::get('/leads/export', [LeadController::class, 'export'])->name('leads.export');
    Route::post('/leads/{lead}/validate', [LeadController::class, 'validateWebsite'])->name('leads.validate');
    Route::patch('/leads/{lead}/status', [LeadController::class, 'updateStatus'])->name('leads.status');
    Route::post('/leads/validate-all', [LeadController::class, 'validateAll'])->name('leads.validate-all');
    Route::delete('/leads/{lead}', [LeadController::class, 'destroy'])->name('leads.destroy');

    // Stripe Checkout
    Route::post('/checkout', [StripeController::class, 'checkout'])->name('checkout');
    Route::get('/checkout/success', [StripeController::class, 'success'])->name('checkout.success');
    Route::get('/checkout/cancel', [StripeController::class, 'cancel'])->name('checkout.cancel');
    Route::post('/subscription/cancel', [StripeController::class, 'subscriptionCancel'])->name('subscription.cancel');
});

// Stripe Webhook (no CSRF, no session)
Route::post('/webhook/stripe', [StripeController::class, 'webhook'])->name('webhook.stripe');

// Feature Modules (auto-loaded)
$modules = glob(base_path('app/Modules/*/routes.php'));
foreach ($modules as $routes) {
    $moduleName = basename(dirname($routes));
    $envKey = 'FEATURE_' . strtoupper($moduleName);
    $isEnabled = env($envKey, false) || config('modules.' . strtolower($moduleName), false);
    if ($isEnabled) {
        require $routes;
    }
}

// Public Pricing Page — MUST be after module loading so it takes precedence
Route::get('/pricing', function () { return view('pricing'); })->name('pricing');

// Sitemap
require base_path('routes/sitemap.php');
