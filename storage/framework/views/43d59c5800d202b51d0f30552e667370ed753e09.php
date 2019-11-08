<?php $__env->startSection('after-styles'); ?>
  <?php echo e(Html::style('/frontend/css/cart.css')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<div class="container" id="results-page">
    <div class="section">
        <div class="row">
        <div class="col-md-12">
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th scope="col"> </th>
                            <th scope="col">Product</th>
                            <th scope="col">Available</th>
                            <th scope="col" class="text-center">Quantity</th>
                            <th scope="col" class="text-right">Price</th>
                            <th> </th>
                        </tr>
                    </thead>
                    <tbody>                                       
                        <?php $__currentLoopData = $cartData->getContent(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $singleKey => $singleValue): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <?php  
                                $productData = $productRepository->find($singleValue->attributes->product_id);

                                $images = json_decode($productData->main_image, true);
								
                                 ?>
                                
                                <td><a href="<?php echo e(route('frontend.product.show', $singleValue->attributes->product_id)); ?>"><img class="cart-product-image" src="/img/products/thumbnail/<?php echo e($images[0]); ?>" /></a> </td>
                                <td>
                                <a href="<?php echo e(route('frontend.product.show', $singleValue->attributes->product_id)); ?>"><?php echo e($singleValue->name); ?>

                                </a>
                                <br/>
                                <?php echo e($singleValue->attributes->size); ?>                                
                                </td>
                                <td>In stock</td>
                                <?php echo e(Form::open(['route' => 'frontend.checkout.cart-update', 'class' => 'form-horizontal cart-update', 'role' => 'form', 'method' => 'post'])); ?>

                                    <?php echo e(Form::hidden('item_id', $singleKey)); ?>

                                    <td><input name="quantity" class="form-control input-quantity" type="number" min="0" value="<?php echo e($singleValue->quantity); ?>" /><button class="btn btn-sm btn-quantity">Update</button></td>
                                    <td class="text-right">$ <?php echo e($singleValue->price * $singleValue->quantity); ?></td>
                                <?php echo e(Form::close()); ?>

                                <td class="text-right"><a href="<?php echo e(route('frontend.checkout.cart.remove-item', $singleKey)); ?>" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i> </a> </td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <?php echo e(Form::open(['route' => 'frontend.checkout.apply-promo', 'class' => 'form-horizontal', 'role' => 'form', 'method' => 'post'])); ?>

                                <td><input type="text" name="promocode" placeholder="Promo Code" class="form-control"></td>
                                <td class="text-right"><button class="btn btn-sm btn-quantity btn-success">Apply</button></td>
                            <?php echo e(Form::close()); ?>

                        </tr>

                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td>Sub-Total</td>
                            <td class="text-right">$ <?php echo e($cartData->getSubTotal()); ?></td>
                        </tr>

                        <?php if($cartData->getConditionsByType('promo')->count() > 0): ?>
                            <?php 
                                $promoCodeDetails = $cartData->getConditionsByType('promo')->first();
                             ?>
                            <tr>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td>PromoCode (<?php echo e($promoCodeDetails->getName()); ?>)<a href="<?php echo e(route('frontend.checkout.remove-promo')); ?>" class="btn btn-sm btn-default btn-quantity">Remove</a></td>
                                <td class="text-right"><?php echo e($promoCodeDetails->getValue()); ?></td>
                            </tr>
                        <?php endif; ?>
                        
                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td><strong>Total</strong></td>
                            <td class="text-right"><strong>$ <?php echo e($cartData->getTotal()); ?></strong></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="col-md-12">
            <div class="row">
                <div class="col-sm-12  col-md-6">
                    <button onclick='function test(){ window.location = "<?php echo url()->previous(); ?>"; } test();' class="btn btn-block btn-light">Continue Shopping</button>
                </div>
                <div class="col-sm-12 col-md-6 text-right">
                    <a href="<?php echo e(route('frontend.checkout.checkout')); ?>" class="btn btn-lg btn-block btn-success text-uppercase">Checkout</a>
                </div>
            </div>
        </div>
    </div>
    </div>
</div><!-- container -->
<?php $__env->stopSection(); ?>

<?php $__env->startSection('after-scripts'); ?>
<script>
    
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('frontend.layouts.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>