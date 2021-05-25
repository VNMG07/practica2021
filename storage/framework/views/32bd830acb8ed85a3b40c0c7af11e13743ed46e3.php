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
                <select class="custom-select rounded-0" id="changeBoard">
                    <?php $__currentLoopData = $boards; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $selectBoard): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option <?php if($selectBoard->id === $board->id): ?> selected="selected" <?php endif; ?> value="<?php echo e($selectBoard->id); ?>"><?php echo e($selectBoard->name); ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
            </div>
        </div>
        <!-- /.card -->

        <!-- Default box -->
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Task list</h3>


            </div>


            <div class="card-body">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Description</th>
                            <th>Assignment</th>
                            <th>Status</th>
                            <th>Create Date</th>
                            <th style="width: 40px">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__currentLoopData = $tasks; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $task): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                            <tr>
                                <td><?php echo e($task->name); ?></td>
                                <td><?php echo e($task->description); ?></td>
                                <td><?php echo e($task->assignment ? $task->user->name : '-'); ?></td>
                                <td> <?php if($task->status === \App\Models\Task::STATUS_CREATED): ?>
                                        <span class="badge bg-warning">Created</span>
                                    <?php elseif($task->status === \App\Models\Task::STATUS_IN_PROGRESS): ?>
                                        <span class="badge bg-primary">In progress</span>
                                    <?php else: ?>
                                        <span class="badge bg-success">Done</span>
                                    <?php endif; ?>
                                </td>
                                <td><?php echo e($task->created_at->format('j M Y H:i:s')); ?></td>
                                <td>
                                    <div class="btn-group">
                                        <button class="btn btn-sm btn-primary"
                                                type="button"
                                                data-task="<?php echo e(json_encode($task)); ?>"
                                                data-toggle="modal"
                                                data-target="#taskEditModal">
                                            <i class="fas fa-edit"></i></button>
                                        <?php if($board->user->id === \Illuminate\Support\Facades\Auth::user()->id || \Illuminate\Support\Facades\Auth::user()->role === \App\Models\User::ROLE_ADMIN): ?>
                                        <button class="btn btn-sm bg-navy "
                                                type="button"
                                                data-board="<?php echo e(json_encode($task)); ?>"
                                                data-toggle="modal"
                                                data-target="#taskAddModal">
                                            <i class="fas fa-cog"></i></button>

                                            <button class="btn btn-sm btn-danger"
                                                    type="button"
                                                    data-task="<?php echo e(json_encode($task)); ?>"
                                                    data-toggle="modal"
                                                    data-target="#taskDeleteModal">
                                                <i class="fas fa-trash"></i></button>
                                        <?php endif; ?>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
            </div>

            <!-- /.card-body -->
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
                        <li class="page-item"><a class="page-link" href="<?php echo e($tasks->url($tasks->currentPage() - 1)); ?>"><?php echo e($tasks->currentPage() - 1); ?></a></li>
                    <?php endif; ?>

                    <li class="page-item"><span class="page-link page-active"><?php echo e($tasks->currentPage()); ?></span></li>

                    <?php if($tasks->currentPage() <= $tasks->lastPage() - 2): ?>
                        <li class="page-item"><a class="page-link" href="<?php echo e($tasks->url($tasks->currentPage() + 1)); ?>"><?php echo e($tasks->currentPage() + 1); ?></a></li>
                    <?php endif; ?>

                    <?php if($tasks->currentPage() < $tasks->lastPage() - 2): ?>
                        <li class="page-item"><span class="page-link page-active">...</span></li>
                    <?php endif; ?>

                    <?php if($tasks->currentPage() < $tasks->lastPage() ): ?>
                        <li class="page-item"><a class="page-link" href="<?php echo e($tasks->url($tasks->lastPage())); ?>"><?php echo e($tasks->lastPage()); ?></a></li>
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
                        <input type="hidden" id="taskEditId" value="" />
                        <div class="form-group">
                            <label for="taskEditName">Name</label>
                            <input type="text" class="form-control" id="taskEditName" placeholder="Name">
                        </div>
                        <div class="form-group">
                            <label for="taskEditDescription">Description</label>
                            <textarea class="form-control" id="taskEditDescription" placeholder="Description"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="taskEditAssignment">Assignment</label>
                            <select class="custom-select rounded-0" id="taskEditAssignment">
                                <option value="">Unassigned</option>
                                <?php $__currentLoopData = $boardUsers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $boardUser): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($boardUser->user_id); ?>"><?php echo e($boardUser->user->name); ?></option>
                                
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="taskEditStatus">Status</label>
                            <select class="custom-select rounded-0" id="taskEditStatus">
                                <option value="0">Created</option>
                                <option value="1">In progress</option>
                                <option value="2">Done</option>
                            </select>
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
                        <input type="hidden" id="taskDeleteId" value="" />
                        <p>Are you sure you want to delete: <span id="taskDeleteName"></span>?</p>
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
        <div class="modal fade" id="taskAddModal">
        <div class="modal-dialog">
             <form action="<?php echo e(route('tasks.add',['id' => $board->id])); ?>" method="POST">
                <?php echo csrf_field(); ?>
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Add task</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <?php if($errors->has('name')): ?>
                            <div class="alert alert-danger"><?php echo e($errors->first('name')); ?></div> <?php endif; ?>
                        <div class="form-group">
                            <label for="taskAddName">Name</label>
                            <input type="text" name="name" id="taskAddName" class="form-control <?php if($errors->has('name')): ?> is-invalid <?php endif; ?>" />
                        </div>
                    </div>
                    <div class="modal-body">
                        <?php if($errors->has('description')): ?>
                            <div class="alert alert-danger"><?php echo e($errors->first('description')); ?></div> <?php endif; ?>
                        <div class="form-group">
                            <label for="taskAddDescription">Description</label>
                          <textarea class="form-control" name="description" id="taskAddDescription" class="form-control <?php if($errors->has('description')): ?> is-invalid <?php endif; ?>" /></textarea>
                        </div>
                    </div>
                    <div class="modal-body">
                        <?php if($errors->has('assignment')): ?>
                            <div class="alert alert-danger"><?php echo e($errors->first('assignment')); ?></div> <?php endif; ?>
                            <div class="form-group">
                                 <label for="taskAddAssignment">Assignment</label>
                                 <select class="custom-select rounded-0" name="assignment" id="taskAddAssignment" class="form-control <?php if($errors->has('assignment')): ?> is-invalid <?php endif; ?>">
                                     <option value="">Unassigned</option>
                                     <?php $__currentLoopData = $boardUsers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $boardUser): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                         <option value="<?php echo e($boardUser->user_id); ?>"><?php echo e($boardUser->user->name); ?></option>
                                     <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                 </select>
                             </div>
                             </div>
                    <div class="modal-body">
                        <?php if($errors->has('status')): ?>
                            <div class="alert alert-danger"><?php echo e($errors->first('status')); ?></div> <?php endif; ?>
                            <div class="form-group">
                                      <label for="taskAddStatus">Status</label>
                                      <select class="custom-select rounded-0" id="taskAddStatus" name="status" class="form-control <?php if($errors->has('status')): ?> is-invalid <?php endif; ?>">
                                          <option value="0">Created</option>
                                          <option value="1">In progress</option>
                                          <option value="2">Done</option>
                              </select>
                            </div>

                         <div class="modal-footer justify-content-between">
                             <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                             <button type="submit" class="btn btn-primary" data-dismiss>Add task</button>
                         </div>
                     </div>
                 </form>
                 <!-- /.modal-content -->
             </div>
             <!-- /.modal-dialog -->
         </div>
                      </div>
                      <div class="modal-footer justify-content-between">
                          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                          <button type="submit"   class="btn btn-sm bg-navy "
                                    data-toggle="modal"
                                  data-target="#taskAddModal">Add task</button>
                      </div>
                  </div>
                </div>
            </div>
              </form>

    </section>
    <!-- /.content -->
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layout.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\practica2021\resources\views/boards/view.blade.php ENDPATH**/ ?>