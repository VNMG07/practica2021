<?php $__env->startSection('content'); ?>
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Dashboard</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item active">Dashboard</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">

        <!-- Default box -->
        <div class="card">
            <div class="card-body">


                <div class="row">
                    <div class="col-lg-3 col-6">
                        <!-- small box -->
                        <div class="small-box bg-info">
                          <div class="inner">
                            <?php if($user->role === \App\Models\User::ROLE_ADMIN): ?>
                                 <h3><?php echo e($nrusers); ?></h3>
                             <?php else: ?>

                                 <h3><?php echo e(DB::table('users')->where('id', '=', $user->id)->count()); ?></h3>

                             <?php endif; ?>

                             <p>Users</p>
                          </div>
                            <div class="icon">
                                <i class="ion ion-bag"></i>
                            </div>
                              <a href="<?php echo e(route('users.all')); ?>" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                    <!-- ./col -->
                    <div class="col-lg-3 col-6">
                        <!-- small box -->
                        <div class="small-box bg-success">
                          <div class="inner">
                            <?php if($user->role === \App\Models\User::ROLE_ADMIN): ?>
                                 <h3><?php echo e(\App\Models\Task::count()); ?></h3>
                             <?php else: ?>
                                 <h3><?php echo e($nrtasks); ?></h3>
                             <?php endif; ?>

                             <p>Tasks</p>
                          </div>
                            <div class="icon">
                                <i class="ion ion-stats-bars"></i>
                            </div>
                            <a href="<?php echo e(route('boards.all')); ?>" class="small-box-footer">Click on the task you want to see <i class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                    <!-- ./col -->
                    <div class="col-lg-3 col-6">
                        <!-- small box -->
                        <div class="small-box bg-warning">
                            <div class="inner">
                              <?php if($user->role === \App\Models\User::ROLE_ADMIN): ?>
                                   <h3><?php echo e(\App\Models\Board::count()); ?></h3>
                               <?php else: ?>
                                   <h3><?php echo e($nrboards); ?></h3>

                               <?php endif; ?>

                               <p>Boards</p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-person-add"></i>
                            </div>
                            <a href="<?php echo e(route('boards.all')); ?>" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                    <!-- ./col -->
                    <div class="col-lg-3 col-6">
                        <!-- small box -->
                        <div class="small-box bg-danger">
                            <div class="inner">
                                <h3><?php echo e($nradmins); ?></h3>

                                <p>Admins</p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-pie-graph"></i>
                            </div>
                            <a href="<?php echo e(route('users.all')); ?>" class="small-box-footer">If you have a problem , this is our admins contacts <i class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                    <!-- ./col -->
                </div>


            </div>
        </div>
        <!-- /.card -->

    </section>
    <!-- /.content -->
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layout.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\practica2021\resources\views/dashboard/index.blade.php ENDPATH**/ ?>