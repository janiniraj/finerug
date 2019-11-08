<div class="panel-body">
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
                </tr>
                </thead>
                <tbody>
                <?php $__currentLoopData = $cartData->getContent(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $singleKey => $singleValue): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <?php 
                            $productData = $productRepository->find($singleValue->attributes->product_id);

                            $images = json_decode($productData->main_image, true);
                         ?>
                        <td><a href="<?php echo e(route('frontend.product.show', $singleValue->attributes->product_id)); ?>"><img class="cart-product-image" src="<?php echo e(admin_url().'/img/products/thumbnail/'.$images[0]); ?>" /></a> </td>
                        <td>
                            <a href="<?php echo e(route('frontend.product.show', $singleValue->attributes->product_id)); ?>"><?php echo e($singleValue->name); ?>

                            </a>
                            <br/>
                            <?php echo e($singleValue->attributes->size); ?>

                        </td>
                        <td>In stock</td>
                        <td><?php echo e($singleValue->quantity); ?></td>
                        <td class="text-right">$ <?php echo e($singleValue->price * $singleValue->quantity); ?></td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td>Sub-Total</td>
                    <td class="text-right">$ <?php echo e($cartData->getSubTotal()); ?></td>
                </tr>

                <?php if($cartData->getConditionsByType('shipping')->count() > 0): ?>
                    <?php 
                        $shippingDetails = $cartData->getConditionsByType('shipping')->first();
                     ?>
                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td>PromoCode (<?php echo e($promoCodeDetails->getName()); ?>)</td>
                        <td class="text-right"><?php echo e($promoCodeDetails->getValue()); ?></td>
                    </tr>
                <?php endif; ?>

                <?php if($cartData->getConditionsByType('promo')->count() > 0): ?>
                    <?php 
                        $promoCodeDetails = $cartData->getConditionsByType('promo')->first();
                     ?>
                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td>PromoCode (<?php echo e($promoCodeDetails->getName()); ?>)</td>
                        <td class="text-right"><?php echo e($promoCodeDetails->getValue()); ?></td>
                    </tr>
                <?php endif; ?>

                <?php if($cartData->getConditionsByType('coupon')->count() > 0): ?>
                    <?php $__currentLoopData = $cartData->getConditionsByType('coupon'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $couponK => $couponV): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td><?php echo e($couponV->getName()); ?></td>
                            <td class="text-right">$ <?php echo e(str_replace('+', '', $couponV->getValue())); ?></td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>                    
                <?php endif; ?>

                <tr>
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
</div>