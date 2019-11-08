<?php $__env->startSection('title', trans('labels.backend.mailinglists.management')); ?>

<?php $__env->startSection('after-mailinglists'); ?>
    <?php echo e(Html::style("css/backend/plugin/datatables/dataTables.bootstrap.min.css")); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('page-header'); ?>
    <h1><?php echo e(trans('labels.backend.mailinglists.management')); ?></h1>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="box box-success">
        <div class="box-header with-border">
            <h3 class="box-title"><?php echo e(trans('labels.backend.mailinglists.management')); ?></h3>

        </div><!-- /.box-header -->

        <div class="box-body">
            <div class="table-responsive data-table-wrapper">
                <table id="mailinglists-table" class="table table-condensed table-hover table-bordered">
                    <thead>
                        <tr>
                            <th><?php echo e(trans('labels.backend.mailinglists.table.firstname')); ?></th>
                            <th><?php echo e(trans('labels.backend.mailinglists.table.lastname')); ?></th>
                            <th><?php echo e(trans('labels.backend.mailinglists.table.email')); ?></th>
                            <th><?php echo e(trans('labels.backend.mailinglists.table.address')); ?></th>
                            <th><?php echo e(trans('labels.backend.mailinglists.table.pobox')); ?></th>
                            <th><?php echo e(trans('labels.backend.mailinglists.table.phone')); ?></th>
                            <th><?php echo e(trans('labels.backend.mailinglists.table.createdat')); ?></th>
                            <th><?php echo e(trans('labels.general.actions')); ?></th>
                        </tr>
                    </thead>
                    <thead class="transparent-bg">
                        <tr>
                            <th>
                                <?php echo Form::text('firstname', null, ["class" => "search-input-text form-control", "data-column" => 0, "placeholder" => trans('labels.backend.mailinglists.table.firstname')]); ?>

                                    <a class="reset-data" href="javascript:void(0)"><i class="fa fa-times"></i></a>
                            </th>
                            <th>
                                <?php echo Form::text('lastname', null, ["class" => "search-input-text form-control", "data-column" => 0, "placeholder" => trans('labels.backend.mailinglists.table.lastname')]); ?>

                                <a class="reset-data" href="javascript:void(0)"><i class="fa fa-times"></i></a>
                            </th>
                            <th>
                                <?php echo Form::text('email', null, ["class" => "search-input-text form-control", "data-column" => 0, "placeholder" => trans('labels.backend.mailinglists.table.email')]); ?>

                                <a class="reset-data" href="javascript:void(0)"><i class="fa fa-times"></i></a>
                            </th>
                            <th>
                                <?php echo Form::text('address', null, ["class" => "search-input-text form-control", "data-column" => 0, "placeholder" => trans('labels.backend.mailinglists.table.address')]); ?>

                                    <a class="reset-data" href="javascript:void(0)"><i class="fa fa-times"></i></a>
                            </th>
                            <th>
                                <?php echo Form::text('pobox', null, ["class" => "search-input-text form-control", "data-column" => 0, "placeholder" => trans('labels.backend.mailinglists.table.pobox')]); ?>

                                    <a class="reset-data" href="javascript:void(0)"><i class="fa fa-times"></i></a>
                            </th>
                            <th>
                                <?php echo Form::text('phone', null, ["class" => "search-input-text form-control", "data-column" => 0, "placeholder" => trans('labels.backend.mailinglists.table.phone')]); ?>

                                    <a class="reset-data" href="javascript:void(0)"><i class="fa fa-times"></i></a>
                            </th>
                            <th></th>
                            <th></th>
                            <th></th>
                        </tr>
                    </thead>
                </table>
            </div><!--table-responsive-->
        </div><!-- /.box-body -->
    </div><!--box-->

    <!--<div class="box box-info">
        <div class="box-header with-border">
            <h3 class="box-title"><?php echo e(trans('history.backend.recent_history')); ?></h3>
            <div class="box-tools pull-right">
                <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
            </div><!-- /.box tools -->
        </div><!-- /.box-header -->
        <div class="box-body">
            
        </div><!-- /.box-body -->
    </div><!--box box-success-->
<?php $__env->stopSection(); ?>

<?php $__env->startSection('after-scripts'); ?>
    
    <?php echo $__env->make('includes.datatables', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    
    <script>
        $(function() {
            var dataTable = $('#mailinglists-table').dataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: '<?php echo e(route("admin.mailinglists.get")); ?>',
                    type: 'post'
                },
                columns: [
                    {data: 'firstname', name: '<?php echo e(config('access.mailinglist_table')); ?>.firstname'},
                    {data: 'lastname', name: '<?php echo e(config('access.mailinglist_table')); ?>.lastname'},
                    {data: 'email', name: '<?php echo e(config('access.mailinglist_table')); ?>.email'},
                    {data: 'address', name: '<?php echo e(config('access.mailinglist_table')); ?>.address'},
                    {data: 'pobox', name: '<?php echo e(config('access.mailinglist_table')); ?>.pobox'},
                    {data: 'phone', name: '<?php echo e(config('access.mailinglist_table')); ?>.phone'},
                    {data: 'created_at', name: '<?php echo e(config('access.mailinglist_table')); ?>.created_at'},
                    {data: 'actions', name: 'actions', searchable: false, sortable: false}
                ],
                order: [[3, "asc"]],
                searchDelay: 500,
                dom: 'lBfrtip',
                buttons: {
                    buttons: [
                        { extend: 'copy', className: 'copyButton',  exportOptions: {columns: [ 0, 1, 2, 3 ]  }},
                        { extend: 'csv', className: 'csvButton',  exportOptions: {columns: [ 0, 1, 2, 3 ]  }},
                        { extend: 'excel', className: 'excelButton',  exportOptions: {columns: [ 0, 1, 2, 3 ]  }},
                        { extend: 'pdf', className: 'pdfButton',  exportOptions: {columns: [ 0, 1, 2, 3 ]  }},
                        { extend: 'print', className: 'printButton',  exportOptions: {columns: [ 0, 1, 2, 3 ]  }}
                    ]
                }
            });

            FinBuilders.DataTableSearch.init(dataTable);
        });
    </script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('backend.layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>