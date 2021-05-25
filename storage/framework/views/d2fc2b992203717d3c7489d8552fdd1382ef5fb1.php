<?php $__env->startSection('body'); ?>
    <body class="hold-transition login-page">
        <div class="login-box">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Verify Your Email Address</h3>
                </div>

                <div class="card-body">
                    <div class="card-body">
                        <?php if(session('resent')): ?>
                            <div class="alert alert-success" role="alert">A fresh verification link has been sent to your email address.</div>
                        <?php endif; ?>

                        Before proceeding, please check your email for a verification link.
                        If you did not receive the email
                        <form class="d-inline" method="POST" action="<?php echo e(route('verification.send')); ?>">
                            <?php echo csrf_field(); ?>
                            <button type="submit" class="btn btn-link p-0 m-0 align-baseline">click here to request another</button>
                            .
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </body>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout.base', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\practica2021\resources\views/auth/verifyEmail.blade.php ENDPATH**/ ?>