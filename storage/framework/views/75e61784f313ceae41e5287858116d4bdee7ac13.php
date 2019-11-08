<?php $__env->startSection('content'); ?>

    <section class="py-5">
    	<div class="container">
        	<div class="breadcrumb-cust pb-4" style='display:none'>
            	<a href="#">Home Goods</a> <span>/</span> <a href="#">Home Decor</a> <span>/</span> <a href="#">Rugs</a> <span>/</span> Area Rugs
            </div>
            
            <div class="row">
				<?php 
					$images = json_decode($product->main_image, true);
				 ?>
            	<div class="col-lg-6 pb-5">
					<div class="xzoom-container col-md-12">
					<?php if(count($images)): ?>
                        <img class="xzoom" id="xzoom-default" src="<?php echo e(url('/'). '/img/products/thumbnail/'.$images[0]); ?>" xoriginal="<?php echo e(url('/'). '/img/products/'.$images[0]); ?>" />
                        <div class="xzoom-thumbs">
                            <?php $__currentLoopData = $images; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $singleKey => $singleValue): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <a href="<?php echo e(url('/'). '/img/products/'.$singleValue); ?>"><img class="xzoom-gallery" width="80" src="<?php echo e(url('/'). '/img/products/thumbnail/'.$singleValue); ?>" ></a>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
					<?php endif; ?>	
                    </div>
				
				<?php /*
                	<div class="pro_gallery">
                    	<div class="outer">
						@php
							$images = json_decode($product->main_image, true);
						@endphp
 						
                            <div id="big" class="xzoom-container owl-carousel owl-theme">
							@foreach($images as $singleKey => $singleValue)
                              <div class="xzoom-main-image-container item"><img src="{{ url('/'). '/img/products/thumbnail/'.$singleValue }}" class="xzoom" id="xzoom-default" xoriginal="{{ url('/'). '/img/products/'.$singleValue }}" alt=""/></div>
							@endforeach  
                            </div>
                            <div id="thumbs" class="owl-carousel owl-theme">
							@foreach($images as $singleKey => $singleValue)
                              <div class="item"><img src="{{ url('/'). '/img/products/thumbnail/'.$singleValue }}" alt=""/></div>
							@endforeach  
                            </div>
                        </div>
                    </div>
					*/?>
                </div>
                <div class="col-lg-6 pb-5">
                	<div class="pro-right-top">
                        <h2 class="pro-name"><?php echo e($product->name); ?></h2>
                        <div class="pro-code">ITEM# <?php echo e($product->sku); ?></div>
						<?php if(count($product->size)): ?>
							<?php
							$msrpPriceArray = $imapPriceArray = array();
							foreach($product->size as $single){
								$msrpPriceArray[$single->id] = $single->length*$single->width*$single->msrp;
								$imapPriceArray[$single->id]['imap'] = $single->length*$single->width*$single->price_affiliate;
								
							}
							$valArr = array_keys($msrpPriceArray, min($msrpPriceArray));
							$size_id = $valArr[0];
							$defaultPrice = min($msrpPriceArray);
							$defaultPriceImap = $imapPriceArray[$size_id]['imap'];
							//exit;
							?>
						<?php endif; ?>
                        <div class="pro-price py-4">
                            <span>Sale Starts at</span><span id="cost">$<?php echo e($defaultPriceImap); ?> </span><strike style="font-size:20px"><span id="imap">$<?php echo e($defaultPrice); ?></span></strike>
                        </div>
                        <div class="pro-options bg-gray px-3 pt-3 pb-0">
				<?php echo e(Form::open(['method' => 'GET','id'=> 'cartForm','name'=> 'cartForm'])); ?>

							<input type="hidden" name="productid" id="productid" value="<?php echo e($product->id); ?>">
                                <div class="row">
                                    <div class="col-md-6">
									   <select class="custom-select mb-3" id='sizeid' name='sizeid'>
                                        <option selected value=''>Choose Size</option>
										<?php if(count($product->size)): ?>
                                            <?php $__currentLoopData = $product->size; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $single): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
												<option <?php echo e($single->id == $size_id ? 'selected' : ''); ?> value="<?php echo e($single->id); ?>"><?php echo e($single->width+0); ?>x<?php echo e($single->length+0); ?></option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        <?php endif; ?>
                                        </select>
                                    </div>
                                    <div class="col-md-6">
                                        <select class="custom-select  mb-3" id='colorid' name='colorid'>
                                          <option selected>Choose Color</option>
										  <?php $__currentLoopData = $colorList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $single): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                          <option value="<?php echo e($single->color_id); ?>" ><?php echo e($single->display_name); ?></option>
										  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <select class="custom-select mb-3" id="quantity" name="quantity">
                                        </select>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="py-4 pro-btns">
                            <a href="#" class="btn btn-dark px-3 b-r-3 mb-2"><i class="fas fa-heart"></i></a>
                            <a href="#" class="btn btn-danger b-r-3 mb-2" id='add_to_cart'><i class="fas fa-shopping-cart"></i> Add to Cart</a>
                            <a href="<?php echo e(route('frontend.product.makean-offer-user')); ?>" data-toggle="modal" data-target="#make-an-offer" class="btn  btn-primary b-r-3 mb-2"><i class="fas fa-tag"></i> Make an Offer</a>
                        </div>
                    </div>
				</form>

                    <div class="pro-right-bottom p-3 bg-gray">
                    	<div class="row align-items-center">
                        	<div class="col-sm-6">
                            	<a href="<?php echo e(route('frontend.checkout.cart')); ?>" class="btn btn-info border-0 b-r-3"><i class="fas fa-cart-arrow-down"></i> View Cart</a>
                            </div>
                            <div class="col-sm-6 text-sm-right">
                            	<div class="pro-share d-inline-block">
                                	<label>Share This Product:</label>
                                    <ul class="list-unstyled m-0">
                                    	<li><a href="#" class="email"><i class="fas fa-envelope"></i></a></li>
                                        <li><a href="#" class="facebook"><i class="fab fa-facebook-f"></i></a></li>
                                        <li><a href="#" class="twitter"><i class="fab fa-twitter"></i></a></li>
                                        <li><a href="#" class="pinterest"><i class="fab fa-pinterest-p"></i></a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
            	<div class="col-lg-6 pb-5">
                	<div class="specification bg-gray-dark p-1">
                    	<h2>specification</h2>
                        <div class="bg-white p-3">
                        	<ul class="list-unstyled m-0">
                            	<li>
                                	<label>SKU</label>
                                    <p>ITEM#: <?php echo e($product->sku); ?></p>
                                </li>
                                <li>
                                	<label>COLLECTION </label>
                                    <p><?php echo e(!empty($product->subcategory) ? $product->subcategory->subcategory : ''); ?></p>
                                </li>
                                <li> 
                                	<label>NAME</label>
                                    <p><?php echo e($product->name); ?></p>
                                </li>
                                <li>
                                	<label>COLOR </label>
                                    <p><?php echo e((isset($product->color) && $product->color) ? '<span class="color-btn" style="background-color: '.$product->color->name.'"> </span>' : ''); ?></p>
                                </li>
                                <li>
                                	<label>WAEVES</label>
                                    <p><?php echo e($product->waevesName); ?></p>
                                </li>
                                <li>
                                	<label>Availability </label>
									<p><?php echo e(($product->is_stock>0) ? 'Yes' : 'No'); ?></p>
                                </li>
                                <li>
                                	<label>Brand</label>
                                    <p><?php echo e($product->brand); ?></p>
                                </li>
                                <li>
                                	<label>COUNTRY OF ORGINE</label>
                                    <p><?php echo e($product->country_origin); ?></p>
                                </li>
                                <li>
                                	<label>Shape </label>
                                    <p><?php echo e($product->shape); ?></p>
                                </li>
                                <li>
                                	<label>Style</label>
                                    <p><?php echo e((isset($product->style) && $product->style) ? $product->style->name : ''); ?></p>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 pb-5">
                	<div class="pro-details">
                    	<h3 class="text-uppercase h6">Details</h3>
                        <div class="bg-gray p-3">
                        	<h6>ITEM#: <?php echo e($product->sku); ?></h6>
                            <p><?php echo e($product->detail); ?></p>
                        </div>
                    </div>
            	</div>
            </div>
        </div>
    </section>
    
    <section class="pb-5">
    	<div class="container">
        	<h2 class="h3 font-weight-bold text-uppercase mb-4">Customer Reviews</h2>
            <div class="row align-items-center">
            	<div class="col-sm-6">
                	<div class="review-point">
                    	<div class="row align-items-center">
                        	<div class="col-auto">
                            	<h2><?php echo e(count($reviews)); ?></h2>
                            </div>
                            <div class="col-auto">
							 <?php if(count($reviews) > 0): ?>
                            	<div class="stars">
								<?php for($i = 1; $i <= 5; $i++): ?>
									<i class="<?php echo e($i <= $averageStar ? 'fas' : 'far'); ?> fa-star"></i>
                                <?php endfor; ?>
								</div>
                            	<p><?php echo e(count($reviews)); ?> Reviews</p>
							<?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 text-sm-right">
                	<a href="#" class="btn btn-dark b-r-3 border-0 mb-2">See All Reviews</a>
                    <a href="#writeReview" class="btn btn-danger b-r-3 border-0 mb-2" onclick="document.getElementById('writeReview').style.display='block';">Write a Review</a>
                </div>	
            </div>
            <div class="py-4">
            	<ul class="rating-bars list-unstyled m-0">
                	<li>
                    	<label>5 Stars</label>
                        <div class="bar">
                        	<span style="width:70%"></span>
                        </div>
                        <div class="p-review">1447</div>
                    </li>
                    <li>
                    	<label>4 Stars</label>
                        <div class="bar">
                        	<span style="width:50%"></span>
                        </div>
                        <div class="p-review">427</div>
                    </li>
                    <li>
                    	<label>3 Stars</label>
                        <div class="bar">
                        	<span style="width:25%"></span>
                        </div>
                        <div class="p-review">138</div>
                    </li>
                    <li>
                    	<label>2 Stars</label>
                        <div class="bar">
                        	<span style="width:15%"></span>
                        </div>
                        <div class="p-review">75</div>
                    </li>
                    <li>
                    	<label>1 Stars</label>
                        <div class="bar">
                        	<span style="width:5%"></span>
                        </div>
                        <div class="p-review">35</div>
                    </li>
                </ul>
            </div>
            <div class="comment-sort my-3">
            	<form class="form-inline">
                              <div class="form-group small mr-4">
                                <label for="inputPassword6" class="d-none d-sm-inline-block">Sort By</label>
                                <select class="custom-select custom-select-sm ml-sm-3">
                                  <option selected="">Most Relevant</option>
                                  <option value="1">One</option>
                                  <option value="2">Two</option>
                                  <option value="3">Three</option>
                                </select>
                              </div>
                              <div class="form-group small">
                                <label for="inputPassword6" class="d-none d-sm-inline-block">Filter By</label>
                                <select class="custom-select custom-select-sm ml-sm-3">
                                  <option selected="">All Ratings</option>
                                  <option value="1">One</option>
                                  <option value="2">Two</option>
                                  <option value="3">Three</option>
                                </select>
                              </div>
                 </form>
            </div>
			<div id="writeReview"  style='display:none'>
                        <?php echo e(Form::open(array('url' => route('frontend.product.write-review'), 'id' => 'write_review_form'))); ?>

                            
                            <div class="form-group">
                                <label for="score">Score:</label>
                                <div id="reviewDiv"></div>
                                <input type="hidden" value="2" required id="reviewInput" name="star">
                                <input type="hidden" value="<?php echo e($product->id); ?>" name="product_id">
                            </div>

                            <div class="form-group">
                                <label for="title">Title:</label>
                                <input type="text" class="form-control" required id="title" name="title">
                            </div>

                            <div class="form-group">
                                <label for="review">Review:</label>
                                <textarea class="form-control" rows="5" required id="review" name="content"></textarea>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <button class="btn btn-submit pull-right" type="submit">Submit</button>
                                </div>
                            </div>
                            
                        <?php echo e(Form::close()); ?>

                    </div>
			<?php if(count($reviews) > 0): ?>		
				<?php $__currentLoopData = $reviews; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $single): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
					<div class="review-grid border">
						<div class="p-3 border-bottom">
							<h2 class="font-weight-bold"><?php echo e($single->title); ?></h2>
							<div class="single_rating py-2">
							
                                <?php for($i = 1; $i <= 5; $i++): ?>
									<i class="<?php echo e($i <= $single->star ? 'fas' : 'far'); ?> fa-star"></i>
                                <?php endfor; ?>
                                    
								<span class="d-inline-block px-3">Option: 7'9" x 10'10" - Latte</span>
							</div>
							<div class="rewview-content">
								<p><?php echo e($single->content); ?></p>
							</div>
							<a href="#">Read More <i class="fas fa-sort-down"></i></a>
						</div>
						<div class="p-3"><?php echo e($single->first_name . ' ' . $single->last_name); ?>  </div>
					</div>
				<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
			<?php else: ?>
				<div class="alert alert-warning">
					No Reviews yet.
				</div>                              
			<?php endif; ?>
			
        </div>
    </section>
    
    <section class="pb-5">
    	<div class="container">
        	<h2 class="h3 font-weight-bold text-uppercase mb-4">you might like it</h2>
            <div class="px-5 px-sm-0">
        	<div id="pro_scroll" class="owl-carousel">
				<?php $__currentLoopData = $productLike; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $singleProduct): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
					<?php  $images = json_decode($singleProduct->main_image, true);  ?>
					<div class="item">
						<div class="pro-grid sale_on favourite_on">
							<figure>
								<div class="sale">Sale</div>
								<a href="#" class="pro_favourite"><i class="fas fa-heart"></i></a>
								<a href="<?php echo e(route('frontend.product.show', $singleProduct->id)); ?>">
								<?php
								if(count($images)>0){
								?>
								<img src="<?php echo e(URL::to('/').'/img/products/thumbnail/'.$images[0]); ?>" alt="" />
								<?php } ?></a>
						   </figure>
							<div class="gird-price"><sub>USD</sub> <?php echo e($singleProduct->price); ?></div>
							<p class="grid-info"><a href="#"><?php echo e($singleProduct->name); ?></a></p>
						</div>
					</div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

            </div>
            </div>
        </div>
    <?php if(Auth::check()): ?>
    	<div class="modal fade" id="make-an-offer" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: ;">
    		<div class="modal-dialog">
    			<div class="makeanoffer-container">
    				<button type="button" class="close" data-dismiss="modal" aria-label="Close" >
    					<span aria-hidden="true">×</span>
    				</button>
    				<h1>Make an Offer</h1><br>
    				<?php
    				/*
    			  <!--{{ Form::open(['route' => 'forntend.', 'class' => 'form-horizontal', 'id' => 'headerRegister']) }}-->
    			  */?>
    			  <?php echo e(Form::open(array('url' => route('frontend.product.makean-offer'), 'id' => 'makeanofferform'))); ?>

    			  
    			  <table class="table table-condenserd">
    			  <tr><td scope="col">First Name</td><td><input type="text" required name="first_name" placeholder="First Name" value="<?php echo e(isset($userDetails->first_name) ? $userDetails->first_name : ''); ?>"></td></tr>
    				<tr><td scope="col">Last Name</td><td><input type="text" required name="last_name" placeholder="Last Name" value="<?php echo e(isset($userDetails->last_name) ? $userDetails->last_name : ''); ?>"></td></tr>
    				<tr><td scope="col">Email</td><td><input type="email" required name="email" placeholder="Email" value="<?php echo e(isset($userDetails->email) ? $userDetails->email : ''); ?>"></td></tr>
    				<tr><td scope="col">Phone Number</td><td><input type="text" required name="phone" placeholder="Phone Number"></td></tr>
    				<tr><td scope="col">Offer Price</td><td><input type="text" required name="offer_price" placeholder="Offer Price"></td></tr>
    				
    				<tr><td colspan="2" align="center"><input type="submit" name="makeanoffer" class="btn btn-primary" value="Send"></td></tr>
    				</table>
    				<input type="hidden"  name="prod_id" value="<?php echo e($product->id); ?>" >
    			  <?php echo e(Form::close()); ?>

    				
    			</div>
    		</div>
    	</div>
    <?php else: ?>
        <div class="modal fade" id="make-an-offer" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: ;">
            <div class="modal-dialog">
                <div class="makeanoffer-container">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close" >
                        <span aria-hidden="true">×</span>
                    </button>
                    <h1>Please Login To Make an Offer</h1><br>
                    <div class="login-help">
                        <a class="back-login" href="<?php echo e(URL::to('/')); ?>/login">Go to Login</a>
                    </div>
                </div>
            </div>
        </div>
    <?php endif; ?>
		
    </section>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('after-scripts'); ?>
