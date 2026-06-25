<?php $__env->startSection('content'); ?>
<div class="container mx-auto px-4 py-8">
    <h1 class="text-2xl font-bold mb-6">Export Leads</h1>

    <div class="bg-white rounded-lg shadow p-6">
        <p class="text-gray-600 mb-6">Export all your leads in various formats.</p>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <a href="<?php echo e(route('export.csv')); ?>" class="flex items-center justify-center gap-3 py-4 px-6 bg-green-600 text-white rounded-lg hover:bg-green-700 transition font-semibold">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                Export CSV
            </a>
            <a href="<?php echo e(route('export.json')); ?>" class="flex items-center justify-center gap-3 py-4 px-6 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition font-semibold">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                Export JSON
            </a>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /opt/data/founder/apps/lead-finder-pro/resources/views/modules/export-enhanced/index.blade.php ENDPATH**/ ?>