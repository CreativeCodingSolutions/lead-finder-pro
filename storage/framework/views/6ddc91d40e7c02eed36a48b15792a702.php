<?php $__env->startSection('title', 'Export Scheduler - Lead Finder Pro'); ?>

<?php $__env->startSection('content'); ?>
<div class="max-w-4xl mx-auto">
    <div class="flex items-center justify-between mb-6">
        <div>
            <h1 class="text-2xl font-bold text-gray-900">
                <i class="fa-solid fa-clock text-indigo-500 mr-2"></i>Export Scheduler
            </h1>
            <p class="text-sm text-gray-500 mt-1">Automatische Lead-Exports planen</p>
        </div>
        <a href="<?php echo e(route('exports.schedule.create')); ?>" class="px-4 py-2 bg-indigo-600 text-white rounded-lg font-medium hover:bg-indigo-700 transition">
            <i class="fa-solid fa-plus mr-2"></i>Neuer Schedule
        </a>
    </div>

    <?php if(session('success')): ?>
        <div class="mb-4 bg-green-50 border border-green-200 text-green-800 rounded-lg px-4 py-3 flex items-center gap-2">
            <i class="fa-solid fa-check-circle"></i> <?php echo e(session('success')); ?>

        </div>
    <?php endif; ?>

    <?php if(empty($schedules)): ?>
        <div class="bg-white rounded-xl shadow-sm border p-12 text-center">
            <i class="fa-solid fa-calendar-xmark text-4xl text-gray-300 mb-4"></i>
            <p class="text-gray-500 mb-4">Noch keine Export-Schedules erstellt.</p>
            <a href="<?php echo e(route('exports.schedule.create')); ?>" class="text-indigo-600 hover:underline font-medium">Ersten Schedule erstellen</a>
        </div>
    <?php else: ?>
        <div class="space-y-4">
            <?php $__currentLoopData = $schedules; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $schedule): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php
                $freqLabels = ['daily' => 'Täglich', 'weekly' => 'Wöchentlich', 'monthly' => 'Monatlich'];
                $freqBadgeColors = ['daily' => 'bg-blue-100 text-blue-700', 'weekly' => 'bg-purple-100 text-purple-700', 'monthly' => 'bg-orange-100 text-orange-700'];
                $freqLabel = $freqLabels[$schedule['frequency']] ?? $schedule['frequency'];
                $freqColor = $freqBadgeColors[$schedule['frequency']] ?? 'bg-gray-100 text-gray-700';
            ?>
            <div class="bg-white rounded-xl shadow-sm border p-5">
                <div class="flex items-start justify-between">
                    <div class="flex items-start gap-4">
                        <div class="w-12 h-12 bg-indigo-50 rounded-xl flex items-center justify-center flex-shrink-0">
                            <i class="fa-solid fa-clock text-indigo-600 text-lg"></i>
                        </div>
                        <div>
                            <div class="flex items-center gap-3">
                                <h3 class="font-semibold text-gray-900"><?php echo e($schedule['name']); ?></h3>
                                <span class="px-2 py-0.5 rounded-full text-xs font-medium <?php echo e($freqColor); ?>"><?php echo e($freqLabel); ?></span>
                                <span class="px-2 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-600 uppercase"><?php echo e($schedule['format']); ?></span>
                                <?php if($schedule['active']): ?>
                                    <span class="px-2 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-700">Aktiv</span>
                                <?php else: ?>
                                    <span class="px-2 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-700">Pausiert</span>
                                <?php endif; ?>
                            </div>
                            <div class="flex items-center gap-4 mt-2 text-sm text-gray-500">
                                <span><i class="fa-solid fa-industry mr-1"></i><?php echo e($schedule['industry']); ?></span>
                                <span><i class="fa-solid fa-location-dot mr-1"></i><?php echo e($schedule['city']); ?></span>
                            </div>
                            <div class="flex items-center gap-4 mt-1 text-xs text-gray-400">
                                <span>Letzter Lauf: <?php echo e($schedule['last_run']); ?></span>
                                <span>Nächster Lauf: <strong class="text-indigo-600"><?php echo e($schedule['next_run']); ?></strong></span>
                            </div>
                        </div>
                    </div>
                    <form action="<?php echo e(route('exports.schedule.destroy', $schedule['id'])); ?>" method="POST" onsubmit="return confirm('Schedule wirklich löschen?')">
                        <?php echo csrf_field(); ?>
                        <?php echo method_field('DELETE'); ?>
                        <button type="submit" class="text-xs text-red-500 hover:text-red-700 px-3 py-1.5 border border-red-200 rounded-lg hover:bg-red-50 transition">
                            <i class="fa-solid fa-trash mr-1"></i>Löschen
                        </button>
                    </form>
                </div>
            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    <?php endif; ?>

    <!-- Info Box -->
    <div class="bg-indigo-50 border border-indigo-200 rounded-xl p-6 mt-8">
        <h3 class="font-semibold text-indigo-900 mb-2"><i class="fa-solid fa-circle-info mr-2"></i>Über Export Scheduler</h3>
        <p class="text-sm text-indigo-700">
            Plane automatische Exporte deiner Leads in verschiedenen Formaten.
            Wöchentliche und monatliche Reports werden automatisch generiert und stehen zum Download bereit.
        </p>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /opt/data/founder/apps/lead-finder-pro/resources/views/modules/export-scheduler/index.blade.php ENDPATH**/ ?>