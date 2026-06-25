<?php $__env->startSection('content'); ?>
<div class="container mx-auto px-4 py-8">
    <h1 class="text-2xl font-bold mb-6">Analytics Dashboard</h1>

    <!-- Overview Cards -->
    <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-8">
        <div class="bg-white rounded-lg shadow p-4">
            <div class="text-sm text-gray-500">Total Searches</div>
            <div class="text-3xl font-bold text-indigo-600"><?php echo e($totalSearches); ?></div>
        </div>
        <div class="bg-white rounded-lg shadow p-4">
            <div class="text-sm text-gray-500">Success Rate</div>
            <div class="text-3xl font-bold text-green-600"><?php echo e($successRate); ?>%</div>
        </div>
        <div class="bg-white rounded-lg shadow p-4">
            <div class="text-sm text-gray-500">With Website</div>
            <div class="text-3xl font-bold text-blue-600"><?php echo e($withWebsite); ?></div>
        </div>
        <div class="bg-white rounded-lg shadow p-4">
            <div class="text-sm text-gray-500">Validated</div>
            <div class="text-3xl font-bold text-emerald-600"><?php echo e($validated); ?></div>
        </div>
    </div>

    <!-- Leads Over Time Chart -->
    <div class="bg-white rounded-lg shadow p-6 mb-8">
        <h2 class="text-lg font-semibold mb-4">Leads Over Time (Last 30 Days)</h2>
        <canvas id="leadsChart" height="100"></canvas>
    </div>

    <!-- Top Industries -->
    <div class="bg-white rounded-lg shadow p-6">
        <h2 class="text-lg font-semibold mb-4">Top Industries</h2>
        <?php if($topIndustries->isEmpty()): ?>
            <p class="text-gray-500">No data yet. Start searching!</p>
        <?php else: ?>
            <div class="space-y-3">
                <?php $__currentLoopData = $topIndustries; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="flex items-center gap-4">
                    <div class="flex-1">
                        <div class="bg-gray-200 rounded-full h-4 overflow-hidden">
                            <div class="bg-indigo-500 h-4 rounded-full" style="width: <?php echo e(min(100, ($item->count / max(1, $topIndustries->first()->count)) * 100)); ?>%"></div>
                        </div>
                    </div>
                    <div class="w-32 text-sm font-medium"><?php echo e($item->industry); ?></div>
                    <div class="w-12 text-right text-sm text-gray-500"><?php echo e($item->count); ?></div>
                </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        <?php endif; ?>
    </div>
</div>

<?php $__env->startPush('scripts'); ?>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
const ctx = document.getElementById('leadsChart').getContext('2d');
const data = {
    labels: <?php echo json_encode($leadsOverTime->pluck('date')); ?>,
    datasets: [{
        label: 'Leads',
        data: <?php echo json_encode($leadsOverTime->pluck('count')); ?>,
        borderColor: '#6366f1',
        backgroundColor: 'rgba(99, 102, 241, 0.1)',
        fill: true,
        tension: 0.3
    }]
};
new Chart(ctx, { type: 'line', data });
</script>
<?php $__env->stopPush(); ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /opt/data/founder/apps/lead-finder-pro/resources/views/modules/analytics/index.blade.php ENDPATH**/ ?>