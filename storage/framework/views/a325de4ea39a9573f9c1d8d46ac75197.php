<?php $__env->startSection('title', 'Login - Lead Finder Pro'); ?>

<div class="min-h-screen flex items-center justify-center bg-gradient-to-br from-indigo-50 to-blue-50 px-4">
    <div class="max-w-md w-full">
        <div class="text-center mb-8">
            <i class="fa-solid fa-magnifying-glass-chart text-primary text-5xl mb-4"></i>
            <h1 class="text-3xl font-bold text-gray-900">Lead Finder Pro</h1>
            <p class="text-gray-500 mt-2">Melde dich an, um Leads zu finden</p>
        </div>

        <div class="bg-white rounded-xl shadow-lg p-8">
            <form method="POST" action="<?php echo e(route('login')); ?>" class="space-y-5">
                <?php echo csrf_field(); ?>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                    <input type="email" name="email" value="<?php echo e(old('email')); ?>" required autofocus
                        class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary/20 focus:border-primary outline-none transition"
                        placeholder="deine@email.at">
                    <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <p class="text-red-500 text-xs mt-1"><?php echo e($message); ?></p> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Passwort</label>
                    <input type="password" name="password" required
                        class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary/20 focus:border-primary outline-none transition"
                        placeholder="••••••••">
                </div>
                <div class="flex items-center justify-between">
                    <div class="flex items-center">
                        <input type="checkbox" name="remember" id="remember" class="rounded border-gray-300 text-primary focus:ring-primary">
                        <label for="remember" class="ml-2 text-sm text-gray-600">Angemeldet bleiben</label>
                    </div>
                    <a href="<?php echo e(route('password.request')); ?>" class="text-sm text-primary hover:underline">Passwort vergessen?</a>
                </div>
                <button type="submit" class="w-full bg-primary text-white py-2.5 rounded-lg font-medium hover:bg-secondary transition">
                    Anmelden
                </button>
            </form>

            <p class="text-center text-sm text-gray-500 mt-6">
                Noch kein Konto? <a href="<?php echo e(route('register')); ?>" class="text-primary font-medium hover:underline">Registrieren</a>
            </p>
        </div>

        <p class="text-center text-xs text-gray-400 mt-6">
            Demo: demo@example.com / password
        </p>
    </div>
</div>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /opt/data/founder/apps/lead-finder-pro/resources/views/auth/login.blade.php ENDPATH**/ ?>