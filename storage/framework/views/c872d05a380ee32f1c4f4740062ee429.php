<?php $__env->startSection('title', 'Registrieren - Lead Finder Pro'); ?>

<?php $__env->startSection('content'); ?>
<div class="min-h-screen flex items-center justify-center bg-gradient-to-br from-indigo-50 to-blue-50 px-4">
    <div class="max-w-md w-full">
        <div class="text-center mb-8">
            <i class="fa-solid fa-magnifying-glass-chart text-primary text-5xl mb-4"></i>
            <h1 class="text-3xl font-bold text-gray-900">Konto erstellen</h1>
            <p class="text-gray-500 mt-2">Finde jetzt qualifizierte Leads</p>
        </div>

        <div class="bg-white rounded-xl shadow-lg p-8">
            <form method="POST" action="<?php echo e(route('register')); ?>" class="space-y-5">
                <?php echo csrf_field(); ?>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Name</label>
                    <input type="text" name="name" value="<?php echo e(old('name')); ?>" required
                        class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary/20 focus:border-primary outline-none transition"
                        placeholder="Max Mustermann">
                    <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <p class="text-red-500 text-xs mt-1"><?php echo e($message); ?></p> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                    <input type="email" name="email" value="<?php echo e(old('email')); ?>" required
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
                    <input type="password" name="password" required minlength="8"
                        class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary/20 focus:border-primary outline-none transition"
                        placeholder="Mindestens 8 Zeichen">
                    <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <p class="text-red-500 text-xs mt-1"><?php echo e($message); ?></p> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Passwort bestätigen</label>
                    <input type="password" name="password_confirmation" required
                        class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary/20 focus:border-primary outline-none transition"
                        placeholder="••••••••">
                </div>
                <div class="space-y-2">
                    <label class="flex items-start gap-2 text-sm text-gray-600 cursor-pointer">
                        <input type="checkbox" name="agb_consent" required
                            class="mt-0.5 rounded border-gray-300 text-indigo-600 focus:ring-indigo-500">
                        <span>Ich habe die <a href="/agb" class="text-primary hover:underline">AGB</a> gelesen und stimme ihnen zu.</span>
                    </label>
                    <label class="flex items-start gap-2 text-sm text-gray-600 cursor-pointer">
                        <input type="checkbox" name="privacy_consent" required
                            class="mt-0.5 rounded border-gray-300 text-indigo-600 focus:ring-indigo-500">
                        <span>Ich habe die <a href="/datenschutz" class="text-primary hover:underline">Datenschutzerklärung</a> gelesen und stimme der Verarbeitung meiner Daten zu.</span>
                    </label>
                </div>
                <button type="submit" class="w-full bg-primary text-white py-2.5 rounded-lg font-medium hover:bg-secondary transition">
                    Registrieren
                </button>
            </form>

            <p class="text-center text-sm text-gray-500 mt-6">
                Bereits registriert? <a href="<?php echo e(route('login')); ?>" class="text-primary font-medium hover:underline">Anmelden</a>
            </p>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /opt/data/founder/apps/lead-finder-pro/resources/views/auth/register.blade.php ENDPATH**/ ?>