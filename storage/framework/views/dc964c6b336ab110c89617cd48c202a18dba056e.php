<?php $__env->startSection('title', 'Product Management'); ?>

<?php $__env->startSection('after-styles'); ?>
    <?php echo e(Html::style("https://cdn.datatables.net/v/bs/dt-1.10.15/datatables.min.css")); ?>

    
<?php $__env->stopSection(); ?>

<?php $__env->startSection('page-header'); ?>
    <h1>Inventory Management</h1>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="box box-success">
        <div class="box-header with-border">
            <h3 class="box-title">Inventory Management</h3>
            <div class="col-md-8 pull-right">
                <form action="<?php echo e(route('admin.product.inventory-management')); ?>" method="GET"> 
                  <div class="row">
                    <div class="col-xs-6 col-md-4">
                      <div class="input-group">
                        <input type="text" name="q" value="<?php echo e(isset($_GET['q']) ? $_GET['q'] : ''); ?>" class="form-control" placeholder="Search" id="txtSearch"/>
                        <div class="input-group-btn">
                          <button class="btn btn-primary" type="submit">
                            <span class="glyphicon glyphicon-search"></span>
                          </button>
                        </div>
                      </div>
                    </div>
                  </div>
                </form>   
            </div>
            <div class="box-tools pull-right">
                             
                <button class="btn btn-success save-all">Save All</button>
            </div>
        </div><!-- /.box-header -->

        <div class="box-body">
            <?php echo e(Form::open(['route' => 'admin.product.inventory-management-store', 'class' => 'form-horizontal', 'role' => 'form', 'method' => 'post', 'id' => 'priceManagementForm', 'files' => true])); ?>

            <div class="table-responsive">
                <table id="products-table" class="table table-condensed table-hover table-bordered">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Product Name</th>
                            <th>SKU</th>
                            <th>Type</th>
                            <th>In Stock</th>
                            <th>Size - Quantity</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr productid="<?php echo e($value->id); ?>">
                            <input type="hidden" name="data[<?php echo e($key); ?>][id]" value="<?php echo e($value->id); ?>" />
                            <td><?php echo e($value->id); ?></td>
                            <td><?php echo e($value->name); ?></td>
                            <td><?php echo e($value->sku); ?></td>
                            <td><?php echo e($value->type); ?></td>
                            <td>
                                <select class="form-control" name="data[<?php echo e($key); ?>][is_stock]">
                                    <option <?php echo e($value->is_stock == 1 ? 'selected' : ''); ?> value="1">In Stock</option>
                                    <option <?php echo e($value->is_stock == 0 ? 'selected' : ''); ?> value="0">Out of Stock</option>
                                </select>
                            </td>
                            <td>
                                <table class="table table-condensed table-hover table-bordered">
                                    <tbody>
                                        <?php $__currentLoopData = $value->size; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sKey => $sValue): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <tr>
                                                <input type="hidden" name="data[<?php echo e($key); ?>][size][<?php echo e($sKey); ?>][id]" value="<?php echo e($sValue->id); ?>" />
                                                <td><?php echo e(($sValue->width+0).' x '. ($sValue->length+0)); ?></td>
                                                <td>
                                                    <input type="number" class="form-control size_price_input" name="data[<?php echo e($key); ?>][size][<?php echo e($sKey); ?>][quantity]" placeholder="Quantity" value="<?php echo e($sValue->quantity); ?>" width="<?php echo e($sValue->width); ?>" length="<?php echo e($sValue->length); ?>" />
                                                </td>
                                            </tr>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </tbody>
                                </table>
                            </td>
                        </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
            </div><!--table-responsive-->
            <?php echo e(Form::close()); ?>

        </div><!-- /.box-body -->
    </div><!--box-->
    <?php echo $products->links(); ?>

    <div class="box box-info">
        <div class="box-header with-border">
            <h3 class="box-title"><?php echo e(trans('history.backend.recent_history')); ?></h3>
            <div class="box-tools pull-right">
                <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
            </div><!-- /.box tools -->
        </div><!-- /.box-header -->
        <div class="box-body">
            <?php echo history()->renderType('Product'); ?>

        </div><!-- /.box-body -->
    </div><!--box box-success-->
<?php $__env->stopSection(); ?>

<?php $__env->startSection('after-scripts'); ?>
    <?php echo e(Html::script("https://cdn.datatables.net/v/bs/dt-1.10.15/datatables.min.js")); ?>

    <?php echo e(Html::script("js/backend/plugin/datatables/dataTables-extend.js")); ?>


    <script>
        $(document).ready(function(){
            $(".sidebar-toggle").click();
            $(".save-all").on("click", function(e){
                e.preventDefault();

                $("#priceManagementForm").submit();
            });
            $(".size_price_input").on("change", function(){
                var width = parseFloat($(this).attr("width"));
                var length = parseFloat($(this).attr("length"));
                var currentval = parseFloat($(this).val());

                $(this).closest('td').find(".size_price_span").text("$"+parseFloat(width*length*currentval).toFixed(2));
            });
            $(".size_price_affiliate_input").on("change", function(){
                var width = parseFloat($(this).attr("width"));
                var length = parseFloat($(this).attr("length"));
                var currentval = parseFloat($(this).val());

                $(this).closest('td').find(".size_price_affiliate_span").text("$"+parseFloat(width*length*currentval).toFixed(2));
            });
        });
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('backend.layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>