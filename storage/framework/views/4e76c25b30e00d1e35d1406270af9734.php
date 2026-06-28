<?php $__env->startSection('title', 'Preise — LeadFinderPro | Kostenlos, Pro €49, Business €99'); ?>
<?php $__env->startSection('meta_description', 'Transparente Preise für LeadFinderPro. Jetzt testen mit 3 Suchläufe/Monat. Pro ab €49/Monat, Business ab €99/Monat. Keine versteckten Kosten, monatlich kündbar.'); ?>
<?php $__env->startSection('meta_keywords', 'Lead Generation preise, B2B Leads Abo, LeadFinderPro Pro, LeadFinderPro Business, DACH'); ?>
<?php $__env->startSection('canonical', 'https://leadfinderpro.creativecoding.cloud/pricing'); ?>

<?php $__env->startSection('og_tags'); ?>
<meta property="og:title" content="Preise — LeadFinderPro | Kostenlos, Pro €49, Business €99">
<meta property="og:description" content="Transparente Preise für LeadFinderPro. Jetzt testen, Pro ab €49/Monat. Keine versteckten Kosten.">
<meta property="og:type" content="website">
<meta property="og:url" content="https://leadfinderpro.creativecoding.cloud/pricing">
<?php $__env->stopSection(); ?>

