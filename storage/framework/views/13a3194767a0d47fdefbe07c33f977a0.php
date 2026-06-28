<?php $__env->startSection('title', 'Datenschutzerklärung | LeadFinder Pro'); ?>
<?php $__env->startSection('meta_description', 'Datenschutzerklärung von LeadFinder Pro — Informationen zum Umgang mit personenbezogenen Daten. DSGVO-konform.'); ?>
<?php $__env->startSection('meta_keywords', 'Datenschutz, DSGVO, LeadFinder Pro, Datenschutzerklärung'); ?>
<?php $__env->startSection('canonical', 'https://leadfinderpro.creativecoding.cloud/datenschutz'); ?>
<?php $__env->startSection('meta_robots', 'noindex, follow'); ?>

<?php $__env->startSection('content'); ?>
<div class="max-w-4xl mx-auto px-4 py-16">
    <h1 class="text-3xl font-bold mb-8">Datenschutzerklärung</h1>
    
    <div class="prose prose-gray max-w-none space-y-6">
        <h2 class="text-xl font-semibold mt-8 mb-4">1. Verantwortlicher</h2>
        <p>
            <?php echo e(env('COMPANY_OWNER', 'Karsten Brauner')); ?>, <?php echo e(env('COMPANY_NAME', 'CreativeCoding Solutions eG')); ?>, <?php echo e(env('COMPANY_STREET', 'Musterstraße 123')); ?>, <?php echo e(env('COMPANY_ZIP', '1010 Wien')); ?>, <?php echo e(env('COMPANY_COUNTRY', 'Österreich')); ?><br>
            E-Mail: <?php echo e(env('COMPANY_EMAIL', 'info@creativecoding.cloud')); ?>

        </p>

        <h2 class="text-xl font-semibold mt-8 mb-4">2. Erhebung und Speicherung personenbezogener Daten</h2>
        <p>Folgende Daten werden erhoben:</p>
        <ul class="list-disc pl-6 space-y-1">
            <li>Name und E-Mail-Adresse (Registrierung)</li>
            <li>Suchanfragen und Ergebnisse</li>
            <li>Nutzungsdaten (Logfiles, IP-Adresse)</li>
        </ul>

        <h2 class="text-xl font-semibold mt-8 mb-4">2.1 Speicherdauer</h2>
        <p>
            Personenbezogene Daten werden nur so lange aufbewahrt, wie es für die Erfüllung der Zwecke erforderlich ist.
            Konkrete Aufbewahrungsfristen:
        </p>
        <ul class="list-disc pl-6 space-y-1">
            <li><strong>Registrierungsdaten:</strong> Bis zum Widerruf bzw. Löschung des Kontos, spätestens 3 Jahre nach letzter Aktivität.</li>
            <li><strong>Suchanfragen:</strong> 90 Tage nach der jeweiligen Suche, danach automatische Löschung.</li>
            <li><strong>Logfiles (IP-Adressen):</strong> 14 Tage, danach werden IP-Adressen anonymisiert oder gelöscht.</li>
            <li><strong>Cookie-Consent-Einstellungen:</strong> 12 Monate, danach wird erneut abgefragt.</li>
        </ul>
        <p>
            Nach Ablauf der Aufbewahrungsfristen werden die Daten automatisch gelöscht, sofern keine gesetzlichen Aufbewahrungspflichten
            (z.B. steuerrechtliche Aufbewahrung von 7 Jahren für Buchungsdaten) entgegenstehen.
        </p>

        <h2 class="text-xl font-semibold mt-8 mb-4">3. Zweck der Datenverarbeitung</h2>
        <p>
            Die Daten werden ausschließlich für die Bereitstellung des Lead-Generation-Diensts verwendet.
        </p>

        <h2 class="text-xl font-semibold mt-8 mb-4">4. Rechtsgrundlage</h2>
        <p>
            Art. 6 Abs. 1 lit. b und f DSGVO.
        </p>

        <h2 class="text-xl font-semibold mt-8 mb-4">5. Ihre Rechte</h2>
        <p>
            Auskunft, Berichtigung, Löschung, Einschränkung, Übertragbarkeit, Widerspruch.<br>
            Kontakt: info@creativecoding.cloud
        </p>

        <h2 class="text-xl font-semibold mt-8 mb-4">6. Hosting</h2>
        <p>
            Hostinger International Ltd. — keine Weitergabe an Dritte.
        </p>

        <h2 class="text-xl font-semibold mt-8 mb-4">7. Online-Streitbeilegung (ODR)</h2>
        <p>
            Die Europäische Kommission stellt eine Plattform zur Online-Streitbeilegung (ODR) bereit:<br>
            <a href="https://ec.europa.eu/consumers/odr" target="_blank" rel="noopener noreferrer" class="text-blue-600 underline">https://ec.europa.eu/consumers/odr</a>
        </p>

        <p class="text-sm text-gray-400 mt-8">Stand: Juni 2026</p>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /opt/data/founder/apps/lead-finder-pro/resources/views/legal/datenschutz.blade.php ENDPATH**/ ?>