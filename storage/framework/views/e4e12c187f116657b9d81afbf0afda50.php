<?php $__env->startSection('content'); ?>
<div class="container mx-auto px-4 py-8">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold">Lead Enrichment</h1>
        <?php if($leads->count() > 0): ?>
        <form action="<?php echo e(route('enrichment.enrich-all')); ?>" method="POST">
            <?php echo csrf_field(); ?>
            <button type="submit" class="py-2 px-4 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 transition font-semibold">
                Enrich All (<?php echo e($leads->count()); ?> pending)
            </button>
        </form>
        <?php endif; ?>
    </div>

    <div class="bg-white rounded-lg shadow p-6">
        <?php if($leads->isEmpty()): ?>
            <p class="text-gray-500 text-center py-8">All leads are already enriched! ✓</p>
        <?php else: ?>
            <p class="text-gray-600 mb-4">Leads waiting for enrichment:</p>
            <div class="space-y-3">
                <?php $__currentLoopData = $leads; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $lead): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="flex items-center justify-between p-4 bg-gray-50 rounded-lg">
                    <div>
                        <div class="font-semibold"><?php echo e($lead->company_name); ?></div>
                        <div class="text-sm text-gray-500"><?php echo e($lead->website); ?></div>
                    </div>
                    <form action="<?php echo e(route('enrichment.enrich', $lead)); ?>" method="POST">
                        <?php echo csrf_field(); ?>
                        <button type="submit" class="py-1 px-3 bg-green-600 text-white text-sm rounded hover:bg-green-700 transition">
                            Enrich
                        </button>
                    </form>
                </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
            <div class="mt-4"><?php echo e($leads->links()); ?></div>
        <?php endif; ?>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /opt/data/founder/apps/lead-finder-pro/resources/views/modules/lead-enrichment/index.blade.php ENDPATH**/ ?>