<script>
$(document).ready(function() {
	var sizeId = $("#sizeid").val();
	var productid = $("#productid").val();
	getQuantity(productid,sizeId);
});

	$("#sizeid").on('change', function (e) {
		sid = $(this).find('option:selected').val();
		productid = $("#productid").val();
		getRates(productid,sid);
		getQuantity(productid,sid);
	});
	/*var viewer = ImageViewer();
        $("#xzoom-default").on("click", function(){
            var imgSrc = this.src,
            highResolutionImage = $(this).attr("xoriginal");
             viewer.show(imgSrc, highResolutionImage);
           $(".iv-container").attr("title", "Use Mouse to zoom in and out");
        });
	*/	
	productId = $("#productid").val();
	$("#add_to_cart").on('click', function(e){
		var sizeId = $("#sizeid").val();
		var quantity = $("#quantity").val();
		var csrfToken = window.Laravel.csrfToken;
        //alert(sizeId);
		$.ajax({
			type: 'POST',
			url: "<?php echo route('frontend.product.add-to-cart'); ?>",
			data: {
				"product_id": productId,
				"size_id": sizeId,
				"quantity": quantity,
				"_token": csrfToken
			},
			dataType: "JSON",
			success: function(data) {
 				if(data.success == false)
				{
					alert(data.message);
				}
				else
				{
                    //alert(data.message);
					window.location = "<?php echo route('frontend.checkout.cart'); ?>";    
				}
				
			}
		});
    });	
	function getRates($proid,$sizeid)
	{
		$.ajax({
			url: "<?php echo url('/') ?>"+"/product/rate/"+$proid+"/"+$sizeid,
			type:'GET',
			success:function(data) {
				$("#cost").html("$"+data['cost']);
				$("#imap").html("$"+data['imap']);
			}
		});
	}
	function getQuantity($proid,$sizeid)
	{
		var i;
		var html;
		$.ajax({
			url: "<?php echo url('/') ?>"+"/product/getQuantity/"+$proid+"/"+$sizeid,
			type:'GET',
			success:function(data) {
				for (i = 1; i <= data['quantity']; i++) {
				  html+="<option value='"+i+"'>"+i+"</option>";
				}
				//alert(html);
				$('#quantity').empty().html(html);
			}
		});
	}
	
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('frontend.layouts.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>