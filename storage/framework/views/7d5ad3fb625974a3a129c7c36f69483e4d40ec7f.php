<?php $__env->startSection('title', trans('labels.backend.activities.management')); ?>

<?php $__env->startSection('after-activities'); ?>
    <?php echo e(Html::style("css/backend/plugin/datatables/dataTables.bootstrap.min.css")); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('page-header'); ?>
    <h1><?php echo e(trans('labels.backend.activities.management')); ?></h1>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="box box-success">
        <div class="box-header with-border">
            <h3 class="box-title"><?php echo e(trans('labels.backend.activities.management')); ?></h3>

            <div class="box-tools pull-right">
                
            </div>
        </div><!-- /.box-header -->

        <div class="box-body">
            <div class="table-responsive data-table-wrapper">
                <table id="activities-table" class="table table-condensed table-hover table-bordered">
                    <thead>
                        <tr>
                            <th>Product</th>
                            <th><?php echo e(trans('labels.backend.activities.table.title')); ?></th>
                            <th><?php echo e(trans('labels.backend.activities.table.createdat')); ?></th>
                            <th></th>
                        </tr>
                    </thead>
                    <thead class="transparent-bg">
                        <tr>
                            <th>

                            </th>
                            <th>
                                
                            </th>
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
            var dataTable = $('#activities-table').dataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: '<?php echo e(route("admin.activities.get")); ?>',
                    type: 'post'
                },
                columns: [
                    {data: 'name', name: 'products.name'},
                    {data: 'actvity', name: '<?php echo e(config('access.activity_table')); ?>.actvity'},
                    {data: 'created_at', name: '<?php echo e(config('access.activity_table')); ?>.created_at'},
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