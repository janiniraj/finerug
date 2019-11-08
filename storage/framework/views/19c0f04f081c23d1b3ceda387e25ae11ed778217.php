<?php $__env->startSection('title', trans('labels.backend.subcategories.management') . ' | ' . trans('labels.backend.subcategories.create')); ?>

<?php $__env->startSection('page-header'); ?>
    <h1>
        <?php echo e(trans('labels.backend.subcategories.management')); ?>

        <small><?php echo e(trans('labels.backend.subcategories.create')); ?></small>
    </h1>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <?php echo e(Form::open(['route' => 'admin.subcategories.store', 'class' => 'form-horizontal', 'role' => 'form', 'method' => 'post', 'id' => 'create-permission', 'files' => true])); ?>


        <div class="box box-success">
            <div class="box-header with-border">
                <h3 class="box-title"><?php echo e(trans('labels.backend.subcategories.create')); ?></h3>

                <div class="box-tools pull-right">
                    <?php echo $__env->make('backend.includes.partials.subcategories-header-buttons', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                </div><!--box-tools pull-right-->
            </div><!-- /.box-header -->

            
            <div class="box-body">
                <div class="form-group">
                    <?php echo $__env->make("backend.subcategories.form", array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                    <div class="edit-form-btn">
                    <?php echo e(link_to_route('admin.subcategories.index', trans('buttons.general.cancel'), [], ['class' => 'btn btn-danger btn-md'])); ?>

                    <?php echo e(Form::submit(trans('buttons.general.crud.create'), ['class' => 'btn btn-primary btn-md'])); ?>

                    <div class="clearfix"></div>
                </div>
            </div>
        </div><!--box-->
    </div>
    <?php echo e(Form::close()); ?>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('backend.layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>