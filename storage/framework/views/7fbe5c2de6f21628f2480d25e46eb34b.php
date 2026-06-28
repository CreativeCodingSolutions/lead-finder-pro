<?php $__env->startSection('title', 'Impressum | LeadFinder Pro'); ?>
<?php $__env->startSection('meta_description', 'Impressum von LeadFinder Pro — B2B Lead Generation aus OpenStreetMap. CreativeCoding Solutions eG, Wien.'); ?>
<?php $__env->startSection('meta_keywords', 'Impressum, LeadFinder Pro, CreativeCoding Solutions, Kontakt'); ?>
<?php $__env->startSection('canonical', 'https://leadfinderpro.creativecoding.cloud/impressum'); ?>
<?php $__env->startSection('meta_robots', 'noindex, follow'); ?>

<?php $__env->startSection('content'); ?>
<div class="max-w-4xl mx-auto px-4 py-16">
    <h1 class="text-3xl font-bold mb-8">Impressum</h1>
    <div class="prose prose-gray max-w-none">
        <p class="text-lg text-gray-600 mb-6">Angaben gemäß § 5 TMG</p>
        <p class="mb-4">
            <?php echo e(env('COMPANY_NAME', 'CreativeCoding Solutions eG')); ?><br>
            <?php echo e(env('COMPANY_OWNER', 'Karsten Brauner')); ?><br>
            <?php echo e(env('COMPANY_STREET', 'Musterstraße 123')); ?><br>
            <?php echo e(env('COMPANY_ZIP', '1010 Wien')); ?><br>
            <?php echo e(env('COMPANY_COUNTRY', 'Österreich')); ?><br>
            Firmenbuch: <?php echo e(env('COMPANY_FIRMENBUCH', '1234567890')); ?>

        </p>
        <h2 class="text-xl font-semibold mt-8 mb-4">Kontakt</h2>
        <p class="mb-4">
            E-Mail: <?php echo e(env('COMPANY_EMAIL', 'info@creativecoding.cloud')); ?>

        </p>
        <h2 class="text-xl font-semibold mt-8 mb-4">EU-Streitschlichtung</h2>
        <p class="mb-4">
            Die Europäische Kommission stellt eine Plattform zur Online-Streitbeilegung (OS) bereit: 
            <a href="https://ec.europa.eu/consumers/odr/" class="text-indigo-600 hover:underline" target="_blank" rel="noopener">
                https://ec.europa.eu/consumers/odr/
            </a>
        </p>
        <h2 class="text-xl font-semibold mt-8 mb-4">Verantwortlich für den Inhalt</h2>
        <p class="mb-4">
            <?php echo e(env('COMPANY_OWNER', 'Karsten Brauner')); ?><br>
            <?php echo e(env('COMPANY_NAME', 'CreativeCoding Solutions eG')); ?><br>
            <?php echo e(env('COMPANY_STREET', 'Musterstraße 123')); ?><br>
            <?php echo e(env('COMPANY_ZIP', '1010 Wien')); ?>

        </p>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /opt/data/founder/apps/lead-finder-pro/resources/views/legal/impressum.blade.php ENDPATH**/ ?>