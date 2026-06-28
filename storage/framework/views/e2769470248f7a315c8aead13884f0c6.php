<?php $__env->startSection('title', 'Webhooks – Lead Finder Pro'); ?>

<?php $__env->startSection('content'); ?>
<div class="max-w-5xl mx-auto px-4 py-8">
    <!-- Header -->
    <div class="flex items-center gap-3 mb-8">
        <div class="w-10 h-10 rounded-lg bg-indigo-100 flex items-center justify-center">
            <i class="fa-solid fa-bolt text-indigo-600 text-lg"></i>
        </div>
        <div>
            <h1 class="text-2xl font-bold text-gray-900">Webhook Integration</h1>
            <p class="text-sm text-gray-500">Zapier / Make.com – Events für neue Leads, Exporte und Statusänderungen</p>
        </div>
    </div>

    <!-- Flash Messages -->
    <?php if(session('success')): ?>
        <div class="mb-4 p-4 bg-green-50 border border-green-200 text-green-700 rounded-lg flex items-center gap-2">
            <i class="fa-solid fa-check-circle"></i>
            <?php echo e(session('success')); ?>

        </div>
    <?php endif; ?>
    <?php if(session('error')): ?>
        <div class="mb-4 p-4 bg-red-50 border border-red-200 text-red-700 rounded-lg flex items-center gap-2">
            <i class="fa-solid fa-triangle-exclamation"></i>
            <?php echo e(session('error')); ?>

        </div>
    <?php endif; ?>

    <!-- Create Form -->
    <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 mb-8">
        <h2 class="text-lg font-semibold mb-4 flex items-center gap-2">
            <i class="fa-solid fa-plus-circle text-indigo-500"></i>
            Neuen Webhook erstellen
        </h2>
        <form action="<?php echo e(route('webhooks.store')); ?>" method="POST" class="space-y-4">
            <?php echo csrf_field(); ?>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Name</label>
                    <input type="text" name="name" value="<?php echo e(old('name')); ?>" required
                        class="w-full rounded-lg border-gray-300 border px-3 py-2 text-sm focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500"
                        placeholder="z.B. Zapier Lead Sync">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Webhook URL</label>
                    <input type="url" name="url" value="<?php echo e(old('url')); ?>" required
                        class="w-full rounded-lg border-gray-300 border px-3 py-2 text-sm focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500"
                        placeholder="https://hooks.zapier.com/...">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Event</label>
                    <select name="event" required
                        class="w-full rounded-lg border-gray-300 border px-3 py-2 text-sm focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
                        <option value="">– Event wählen –</option>
                        <option value="lead.created" <?php echo e(old('event') == 'lead.created' ? 'selected' : ''); ?>>Lead erstellt</option>
                        <option value="lead.updated" <?php echo e(old('event') == 'lead.updated' ? 'selected' : ''); ?>>Lead aktualisiert</option>
                        <option value="export.completed" <?php echo e(old('event') == 'export.completed' ? 'selected' : ''); ?>>Export abgeschlossen</option>
                        <option value="report.ready" <?php echo e(old('event') == 'report.ready' ? 'selected' : ''); ?>>Report fertig</option>
                    </select>
                </div>
            </div>
            <button type="submit"
                class="inline-flex items-center gap-2 px-5 py-2 bg-indigo-600 text-white text-sm font-medium rounded-lg hover:bg-indigo-700 transition">
                <i class="fa-solid fa-bolt"></i>
                Webhook erstellen
            </button>
        </form>
    </div>

    <!-- Webhooks List -->
    <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
        <div class="px-6 py-4 border-b border-gray-100">
            <h2 class="text-lg font-semibold flex items-center gap-2">
                <i class="fa-solid fa-list text-indigo-500"></i>
                Deine Webhooks
                <span class="text-sm font-normal text-gray-400">(<?php echo e($webhooks->total()); ?>)</span>
            </h2>
        </div>

        <?php if($webhooks->isEmpty()): ?>
            <div class="p-12 text-center">
                <div class="w-16 h-16 rounded-full bg-gray-100 flex items-center justify-center mx-auto mb-4">
                    <i class="fa-solid fa-bolt text-gray-400 text-2xl"></i>
                </div>
                <p class="text-gray-500 mb-2">Noch keine Webhooks eingerichtet.</p>
                <p class="text-sm text-gray-400">Erstelle deinen ersten Webhook oben, um Events an Zapier oder Make.com zu senden.</p>
            </div>
        <?php else: ?>
            <div class="overflow-x-auto">
                <table class="w-full text-sm">
                    <thead class="bg-gray-50 text-gray-600">
                        <tr>
                            <th class="text-left px-6 py-3 font-medium">Status</th>
                            <th class="text-left px-6 py-3 font-medium">Name</th>
                            <th class="text-left px-6 py-3 font-medium">Event</th>
                            <th class="text-left px-6 py-3 font-medium hidden md:table-cell">URL</th>
                            <th class="text-left px-6 py-3 font-medium hidden lg:table-cell">Getriggert</th>
                            <th class="text-right px-6 py-3 font-medium">Aktionen</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        <?php $__currentLoopData = $webhooks; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $webhook): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr class="hover:bg-gray-50 transition">
                            <td class="px-6 py-4">
                                <form action="<?php echo e(route('webhooks.toggle', $webhook->id)); ?>" method="POST" class="inline">
                                    <?php echo csrf_field(); ?>
                                    <button type="submit" class="relative inline-flex h-6 w-11 items-center rounded-full transition <?php echo e($webhook->is_active ? 'bg-indigo-600' : 'bg-gray-300'); ?>">
                                        <span class="inline-block h-4 w-4 transform rounded-full bg-white transition <?php echo e($webhook->is_active ? 'translate-x-6' : 'translate-x-1'); ?>"></span>
                                    </button>
                                </form>
                                <span class="ml-2 text-xs <?php echo e($webhook->is_active ? 'text-green-600' : 'text-gray-400'); ?>">
                                    <?php echo e($webhook->is_active ? 'Aktiv' : 'Inaktiv'); ?>

                                </span>
                            </td>
                            <td class="px-6 py-4 font-medium text-gray-900"><?php echo e($webhook->name); ?></td>
                            <td class="px-6 py-4">
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium
                                    <?php echo e($webhook->event === 'lead.created' ? 'bg-green-100 text-green-800' : ''); ?>

                                    <?php echo e($webhook->event === 'lead.updated' ? 'bg-blue-100 text-blue-800' : ''); ?>

                                    <?php echo e($webhook->event === 'export.completed' ? 'bg-purple-100 text-purple-800' : ''); ?>

                                    <?php echo e($webhook->event === 'report.ready' ? 'bg-orange-100 text-orange-800' : ''); ?>

                                ">
                                    <?php echo e($webhook->event); ?>

                                </span>
                            </td>
                            <td class="px-6 py-4 text-gray-500 hidden md:table-cell max-w-xs truncate"><?php echo e($webhook->url); ?></td>
                            <td class="px-6 py-4 text-gray-500 hidden lg:table-cell">
                                <?php if($webhook->trigger_count > 0): ?>
                                    <?php echo e($webhook->trigger_count); ?>×
                                    <?php if($webhook->last_triggered_at): ?>
                                        <span class="text-xs text-gray-400">(<?php echo e(\Carbon\Carbon::parse($webhook->last_triggered_at)->diffForHumans()); ?>)</span>
                                    <?php endif; ?>
                                <?php else: ?>
                                    <span class="text-gray-400">–</span>
                                <?php endif; ?>
                            </td>
                            <td class="px-6 py-4 text-right">
                                <div class="flex items-center justify-end gap-2">
                                    <form action="<?php echo e(route('webhooks.test', $webhook->id)); ?>" method="POST" class="inline">
                                        <?php echo csrf_field(); ?>
                                        <button type="submit" title="Test senden"
                                            class="inline-flex items-center gap-1 px-3 py-1.5 text-xs font-medium text-indigo-600 bg-indigo-50 rounded-lg hover:bg-indigo-100 transition">
                                            <i class="fa-solid fa-paper-plane"></i> Test
                                        </button>
                                    </form>
                                    <form action="<?php echo e(route('webhooks.destroy', $webhook->id)); ?>" method="POST" class="inline"
                                        onsubmit="return confirm('Webhook wirklich löschen?')">
                                        <?php echo csrf_field(); ?>
                                        <?php echo method_field('DELETE'); ?>
                                        <button type="submit" title="Löschen"
                                            class="inline-flex items-center gap-1 px-3 py-1.5 text-xs font-medium text-red-600 bg-red-50 rounded-lg hover:bg-red-100 transition">
                                            <i class="fa-solid fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            <div class="px-6 py-4 border-t border-gray-100">
                <?php echo e($webhooks->links()); ?>

            </div>
        <?php endif; ?>
    </div>

    <!-- Info Box -->
    <div class="mt-8 p-4 bg-indigo-50 border border-indigo-100 rounded-xl text-sm text-indigo-700">
        <p class="font-semibold mb-1"><i class="fa-solid fa-info-circle mr-1"></i> Integration mit Zapier & Make.com</p>
        <p class="text-indigo-600">Erstelle einen "Webhook by Zapier" oder "Webhook by Make" Trigger und füge die URL hier ein. Bei ausgelösem Event sendet Lead Finder Pro einen POST-Request mit den relevanten Daten an deine URL.</p>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /opt/data/founder/apps/lead-finder-pro/resources/views/webhook-integration/index.blade.php ENDPATH**/ ?>