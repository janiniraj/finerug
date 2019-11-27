<?php
use App\Helpers\Frontend\MenuHelper;
use Darryldecode\Cart\CartCondition;

$helper = new MenuHelper();

$cartCount = Cart::getTotalQuantity();

?>
<style>
.modal-dialog{
    pointer-events: 'painted' !important;
}

</style>
    <div class="top-bar px-lg-4">
        <div class="container-fluid">
            <div class="top-wrap">
            	<div class="top-right">
                	<div class="top-search">
				{{ Form::open(['method' => 'GET', 'class' => 'navbar-form', 'url' => route('frontend.product.product-by-type')]) }}
                        <input type="text" id="headerSearch" name="search" placeholder="Search"><button class="red-gradient search-btn"><i class="fas fa-search"></i></button>
                {{ Form::close() }}
						
                    </div>

                    
    
                    <div class="help-number">Helpline No: <strong><a href="tel:1800-"> 1800 </a></strong></div>
                    <div class="soical-icons">
                    	<ul class="list-unstyled m-0 ">
                        	<li class="list-inline-item"><a href="#"><i class="fab fa-facebook-f"></i></a></li>
                            <li class="list-inline-item"><a href="#"><i class="fab fa-instagram"></i></a></li>
                           <li class="list-inline-item"><a href="#"><i class="fab fa-twitter"></i></a></li>
                        </ul>
                    </div>
                    
                        
                    <div class="top-btns">
                    	<ul class="list-unstyled m-0 ">
							<li class="list-inline-item">
								@if(Auth::check())
									{{ link_to_route('frontend.auth.logout', 'Logout', [], ['class' => 'login' ]) }}
								@else
                                    <a href="{{ route('frontend.login') }}" class="login">Login</a>
									
								@endif
							</li>
                        	<li class="list-inline-item"><a href=""><i class="far fa-user-circle"></i> <span>My Account</span></a></li>
                            <li class="list-inline-item"><a href="{{ route('frontend.checkout.cart') }}"><i class="fas fa-shopping-cart"></i> <span class="count">{{ $cartCount }}</span></a></li>
                        </ul>	
                    </div>
                </div>
                <div class="logo"><a href="{{ URL::to('/') }}"><img src="{{ URL::to('/') }}/settings/logo.jpg"  alt=""/></a></div>
            </div>
        </div>
    </div>
     
    <div class="main-menu px-lg-4">
    	<div class="container-fluid clearfix">
        	<div class="mobile-menu"></div>
        	<div class="row">
            	<div class="col-9 mob-search">
                </div>
                <div class="col-3">
        			<div class="mobile-btn"> <span></span> </div>
            	</div>
            </div>
    
            	<div class="nav-wrap">
            	<nav class="nav-menu">
                	<ul class="list-unstyled m-0 menu">
                        <li><a href="{{ route('frontend.index') }}">Home</a></li>
                    	<li><a href="{{ route('frontend.product.product-by-type', ['type' => 'rug']) }}" >Rug</a>
                         	<div class="sub-menu lg-sub">
                            	<h2>Rugs <span class="backmain">&laquo; Back</span></h2>

                                <div class="row">
                            		<div class=" col-lg-8">
                                    	<div class="row">
                                            <div class="col-lg-4">
                                                <div class="sub-wrap">
                                                    <h3>Category</h3>
                                                    
                                                    @if(count($helper->rugCategoryList) > 0)
                                                    <ul class="list-unstyled m-0">
                                                    	@foreach($helper->rugCategoryList as $single)
                                                        <li><a href="{{ route('frontend.product.product-by-type').'/'.$single->category.'?type=rug' }}">{{ $single->category }}</a></li>
                                                        @endforeach
                                                    </ul>
                                                     @endif
                                                </div>
                                            </div>
                                         
                                          
                                          <div class="col-lg-4">
                                                <div class="sub-wrap">
                                                    <h3>Shape </h3>
                                                    <ul class="list-unstyled m-0">
                                                    	
                                                    	@foreach($helper->rugShapeList as $single)
                                                        <li><a href="{{ route('frontend.product.product-by-type').'?type=rug&shape='.$single->shape }}">{{$single->shape}}</a></li>
                                                        @endforeach
                                                    </ul>
                                                </div>
                                            </div>
                                       <!--
                                            <div class="col-lg-4">
                                                <div class="sub-wrap">
                                                    <h3>Color</h3>
                                                    <ul class="list-unstyled m-0">
                                                    	{{$helper->rugColorList}}
                   	                                @foreach($helper->rugColorList as $color)
                                                   <li><a href="{{ route('frontend.product.product-by-type').'?type=rug&color='.$color->id }}">{{$color->name}}</a></li>
                                                   @endforeach
                                                    </ul>
                                                    
                                                </div>
                                            </div>
										-->
                                            
                                            <div class="col-lg-4">
                                                <div class="sub-wrap">
                                                    <h3>Collections </h3>
                                                    <ul class="list-unstyled m-0">
                                                    	 @foreach($helper->rugCollection as $single)
                                                        <li><a href="{{ route('frontend.product.product-by-type').'?type=rug&collection='.$single->id }}">{{ $single->subcategory }}</a></li>
                                                        @endforeach
                                                    </ul>
                                                </div>
                                            </div>
                                            <div class="col-lg-4">
                                                <div class="sub-wrap">
                                                    <h3>Size </h3>
                                                    <ul class="list-unstyled m-0">
                                                        <li><a href="{{ route('frontend.product.product-by-type').'?type=rug&size=2x3'}}">2x3</a></li>
                                                        <li><a href="{{ route('frontend.product.product-by-type').'?type=rug&size=3x5'}}">3x5</a></li>
                                                        <li><a href="{{ route('frontend.product.product-by-type').'?type=rug&size=4x6'}}">4x6</a></li>
                                                        <li><a href="{{ route('frontend.product.product-by-type').'?type=rug&size=5x8'}}">5x8</a></li>
                                                        <li><a href="{{ route('frontend.product.product-by-type').'?type=rug&size=6x9'}}">6x9</a></li>
                                                        <li><a href="{{ route('frontend.product.product-by-type').'?type=rug&size=8x10'}}">8x10</a></li>
                                                        <li><a href="{{ route('frontend.product.product-by-type').'?type=rug&size=9x12'}}">9x12</a></li>
                                                        <li><a href="{{ route('frontend.product.product-by-type').'?type=rug&size=10x14'}}">10x14</a></li>
                                                    </ul>
                                                </div>
                                            </div>

                                            <div class="col-lg-4">
                                                <div class="sub-wrap">
                                                    <h3>Rug Pad</h3>
                                                    <ul class="list-unstyled m-0">
                                                        <li><a href="#">First Option</a></li>
                                                        <li><a href="#">Second Option</a></li>
                                                        <li><a href="#">Third Option</a></li>
                                                        <li><a href="#">Fourth Option</a></li>
                                                        <li><a href="#">Fifth Option</a></li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                    	<div class="menu-banner m-auto">
                                        	<a href="#">
                                   	    	<img src="/frontend/inc/img/img01.jpg" alt=""/> 
                                            <div>
                                                <h4>extra 30% off</h4>	
                                                <p>Select </p>
                                            </div>
                                            </a>
                                        </div>	
                                    </div>
                                </div>
                            </div>
                        </li>
                        <?php /*<li><a href="{{ route('frontend.product.product-by-type', ['type' => 'furniture']) }}">Furniture</a>
                        	<div class="sub-menu md-sub">
                            	<h2>Furniture <span class="backmain">&laquo; Back</span></h2>
                                <div class="row">
                            		<div class=" col-lg-8">
                                    	<div class="row">
                                            <div class="col-lg-6">
                                                <div class="sub-wrap">
                                                    <h3>Category</h3>
													@if(count($helper->furnitureCategoryList) > 0)
                                                    <ul class="list-unstyled m-0">
														@foreach($helper->furnitureCategoryList as $single)
                                                        <li><a href="{{ route('frontend.product.product-by-type').'/'.$single->category.'?type=furniture' }}">{{ $single->category }}</a></li>
														@endforeach
                                                    </ul>
													@endif
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="sub-wrap">
                                                    <h3> Collections</h3>
													@if(count($helper->furnitureCollection) > 0)
                                                    <ul class="list-unstyled m-0">
														@foreach($helper->furnitureCollection as $single)
                                                        <li><a href="{{ route('frontend.product.product-by-type').'?type=furniture&collection='.$single->id }}">{{ $single->subcategory }}</a></li>
                                                        @endforeach
                                                    </ul>
													@endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                    	<div class="menu-banner m-auto">
                                        	<a href="#">
                                   	    	<img src="/frontend/inc/img/img03.jpg" alt=""/> 
                                            <div>
                                                <h4>extra 20% off</h4>	
                                                <p>Select Furniture by Christopher Knight*</p>
                                            </div>
                                            </a>
                                        </div>	
                                    </div>
                                </div>
                            </div>
                        </li>
                        <li><a href="{{ route('frontend.product.product-by-type', ['type' => 'flooring']) }}">Flooring</a>
                        	<div class="sub-menu lg-sub">
                            	<h2>Flooring <span class="backmain">&laquo; Back</span></h2>
                                <div class="row">
                            		<div class=" col-lg-8">
                                    	<div class="row">
                                            <div class="col-lg-4">
												<div class="sub-wrap">
                                                    <h3>Category</h3>
													@if(count($helper->flooringCategoryList) > 0)
                                                    <ul class="list-unstyled m-0">
														@foreach($helper->flooringCategoryList as $single)
                                                        <li><a href="{{ route('frontend.product.product-by-type').'/'.$single->category.'?type=flooring' }}">{{ $single->category }}</a></li>
														@endforeach
                                                    </ul>
													@endif
                                                </div>                                        
											</div>
                                            <div class="col-lg-4">
                                                <div class="sub-wrap">
                                                    <h3>Collections</h3>
													@if(count($helper->flooringCollection) > 0)
                                                    <ul class="list-unstyled m-0">
														@foreach($helper->flooringCollection as $single)
                                                        <li><a href="{{ route('frontend.product.product-by-type').'?type=flooring&collection='.$single->id }}">{{ $single->subcategory }}</a></li>
                                                        @endforeach
                                                    </ul>
													@endif
                                                </div>
                                            </div>
                                            
                                            <div class="col-lg-4">
                                                <div class="sub-wrap">
                                                    <h3>Vintly</h3>
                                                    <ul class="list-unstyled m-0">
                                                        <li><a href="#">First Option</a></li>
                                                        <li><a href="#">Second Option</a></li>
                                                        <li><a href="#">Third Option</a></li>
                                                        <li><a href="#">Fourth Option</a></li>
                                                        <li><a href="#">Fifth Option</a></li>
                                                    </ul>
                                                </div>
                                                    
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                    	<div class="menu-banner m-auto">
                                        	<a href="#">
                                   	    	<img src="/frontend/inc/img/img02.jpg" alt=""/> 
                                            <div>
                                                <h4>extra 30% off</h4>	
                                                <p>Select Area Rugs *</p>
                                            </div>
                                            </a>
                                        </div>	
                                    </div>
                                </div>
							</div>	
                        </li>*/ ?>
                        <li><a href="{{ route('frontend.contact') }}">Contact us</a></li>
                        <li><a href="#">About us </a></li>
                    </ul>
                </nav>
                <nav class="nav-manu">
                	<ul class="list-unstyled m-0 menu">
                    	<li><a href="http://54.198.78.175/products?type=all">Shop</a></li>
                        <li><a href="#">Sales</a></li>
                        <li><a href="http://54.198.78.175/products?type=all" class="menu-active">Get Free Estimate</a></li>
                    </ul>
                </nav>
            </div>
        </div>
    </div>
 	 </div>
	<div class="modal fade" id="login-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
		<div class="modal-dialog">
			<div class="loginmodal-container">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close" >
					<span aria-hidden="true">×</span>
				</button>
				<h1>Login to Your Account</h1><br>
			  {{ Form::open(['route' => 'frontend.auth.login.post', 'class' => 'form-horizontal']) }}
				<input type="email" required name="email" placeholder="Email">
				<input type="password" required name="password" placeholder="Password">
				<input type="submit" name="login" class="login loginmodal-submit" value="Login">
			  {{ Form::close() }}
				
			  <div class="login-help">
				<div class="register-button"  data-toggle="modal" data-target="#register-modal"  style='cursor:pointer;'>Register</div> - <a class="forgetpassword-button" href="javascript:void(0)">Forgot Password</a>
			  </div>
			</div>
		</div>
	</div>
	<div class="modal fade" id="register-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
		<div class="modal-dialog">
			<div class="loginmodal-container">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close" >
					<span aria-hidden="true">×</span>
				</button>
				<h1>Create Account</h1><br>
			  {{ Form::open(['route' => 'frontend.auth.register.post-ajax', 'class' => 'form-horizontal', 'id' => 'headerRegister']) }}
				<input type="text" required name="first_name" placeholder="First Name">
				<input type="text" required name="last_name" placeholder="Last Name">
				<input type="email" required name="email" placeholder="Email">
				<input type="password" required name="password" placeholder="Password">
				<input type="password" required name="password_confirmation" placeholder="Confirm Password">
				<input type="submit" name="register" class="login loginmodal-submit" value="Register">
			  {{ Form::close() }}
				
			  <div class="login-help">
				<a class="back-login" href="javascript:void(0)">Back to Login</a>
			  </div>
			</div>
		</div>
	</div>

	<div class="modal fade" id="mailing-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
		<div class="modal-dialog">
			<div class="loginmodal-container">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close" >
					<span aria-hidden="true">×</span>
				</button>
				<h1>Join our Mailing List</h1><br>
			  {{ Form::open(['route' => 'frontend.page.mailing-submit', 'class' => 'form-horizontal', 'id' => 'mailingSubmitForm']) }}
				<input type="text" required name="firstname" placeholder="First Name">
				<input type="text" required name="lastname" placeholder="Last Name">
				<input type="email" required name="email" placeholder="Email Address">
				<input type="text" name="phone" placeholder="Phone Number">
				<input type="text" required name="address" placeholder="Address">
				<input type="text" required name="street" placeholder="Street">
				<input type="text" required name="pobox" placeholder="P. O. Box">
				<input type="text" required name="city" placeholder="City">
				<input type="text" required name="state" placeholder="State">
				<input type="text" required name="country" placeholder="Country">
				<input type="submit" name="Submit" class="login loginmodal-submit" value="Submit">
			  {{ Form::close() }}
				
			</div>
		</div>
	</div>

	<div class="modal fade" id="forgetpassword-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
		<div class="modal-dialog">
			<div class="loginmodal-container">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close" >
					<span aria-hidden="true">×</span>
				</button>
				<h1>{{ trans('labels.frontend.passwords.reset_password_box_title') }}</h1><br>
			  {{ Form::open(['route' => 'frontend.auth.password.email.post', 'class' => 'form-horizontal']) }}
				<input type="email" required name="email" placeholder="Email">            
				<input type="submit" name="login" class="login loginmodal-submit" value="Login">
			  {{ Form::close() }}
				
				<div class="login-help">
					<a class="back-login" href="javascript:void(0)">Back to Login</a>
				  </div>
				</div>
			</div>
		</div>
