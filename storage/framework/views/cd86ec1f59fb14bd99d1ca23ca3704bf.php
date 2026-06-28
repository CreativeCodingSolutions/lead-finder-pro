<?php $__env->startSection('title', 'AGB | LeadFinder Pro'); ?>
<?php $__env->startSection('meta_description', 'Allgemeine Geschäftsbedingungen von LeadFinder Pro — Nutzungsbedingungen für die Lead-Generierung.'); ?>
<?php $__env->startSection('meta_keywords', 'AGB, Nutzungsbedingungen, LeadFinder Pro, Lead Generation'); ?>
<?php $__env->startSection('canonical', 'https://leadfinderpro.creativecoding.cloud/agb'); ?>
<?php $__env->startSection('meta_robots', 'noindex, follow'); ?>

<?php $__env->startSection('content'); ?>
<div class="max-w-4xl mx-auto px-4 py-16">
    <h1 class="text-3xl font-bold mb-8">Allgemeine Geschäftsbedingungen</h1>
    
    <div class="prose prose-gray max-w-none space-y-6">
        <h2 class="text-xl font-semibold mt-8 mb-4">1. Geltungsbereich</h2>
        <p>
            Diese AGB gelten für die Nutzung von "LeadFinder Pro", bereitgestellt von
            <?php echo e(env('COMPANY_NAME', 'CreativeCoding Solutions eG')); ?>, <?php echo e(env('COMPANY_STREET', 'Musterstraße 123')); ?>, <?php echo e(env('COMPANY_ZIP', '1010 Wien')); ?>, <?php echo e(env('COMPANY_COUNTRY', 'Österreich')); ?>.
        </p>

        <h2 class="text-xl font-semibold mt-8 mb-4">2. Vertragsgegenstand</h2>
        <p>
            LeadFinder Pro ist ein B2B Lead-Generation-Dienst, der Daten aus OpenStreetMap extrahiert.
        </p>

        <h2 class="text-xl font-semibold mt-8 mb-4">3. Registrierung</h2>
        <p>
            Nutzer müssen sich registrieren und wahrheitsgemäße Angaben machen.
        </p>

        <h2 class="text-xl font-semibold mt-8 mb-4">4. Preise und Zahlung</h2>
        <p>
            Preise siehe Preise-Seite. Zahlung via Stripe. Preise können sich ändern.
        </p>

        <h2 class="text-xl font-semibold mt-8 mb-4">5. Widerrufsrecht</h2>
        <p>
            Verbraucher haben das Recht, binnen vierzehn Tagen ab Vertragsschluss den Vertrag zu widerrufen,
            ohne Angabe von Gründen. Um das Widerrufsrecht auszuüben, müssen Sie uns (<?php echo e(env('COMPANY_NAME', 'CreativeCoding Solutions eG')); ?>,
            <?php echo e(env('COMPANY_STREET', 'Musterstraße 123')); ?>, <?php echo e(env('COMPANY_ZIP', '1010 Wien')); ?>,
            E-Mail: <?php echo e(env('COMPANY_EMAIL', 'info@creativecoding.cloud')); ?>) mittels einer eindeutigen Erklärung
            über Ihre Entscheidung, diesen Vertrag zu widerrufen, informieren.
            Das Widerrufsformular auf der EU-Website kann dafür genutzt werden:
            <a href="https://ec.europa.eu/consumers/odr/" target="_blank" rel="noopener">https://ec.europa.eu/consumers/odr/</a>.
        </p>
        <p class="mt-2">
            Das Widerrufsrecht erlischt vorzeitig, wenn wir unsere Dienstleistung vollständig erbracht haben
            und mit der Ausführung erst begonnen haben, nachdem Sie Ihrer Zustimmung ausdrücklich zugestimmt
            und zur Kenntnis genommen haben, dass Sie Ihr Widerrufsrecht bei vollständiger Vertragserfüllung verlieren.
        </p>

        <h2 class="text-xl font-semibold mt-8 mb-4">6. Kündigung</h2>
        <p>
            Jederzeit kündbar über die Kontoeinstellungen.
        </p>

        <h2 class="text-xl font-semibold mt-8 mb-4">7. Haftung</h2>
        <p>
            Keine Garantie für Datenrichtigkeit. Haftung beschränkt auf Vorsatz und grobe Fahrlässigkeit.
        </p>

        <h2 class="text-xl font-semibold mt-8 mb-4">8. Datennutzung</h2>
        <p>
            Die generierten Leads dürfen nur im Rahmen geltender Datenschutzgesetze verwendet werden.
            Der Nutzer ist selbst verantwortlich für die Einhaltung der DSGVO.
        </p>

        <h2 class="text-xl font-semibold mt-8 mb-4">9. Anwendbares Recht</h2>
        <p>
            Österreichisches Recht. Gerichtsstand: Wien.
        </p>

        <h2 class="text-xl font-semibold mt-8 mb-4">10. Kontakt</h2>
        <p>
            <?php echo e(env('COMPANY_NAME', 'CreativeCoding Solutions eG')); ?><br>
            <?php echo e(env('COMPANY_OWNER', 'Karsten Brauner')); ?><br>
            <?php echo e(env('COMPANY_STREET', 'Musterstraße 123')); ?>, <?php echo e(env('COMPANY_ZIP', '1010 Wien')); ?><br>
            E-Mail: <?php echo e(env('COMPANY_EMAIL', 'info@creativecoding.cloud')); ?>

        </p>

        <p class="text-sm text-gray-400 mt-8">Stand: Juni 2026</p>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /opt/data/founder/apps/lead-finder-pro/resources/views/legal/agb.blade.php ENDPATH**/ ?>