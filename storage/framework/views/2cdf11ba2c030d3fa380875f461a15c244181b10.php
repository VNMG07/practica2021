

<?php $__env->startSection('content'); ?>
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Blank Page</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Blank Page</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">

        <!-- Default box -->
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Bordered Table</h3>
            </div>
            <!-- /.card-header -->

            <div class="card-body">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th style="width: 10px">#</th>
                            <th>Name</th>

                            <th>User ID</th>
                            <th style="width: 100px">Actions</th>

                        </tr>
                    </thead>
                    <tbody>
                        <?php $__currentLoopData = $boards; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $board): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php if(Auth::user()->role === \App\Models\User::ROLE_ADMIN): ?>
                            <tr>
                                <td><?php echo e($board->id); ?></td>
                                <td><?php echo e($board->name); ?></td>
                               <td><?php echo e($board->user()->first()->name); ?></td>

                                <td>
                                    <div class="btn-group">
                                        <button class="btn btn-xs btn-primary" type="button" data-user="<?php echo e(json_encode($board)); ?>" data-toggle="modal" data-target="#edit-modal">
                                            <i class="fas fa-edit"></i></button>
                                        <button class="btn btn-xs btn-danger" type="button" data-user="<?php echo e(json_encode($board)); ?>" data-toggle="modal" data-target="#delete-modal">
                                            <i class="fas fa-trash"></i></button>
                                    </div>
                                </td>
                            </tr>
                            <?php else: ?>
                            <?php if($board->user_id === Auth::user()->id): ?>
                            <tr>
                            <td><?php echo e($board->id); ?></td>
                                  <td><a href="<?php echo e(route('tasks.all')); ?>"><?php echo e($board->name); ?></a></td>
                                  <td><?php echo e($board->user()->name); ?></td>
                                  <td>
                                      <div class="btn-group">
                                          <button class="btn btn-xs btn-primary" type="button" data-user="<?php echo e(json_encode($user)); ?>" data-toggle="modal" data-target="#edit-modal">
                                              <i class="fas fa-edit"></i></button>
                                          <button class="btn btn-xs btn-danger" type="button" data-user="<?php echo e(json_encode($user)); ?>" data-toggle="modal" data-target="#delete-modal">
                                              <i class="fas fa-trash"></i></button>
                                      </div>
                                  </td>
                                </tr>
                                  <?php endif; ?>
                             <?php endif; ?>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
            </div>

            <!-- /.card-body -->
            <div class="card-footer clearfix">
                <ul class="pagination pagination-sm m-0 float-right">
                    <?php if($boards->currentPage() > 1): ?>
                        <li class="page-item"><a class="page-link" href="<?php echo e($boards->previousPageUrl()); ?>">&laquo;</a></li>
                        <li class="page-item"><a class="page-link" href="<?php echo e($boards->url(1)); ?>">1</a></li>
                    <?php endif; ?>

                    <?php if($boards->currentPage() < $boards->lastPage() ): ?>
                        <li class="page-item"><a class="page-link" href="<?php echo e($boards->url($boards->lastPage())); ?>"><?php echo e($boards->lastPage()); ?></a></li>
                        <li class="page-item"><a class="page-link" href="<?php echo e($boards->nextPageUrl()); ?>">&raquo;</a></li>
                    <?php endif; ?>
                </ul>
            </div>
        </div>
        <!-- /.card -->

        <div class="modal fade" id="edit-modal">
            <div class="modal-dialog">
                <form action="" method="POST">
                <?php echo csrf_field(); ?>
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Edit board</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div id="editName"></div>
                            <input type="hidden" name="editId" value="" />
                            <div class="form-group">
                                <label for="editname">Role</label>
                                <select class="custom-select rounded-0" id="editRole">
                                    <option value="<?php echo e(\App\Models\User::ROLE_USER); ?>">User</option>
                                    <option value="<?php echo e(\App\Models\User::ROLE_ADMIN); ?>">Admin</option>
                                </select>
                            </div>
                        </div>
                        <div class="modal-footer justify-content-between">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Save changes</button>
                        </div>
                    </div>
                </form>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>

        <div class="modal fade" id="delete-modal">
            <div class="modal-dialog">
              <form action="" method="POST" id="delete-form">
        <?php echo csrf_field(); ?>
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Delete board</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                      <div id="deleteName"></div>
                      <input type="hidden" name="deleteId" value=""/>
                        <p>Are you sure you want to delete that board you cant undo it?</p>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-primary" data-dismiss="modal">NO</button>
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </div>
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>

    </section>
    <!-- /.content -->
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layout.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\practica2021\resources\views/boards/index.blade.php ENDPATH**/ ?>