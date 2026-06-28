<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LeadFinderPro — Kostenlose Lead-Analyse</title>
    <meta name="description" content="Testen Sie LeadFinderPro kostenlos. Branche + Ort eingeben und sofort sehen, wie viele qualifizierte Leads verfügbar sind. Keine Anmeldung nötig.">
    <meta name="robots" content="index, follow">
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-white text-gray-800 font-sans">

    <!-- Nav -->
    <nav class="border-b border-gray-200">
        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 flex justify-between h-14 items-center">
            <a href="/" class="flex items-center gap-2">
                <span class="text-lg font-semibold text-gray-900">LeadFinderPro</span>
            </a>
            <div class="flex items-center gap-6 text-sm">
                <a href="/guest-score" class="text-gray-600 hover:text-gray-900 font-medium">Lead-Analyse</a>
                <a href="/pricing" class="text-gray-600 hover:text-gray-900">Preise</a>
                <a href="/login" class="text-gray-600 hover:text-gray-900">Login</a>
                <a href="/register" class="bg-gray-900 text-white px-4 py-2 rounded hover:bg-gray-800 text-sm">Jetzt testen</a>
            </div>
        </div>
    </nav>

    <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
        <div class="text-center mb-10">
            <h1 class="text-3xl sm:text-4xl font-bold text-gray-900 mb-4">
                Wie viele Leads gibt es für Ihre Branche?
            </h1>
            <p class="text-lg text-gray-600 max-w-xl mx-auto">
                Wählen Sie Branche und Ort. Sie sehen sofort eine kostenlose Analyse — wie viele potenzielle Kunden in Ihrer Region wartet.
            </p>
        </div>

        <!-- Search Form -->
        <div class="bg-gray-50 border border-gray-200 rounded-lg p-6 mb-8">
            <form action="<?php echo e(route('guest.score.analyze')); ?>" method="POST">
                <?php echo csrf_field(); ?>
                <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Branche</label>
                        <select name="industry_id" required class="w-full px-3 py-2.5 border border-gray-300 rounded text-sm focus:outline-none focus:border-gray-500 bg-white">
                            <option value="">Branche wählen...</option>
                            <?php $__currentLoopData = $industries; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ind): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($ind->id); ?>"><?php echo e($ind->name); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Stadt</label>
                        <input type="text" name="city" required placeholder="z.B. München"
                               class="w-full px-3 py-2.5 border border-gray-300 rounded text-sm focus:outline-none focus:border-gray-500">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Land</label>
                        <select name="country" required class="w-full px-3 py-2.5 border border-gray-300 rounded text-sm focus:outline-none focus:border-gray-500 bg-white">
                            <option value="DE">Deutschland</option>
                            <option value="AT">Österreich</option>
                            <option value="CH">Schweiz</option>
                        </select>
                    </div>
                </div>
                <button type="submit" class="mt-4 w-full bg-gray-900 text-white px-6 py-2.5 rounded text-sm font-medium hover:bg-gray-800 transition">
                    Kostenlose Analyse starten
                </button>
            </form>
        </div>

        <!-- Trust Signals -->
        <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 text-center text-sm text-gray-500">
            <div class="p-4">
                <p class="font-medium text-gray-700">OpenStreetMap-Daten</p>
                <p>Verlässliche Quelle für Geschäftseinrichtungen</p>
            </div>
            <div class="p-4">
                <p class="font-medium text-gray-700">DSGVO-konform</p>
                <p>Double-Opt-In, keine Weitergabe an Dritte</p>
            </div>
            <div class="p-4">
                <p class="font-medium text-gray-700">Keine Kreditkarte</p>
                <p>Kostenlose Analyse ohne Verpflichtung</p>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="border-t border-gray-200 py-8 mt-12">
        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
                <p class="text-sm text-gray-500">© <?php echo e(date('Y')); ?> LeadFinderPro. Ein Projekt von CreativeCodingSolutions.</p>
                <div class="flex gap-6 text-sm text-gray-500">
                    <a href="/datenschutz" class="hover:text-gray-900">Datenschutz</a>
                    <a href="/impressum" class="hover:text-gray-900">Impressum</a>
                    <a href="/agb" class="hover:text-gray-900">AGB</a>
                </div>
            </div>
        </div>
    </footer>
</body>
</html>
<?php /**PATH /opt/data/founder/apps/lead-finder-pro/resources/views/guest/index.blade.php ENDPATH**/ ?>