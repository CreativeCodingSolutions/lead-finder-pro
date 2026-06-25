<?php $__env->startSection('title', 'Passwort vergessen - Lead Finder Pro'); ?>

<?php $__env->startSection('content'); ?>
<div class="min-h-screen flex items-center justify-center bg-gradient-to-br from-indigo-50 to-blue-50 px-4 py-12">
    <div class="max-w-md w-full">
        <div class="text-center mb-8">
            <i class="fa-solid fa-key text-primary text-4xl mb-3"></i>
            <h1 class="text-2xl font-bold text-gray-900">Passwort vergessen?</h1>
            <p class="text-gray-500 mt-2">Gib deine Email ein und wir senden dir einen Link zum Zurücksetzen.</p>
        </div>

        <div class="bg-white rounded-xl shadow-lg p-8">
            <?php if(session('status')): ?>
                <div class="mb-4 bg-green-50 border border-green-200 text-green-800 rounded-lg px-4 py-3 flex items-center gap-2">
                    <i class="fa-solid fa-check-circle"></i> <?php echo e(session('status')); ?>

                </div>
            <?php endif; ?>

            <?php if($errors->any()): ?>
                <div class="mb-4 bg-red-50 border border-red-200 text-red-800 rounded-lg px-4 py-3">
                    <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <p class="text-sm"><?php echo e($error); ?></p>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            <?php endif; ?>

            <form method="POST" action="<?php echo e(route('password.email')); ?>" class="space-y-5">
                <?php echo csrf_field(); ?>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                    <input type="email" name="email" value="<?php echo e(old('email')); ?>" required autofocus
                        class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary/20 focus:border-primary outline-none transition"
                        placeholder="deine@email.at">
                </div>
                <button type="submit" class="w-full bg-primary text-white py-2.5 rounded-lg font-medium hover:bg-secondary transition">
                    <i class="fa-solid fa-paper-plane mr-2"></i>Link senden
                </button>
            </form>

            <p class="text-center text-sm text-gray-500 mt-6">
                <a href="<?php echo e(route('login')); ?>" class="text-primary font-medium hover:underline">← Zurück zum Login</a>
            </p>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.auth', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /opt/data/founder/apps/lead-finder-pro/resources/views/auth/passwords/email.blade.php ENDPATH**/ ?>