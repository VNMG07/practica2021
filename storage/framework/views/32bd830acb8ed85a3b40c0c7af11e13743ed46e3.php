

<?php $__env->startSection('content'); ?>
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Board view</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?php echo e(route('dashboard')); ?>">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="<?php echo e(route('boards.all')); ?>">Boards</a></li>
                        <li class="breadcrumb-item active">Board</li>
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
                <h3 class="card-title"><?php echo e($board->name); ?></h3>
            </div>

            <div class="card-body">
                <div class="card-columns">
                    <select class="custom-select rounded-0" id="changeBoard">
                        <?php $__currentLoopData = $boards; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $selectBoard): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option <?php if($selectBoard->id === $board->id): ?> selected="selected"
                                    <?php endif; ?> value="<?php echo e($selectBoard->id); ?>"><?php echo e($selectBoard->name); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                </div>
                <br>
                <table class="table table-bordered">
                    <thead>
                    <tr>
                        <th style="width: 10px">#</th>
                        <th>Name</th>
                        <th>Description</th>
                        <th>Assignment</th>
                        <th>Status</th>
                        <th>Creation date</th>
                        <th style="width: 40px">Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php $__currentLoopData = $tasks; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $task): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td><?php echo e($task->id); ?></td>
                            <td><?php echo e($task->name); ?></td>
                            <td><?php echo e($task->description); ?></td>
                            <td><?php echo e($task->assignment); ?></td>
                            <td>
                            <?php if($task->status === \App\Models\Task::STATUS_CREATED): ?>
                            <span class="badge bg-default"><?php echo e('Task has been created'); ?></span>
                            <?php elseif($task->status === \App\Models\Task::STATUS_IN_PROGRESS): ?>
                            <span class="badge bg-primary">  <?php echo e('Task is in progress'); ?></span>
                            <?php else: ?>
                            <span class="badge bg-success">  <?php echo e('Task is done'); ?></span>
                            <?php endif; ?>
                            </td>
                            <td><?php echo e(date('d-m-Y', strtotime($task->created_at))); ?></td>

                            <td>
                                <div class="btn-group">
                                    <button class="btn btn-xs btn-primary" type="button"
                                            data-user="<?php echo e(json_encode($task)); ?>" data-toggle="modal"
                                            data-target="#edit-modal">
                                        <i class="fas fa-edit"></i></button>
                                    <?php if($user->role === \App\Models\User::ROLE_ADMIN || $user->id === $board->user->id): ?>
                                        <button class="btn btn-xs btn-danger" type="button"
                                                data-user="<?php echo e(json_encode($task)); ?>" data-toggle="modal"
                                                data-target="#delete-modal">
                                            <i class="fas fa-trash"></i></button>
                                    <?php endif; ?>
                                </div>
                            </td>

                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
            </div>
            <div class="card-footer clearfix">
                <ul class="pagination pagination-sm m-0 float-right">
                    <?php if($tasks->currentPage() > 1): ?>
                        <li class="page-item"><a class="page-link" href="<?php echo e($tasks->previousPageUrl()); ?>">&laquo;</a></li>
                        <li class="page-item"><a class="page-link" href="<?php echo e($tasks->url(1)); ?>">1</a></li>
                    <?php endif; ?>

                    <?php if($tasks->currentPage() > 3): ?>
                        <li class="page-item"><span class="page-link page-active">...</span></li>
                    <?php endif; ?>
                    <?php if($tasks->currentPage() >= 3): ?>
                        <li class="page-item"><a class="page-link"
                                                 href="<?php echo e($tasks->url($tasks->currentPage() - 1)); ?>"><?php echo e($tasks->currentPage() - 1); ?></a>
                        </li>
                    <?php endif; ?>

                    <li class="page-item"><span class="page-link page-active"><?php echo e($tasks->currentPage()); ?></span></li>

                    <?php if($tasks->currentPage() <= $tasks->lastPage() - 2): ?>
                        <li class="page-item"><a class="page-link"
                                                 href="<?php echo e($tasks->url($tasks->currentPage() + 1)); ?>"><?php echo e($tasks->currentPage() + 1); ?></a>
                        </li>
                    <?php endif; ?>

                    <?php if($tasks->currentPage() < $tasks->lastPage() - 2): ?>
                        <li class="page-item"><span class="page-link page-active">...</span></li>
                    <?php endif; ?>

                    <?php if($tasks->currentPage() < $tasks->lastPage() ): ?>
                        <li class="page-item"><a class="page-link"
                                                 href="<?php echo e($tasks->url($tasks->lastPage())); ?>"><?php echo e($tasks->lastPage()); ?></a>
                        </li>
                        <li class="page-item"><a class="page-link" href="<?php echo e($tasks->nextPageUrl()); ?>">&raquo;</a></li>
                    <?php endif; ?>
                </ul>
            </div>
        </div>
        <!-- /.card -->

        <div class="modal fade" id="taskEditModal">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Edit task</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="alert alert-danger hidden" id="taskEditAlert"></div>
                        <input type="hidden" id="taskEditId" value=""/>
                        <div class="form-group">
                            <label for="taskEditName">Name</label>
                            <input id="taskEditName" type="text" value=""/>
                        </div>
                        <div class="form-group">
                            <label for="taskEditDescription">Description</label>
                            <input id="taskEditDescription" type="text" value=""/>
                        </div>
                        <div class="form-group">
                            <label for="taskEditAssignment">Assignment</label>
                            <input id="taskEditAssignment" type="text" value=""/>
                        </div>
                        <div class="form-group">
                            <label for="taskEditStatus">Status</label>
                            <select class="custom-select rounded-0" name="status" id="taskEditStatus">
                                <option value="<?php echo e(\App\Models\Task::STATUS_CREATED); ?>">Created</option>
                                <option value="<?php echo e(\App\Models\Task::STATUS_IN_PROGRESS); ?>">Progress</option>
                                <option value="<?php echo e(\App\Models\Task::STATUS_DONE); ?>">Done</option>
                            </select>
                        </div>
                        <input id="taskEditCreate_date" type="hidden" value=""/>
                        <div class="form-group">
                        </div>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary" id="taskEditButton">Save changes</button>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="taskDeleteModal">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Delete task</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="alert alert-danger hidden" id="taskDeleteAlert"></div>
                        <input type="hidden" id="taskDeleteId" value=""/>
                        <p>Are you sure you want to delete<span id="taskDeleteName"></span>?</p>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-danger" id="taskDeleteButton">Delete</button>
                    </div>
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>
    </section>
    <!-- /.content -->
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layout.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\practica2021\resources\views/boards/view.blade.php ENDPATH**/ ?>