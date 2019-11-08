<?php $__env->startSection('title', 'Product Management'); ?>

<?php $__env->startSection('after-styles'); ?>
    <?php echo e(Html::style("https://cdn.datatables.net/v/bs/dt-1.10.15/datatables.min.css")); ?>

    
<?php $__env->stopSection(); ?>

<?php $__env->startSection('page-header'); ?>
    <h1>Price Management</h1>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="box box-success">
        <div class="box-header with-border">
            <h3 class="box-title">Price Management</h3>
            <div class="col-md-8 pull-right">
                <form action="<?php echo e(route('admin.product.price-management')); ?>" method="GET"> 
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
            <?php echo e(Form::open(['route' => 'admin.product.price-management-store', 'class' => 'form-horizontal', 'role' => 'form', 'method' => 'post', 'id' => 'priceManagementForm', 'files' => true])); ?>

            <div class="table-responsive">
                <table id="products-table" class="table table-condensed table-hover table-bordered">
                    <thead>
                        <!--<tr>
                            <th>ID</th>
                            <th>Product Name</th>
                            <th>SKU</th>
                            <th>Type</th>
                            <th>Price MSRP Per Sq. Feet </th>
                            <th>Map Price Per Sq. Feet </th>
                            <th>Size - MSRP Price  - MAP Price </th>
                        </tr>-->
                        <tr>
                            <th>ID</th>
                            <th>Product Name</th>
                            <th>SKU</th>
                            <th>Type</th>
                            <th>Price MSRP Per Sq. Feet </th>
                            <th>Map Price Per Sq. Feet </th>
                            <th>Size - Price - MAP Price - MSRP Price</th>
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
                                <input type="number" class="form-control price_input" name="data[<?php echo e($key); ?>][price]" value="<?php echo e($value->price); ?>" placeholder="Price Per Sq. Feet" />
                                <span class="price_span"></span>
                            </td>
                            <td>
                                <input type="number" class="form-control price_affiliate_input" name="data[<?php echo e($key); ?>][price_affiliate]" value="<?php echo e($value->price_affiliate); ?>" placeholder="Price Per Sq. Feet (Affiliate)" />
                                <span class="price_affiliate_span"></span>
                            </td>
                            <td>
                                <table class="table table-condensed table-hover table-bordered">
                                    <tbody>
                                        <?php $__currentLoopData = $value->size; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sKey => $sValue): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <tr>
                                                <input type="hidden" name="data[<?php echo e($key); ?>][size][<?php echo e($sKey); ?>][id]" value="<?php echo e($sValue->id); ?>" />
                                                 <td><?php echo e(($sValue->width+0).' x '. ($sValue->length+0)); ?></td>
                                                <td>
                                                    <input type="number" class="form-control size_price_input" name="data[<?php echo e($key); ?>][size][<?php echo e($sKey); ?>][price]" placeholder="Price" value="<?php echo e($sValue->price); ?>" width="<?php echo e($sValue->width); ?>" length="<?php echo e($sValue->length); ?>" />
                                                    <span class="size_price_span" >$<?php echo e(number_format($sValue->width*$sValue->length*$sValue->price, 2, '.', '')); ?></span>
                                                </td>
                                                <td>
                                                    <input type="number" class="form-control size_price_affiliate_input" name="data[<?php echo e($key); ?>][size][<?php echo e($sKey); ?>][price_affiliate]" placeholder="Price (Affiliate)" value="<?php echo e($sValue->price_affiliate); ?>" width="<?php echo e($sValue->width); ?>" length="<?php echo e($sValue->length); ?>" />
                                                    <span class="size_price_affiliate_span">$<?php echo e(number_format($sValue->width*$sValue->length*$sValue->price_affiliate, 2, '.', '')); ?></span>
                                                </td>
												  <td>
                                                    <input type="number" class="form-control size_msrp_input" name="data[<?php echo e($key); ?>][size][<?php echo e($sKey); ?>][msrp]" placeholder="MSRP " value="<?php echo e($sValue->msrp); ?>" width="<?php echo e($sValue->width); ?>" length="<?php echo e($sValue->length); ?>" />
                                                    <span class="size_msrp_span">$<?php echo e(number_format($sValue->width*$sValue->length*$sValue->msrp, 2, '.', '')); ?></span>
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
            $(".size_msrp_input").on("change", function(){
                var width = parseFloat($(this).attr("width"));
                var length = parseFloat($(this).attr("length"));
                var currentval = parseFloat($(this).val());

                $(this).closest('td').find(".size_msrp_span").text("$"+parseFloat(width*length*currentval).toFixed(2));
            });

		});
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('backend.layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>