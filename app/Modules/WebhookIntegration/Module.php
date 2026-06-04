<?php
namespace App\Modules\WebhookIntegration;
class Module {
    public static function getName(): string { return 'Webhook Integration'; }
    public static function getDescription(): string { return 'Zapier/Make.com Webhook-Events für neue Leads, Exporte und Statusänderungen'; }
    public static function getVersion(): string { return '1.0.0'; }
    public static function isEnabled(): bool { return env('FEATURE_WEBHOOK_INTEGRATION', false); }
    public static function getIcon(): string { return 'fa-solid fa-bolt'; }
    public static function getPriority(): int { return 65; }
}
