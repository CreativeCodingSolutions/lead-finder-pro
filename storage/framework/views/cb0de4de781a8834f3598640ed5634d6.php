<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lead-Analyse Ergebnis — LeadFinderPro</title>
    <meta name="robots" content="noindex, nofollow">
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
                <a href="#preise" class="text-gray-600 hover:text-gray-900">Preise</a>
                <a href="/login" class="text-gray-600 hover:text-gray-900">Login</a>
            </div>
        </div>
    </nav>

    <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 py-12">

        <!-- Success Banner -->
        <?php if(session('success')): ?>
        <div class="bg-green-50 border border-green-200 text-green-800 rounded-lg p-4 mb-8 text-sm text-center">
            <?php echo e(session('success')); ?>

        </div>
        <?php endif; ?>

        <!-- Score Header -->
        <div class="text-center mb-10">
            <p class="text-sm text-gray-500 mb-2">Lead-Analyse für</p>
            <h1 class="text-2xl font-bold text-gray-900 mb-2"><?php echo e($guestScore->industry_name); ?> in <?php echo e($guestScore->city); ?>, <?php echo e($guestScore->country); ?></h1>
            <p class="text-gray-600 mb-6">Datum: <?php echo e($guestScore->created_at->format('d.m.Y H:i')); ?></p>

            <!-- Score Circle -->
            <div class="inline-flex items-center justify-center w-32 h-32 rounded-full border-8 mb-4
                <?php if($guestScore->score >= 80): ?> border-green-500 text-green-600
                <?php elseif($guestScore->score >= 50): ?> border-yellow-500 text-yellow-600
                <?php else: ?> border-red-500 text-red-600 <?php endif; ?>">
                <span class="text-4xl font-bold"><?php echo e($guestScore->score); ?></span>
            </div>
            <p class="text-gray-600">
                Datenqualitäts-Score
            </p>
        </div>

        <!-- Lead Count Highlight -->
        <div class="bg-indigo-50 border border-indigo-200 rounded-lg p-6 mb-8 text-center">
            <p class="text-sm text-gray-600 mb-1">Gefundene potenzielle Leads (Sample)</p>
            <p class="text-4xl font-bold text-indigo-700"><?php echo e($guestScore->lead_count); ?></p>
            <p class="text-sm text-gray-500 mt-2">Beispiel-Leads in Ihrer Region</p>
        </div>

        <!-- Sample Leads Preview -->
        <div class="mb-8">
            <h2 class="text-lg font-semibold text-gray-900 mb-4">Beispiel-Leads aus Ihrer Region</h2>
            <div class="border border-gray-200 rounded-lg overflow-hidden">
                <table class="w-full text-sm">
                    <thead class="bg-gray-50 border-b border-gray-200">
                        <tr>
                            <th class="text-left px-4 py-3 font-medium text-gray-700">Name</th>
                            <th class="text-left px-4 py-3 font-medium text-gray-700">Adresse</th>
                            <th class="text-left px-4 py-3 font-medium text-gray-700">Daten</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        <?php $__currentLoopData = $guestScore->sample_leads; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $lead): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr class="hover:bg-gray-50">
                            <td class="px-4 py-3">
                                <span class="font-medium text-gray-900"><?php echo e($lead['name']); ?></span>
                                <br><span class="text-xs text-gray-500"><?php echo e($lead['industry']); ?></span>
                            </td>
                            <td class="px-4 py-3 text-gray-600">
                                <?php echo e($lead['address']); ?><br>
                                <?php echo e($lead['postal_code']); ?> <?php echo e($lead['city']); ?>

                            </td>
                            <td class="px-4 py-3">
                                <?php if($lead['has_website']): ?>
                                    <span class="inline-flex items-center gap-1 text-green-600 text-xs">
                                        <span class="w-2 h-2 bg-green-500 rounded-full"></span> Website
                                    </span>
                                <?php else: ?>
                                    <span class="inline-flex items-center gap-1 text-gray-400 text-xs">
                                        <span class="w-2 h-2 bg-gray-300 rounded-full"></span> Keine Website
                                    </span>
                                <?php endif; ?>
                            </td>
                        </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
            </div>
        </div>

        <?php if($captured): ?>
        <!-- Already Captured -->
        <div class="bg-green-50 border border-green-200 rounded-lg p-6 text-center">
            <h3 class="font-semibold text-green-800 mb-2">Lead bereits gespeichert</h3>
            <p class="text-sm text-green-700">Ihre Email wurde erfolgreich verifiziert. Dieser Lead ist in Ihrem System gespeichert.</p>
        </div>
        <?php else: ?>
        <!-- Email Capture Form -->
        <div class="bg-gray-50 border border-gray-200 rounded-lg p-6 mb-8">
            <h3 class="font-semibold text-gray-900 mb-2 text-center">Vollständigen Report abrufen</h3>
            <p class="text-sm text-gray-600 text-center mb-4">Geben Sie Ihre Email-Adresse ein, um den vollständigen Lead-Report zu erhalten.</p>

            <?php if($errors->any()): ?>
            <div class="bg-red-50 border border-red-200 text-red-700 rounded-lg p-3 mb-4 text-sm">
                <ul class="list-disc list-inside">
                    <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <li><?php echo e($error); ?></li>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </ul>
            </div>
            <?php endif; ?>

            <form action="<?php echo e(route('guest.score.capture', $guestScore->uuid)); ?>" method="POST" class="max-w-md mx-auto">
                <?php echo csrf_field(); ?>
                <div class="space-y-3">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Name (optional)</label>
                        <input type="text" name="name" value="<?php echo e(old('name')); ?>"
                               class="w-full px-3 py-2.5 border border-gray-300 rounded text-sm focus:outline-none focus:border-gray-500">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Email-Adresse *</label>
                        <input type="email" name="email" value="<?php echo e(old('email')); ?>" required
                               class="w-full px-3 py-2.5 border border-gray-300 rounded text-sm focus:outline-none focus:border-gray-500">
                    </div>
                    <div class="flex items-start gap-2">
                        <input type="checkbox" name="consent" value="1" id="consent" required class="mt-1">
                        <label for="consent" class="text-xs text-gray-600">
                            Ich bin mit der Verarbeitung meiner Daten gemäß der <a href="/datenschutz" class="text-indigo-600 hover:underline" target="_blank">Datenschutzerklärung</a> einverstanden. *
                        </label>
                    </div>
                    <button type="submit" class="w-full bg-gray-900 text-white px-6 py-2.5 rounded text-sm font-medium hover:bg-gray-800 transition">
                        Report per Email senden
                    </button>
                </div>
            </form>
        </div>
        <?php endif; ?>

        <!-- Upsell to Pro -->
        <div class="border border-gray-300 rounded-lg p-6 text-center">
            <h3 class="font-semibold text-gray-900 mb-2">Bereit für echte Leads aus OpenStreetMap?</h3>
            <p class="text-sm text-gray-600 mb-4">Registrieren Sie sich kostenlos und erhalten Sie 3 echte Suchen mit Daten aus OpenStreetMap. Keine Kreditkarte nötig.</p>
            <a href="/register" class="inline-block bg-white border border-gray-300 text-gray-900 px-6 py-2.5 rounded text-sm font-medium hover:bg-gray-50 transition">
                Kostenlos registrieren
            </a>
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
<?php /**PATH /opt/data/founder/apps/lead-finder-pro/resources/views/guest/show.blade.php ENDPATH**/ ?>