<?php $__env->startSection('breadcrumbs'); ?>
<script type="application/ld+json">
{
    "@context": "https://schema.org",
    "@type": "BreadcrumbList",
    "itemListElement": [
        {
            "@type": "ListItem",
            "position": 1,
            "name": "Startseite",
            "item": "https://leadfinderpro.creativecoding.cloud/"
        },
        {
            "@type": "ListItem",
            "position": 2,
            "name": "Preise",
            "item": "https://leadfinderpro.creativecoding.cloud/pricing"
        }
    ]
}
</script>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('schema'); ?>
<script type="application/ld+json">
{
    "@context": "https://schema.org",
    "@type": "Product",
    "name": "LeadFinderPro",
    "description": "Lead-Generierung für Marketing-Agenturen und Vertriebsteams. Finden Sie Branchen-Leads aus OpenStreetMap.",
    "image": "https://leadfinderpro.creativecoding.cloud/og-image.png",
    "brand": {
        "@type": "Brand",
        "name": "LeadFinderPro"
    },
    "offers": [
        {
            "@type": "Offer",
            "name": "Free",
            "price": "0",
            "priceCurrency": "EUR",
            "description": "3 Suchläufe pro Monat, bis 50 Ergebnisse, CSV-Export",
            "availability": "https://schema.org/InStock"
        },
        {
            "@type": "Offer",
            "name": "Pro",
            "price": "49",
            "priceCurrency": "EUR",
            "description": "Unbegrenzte Suchen, bis 500 Ergebnisse, CSV + API Export",
            "availability": "https://schema.org/InStock"
        },
        {
            "@type": "Offer",
            "name": "Business",
            "price": "99",
            "priceCurrency": "EUR",
            "description": "Unbegrenzte Ergebnisse, White-Label Export, API-Zugang, Prioritäts-Support",
            "availability": "https://schema.org/InStock"
        }
    ]
}
</script>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<div class="container mx-auto px-4 py-12">
    <div class="text-center mb-12">
        <h1 class="text-4xl font-bold text-gray-900 mb-4">Einfache, transparente Preise</h1>
        <p class="text-xl text-gray-600">Jetzt testen. 7 Tage Pro kostenlos testen.</p>
    </div>

    <div class="grid md:grid-cols-3 gap-8 max-w-5xl mx-auto">
        <!-- Free Plan -->
        <div class="bg-white rounded-2xl shadow-lg p-8 border-2 border-gray-200">
            <h2 class="text-2xl font-bold text-gray-800 mb-2">Free</h2>
            <div class="text-4xl font-bold text-gray-900 mb-1">€0</div>
            <p class="text-gray-500 mb-6">für immer</p>
            <ul class="space-y-3 mb-8">
                <li class="flex items-center text-gray-600">
                    <svg class="w-5 h-5 text-green-500 mr-2" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/></svg>
                    3 Suchläufe pro Monat
                </li>
                <li class="flex items-center text-gray-600">
                    <svg class="w-5 h-5 text-green-500 mr-2" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/></svg>
                    50 Leads pro Suche
                </li>
                <li class="flex items-center text-gray-600">
                    <svg class="w-5 h-5 text-green-500 mr-2" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/></svg>
                    CSV Export
                </li>
            </ul>
            <a href="<?php echo e(route('register')); ?>" class="block text-center w-full py-3 px-6 rounded-xl border-2 border-gray-300 text-gray-700 font-semibold hover:bg-gray-50 transition">
                Jetzt testen
            </a>
        </div>

        <!-- Pro Plan -->
        <div class="bg-white rounded-2xl shadow-xl p-8 border-2 border-indigo-500 relative transform md:-translate-y-4">
            <div class="absolute -top-4 left-1/2 -translate-x-1/2 bg-indigo-500 text-white text-sm font-bold px-4 py-1 rounded-full">
                7 Tage kostenlos
            </div>
            <h2 class="text-2xl font-bold text-gray-800 mb-2">Pro</h2>
            <div class="text-4xl font-bold text-indigo-600 mb-1">€49</div>
            <p class="text-gray-500 mb-6">/Monat <span class="text-xs text-indigo-500 font-medium">nach 7-Tage-Test</span></p>
            <ul class="space-y-3 mb-8">
                <li class="flex items-center text-gray-600">
                    <svg class="w-5 h-5 text-green-500 mr-2" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/></svg>
                    Unbegrenzte Suchen
                </li>
                <li class="flex items-center text-gray-600">
                    <svg class="w-5 h-5 text-green-500 mr-2" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/></svg>
                    500 Leads pro Suche
                </li>
                <li class="flex items-center text-gray-600">
                    <svg class="w-5 h-5 text-green-500 mr-2" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/></svg>
                    CSV + API Export
                </li>
                <li class="flex items-center text-gray-600">
                    <svg class="w-5 h-5 text-green-500 mr-2" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/></svg>
                    Website-Validierung
                </li>
            </ul>
            <form action="<?php echo e(route('checkout')); ?>" method="POST">
                <?php echo csrf_field(); ?>
                <input type="hidden" name="plan" value="pro">
                <button type="submit" class="block text-center w-full py-3 px-6 rounded-xl bg-indigo-600 text-white font-semibold hover:bg-indigo-700 transition">
                    7 Tage kostenlos testen
                </button>
            </form>
        </div>

        <!-- Business Plan -->
        <div class="bg-white rounded-2xl shadow-lg p-8 border-2 border-gray-200">
            <h2 class="text-2xl font-bold text-gray-800 mb-2">Business</h2>
            <div class="text-4xl font-bold text-gray-900 mb-1">€99</div>
            <p class="text-gray-500 mb-6">/Monat</p>
            <ul class="space-y-3 mb-8">
                <li class="flex items-center text-gray-600">
                    <svg class="w-5 h-5 text-green-500 mr-2" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/></svg>
                    Alles in Pro
                </li>
                <li class="flex items-center text-gray-600">
                    <svg class="w-5 h-5 text-green-500 mr-2" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/></svg>
                    Unbegrenzte Ergebnisse
                </li>
                <li class="flex items-center text-gray-600">
                    <svg class="w-5 h-5 text-green-500 mr-2" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/></svg>
                    White-Label Export
                </li>
                <li class="flex items-center text-gray-600">
                    <svg class="w-5 h-5 text-green-500 mr-2" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/></svg>
                    API-Zugang
                </li>
                <li class="flex items-center text-gray-600">
                    <svg class="w-5 h-5 text-green-500 mr-2" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/></svg>
                    Prioritäts-Support
                </li>
            </ul>
            <form action="<?php echo e(route('checkout')); ?>" method="POST">
                <?php echo csrf_field(); ?>
                <input type="hidden" name="plan" value="business">
                <button type="submit" class="block text-center w-full py-3 px-6 rounded-xl border-2 border-gray-300 text-gray-700 font-semibold hover:bg-gray-50 transition">
                    7 Tage kostenlos testen
                </button>
            </form>
        </div>
    </div>

    <div class="text-center mt-12 text-gray-500 text-sm">
        Alle Preise in Euro, zzgl. MwSt. Jederzeit kündbar. Keine versteckten Kosten.
    </div>

    <!-- FAQ -->
    <div class="max-w-2xl mx-auto mt-16">
        <h2 class="text-2xl font-bold text-center mb-8">Häufige Fragen</h2>
        <div class="space-y-4">
            <?php $faqs = [
                ['Was kostet die 7-Tage-Testphase?', 'Nichts. Du bekommst 7 Tage lang vollen Zugang zu Pro — kostenlos und ohne verpflichtung. Wenn du nicht kündigst, wird nach 7 Tagen automatisch das bezahlte Abo aktiviert.'],
                ['Woher kommen die Daten?', 'Aus OpenStreetMap (OSM), der freien Weltkarte. Die Daten werden von Freiwilligen gepflegt und sind frei verfügbar.'],
                ['Sind die Daten immer aktuell?', 'OpenStreetMap wird täglich aktualisiert. Wir können nicht garantieren, dass jede Telefonnummer oder E-Mail noch stimmt.'],
                ['Kann ich die Leads in mein CRM importieren?', 'Ja, als CSV-Datei kompatibel mit HubSpot, Salesforce, Pipedrive und anderen.'],
                ['Ist das DSGVO-konform?', 'Wir verarbeiten nur öffentlich verfügbare Daten. Für die Nutzung im Marketing sind Sie selbst verantwortlich.'],
            ]; ?>
            <?php $__currentLoopData = $faqs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $faq): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="bg-white rounded-lg border p-5">
                <h3 class="font-semibold mb-2"><?php echo e($faq[0]); ?></h3>
                <p class="text-sm text-gray-600"><?php echo e($faq[1]); ?></p>
            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /opt/data/founder/apps/lead-finder-pro/resources/views/pricing.blade.php ENDPATH**/ ?>