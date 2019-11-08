<?php
use App\Helpers\Frontend\MenuHelper;
$helper = new MenuHelper();
?>
<nav class="navbar navbar-default navbar-fixed-top">
    <div class="container-fluid">
        <div class="navbar-header">
   
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#mainNavbar">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
        </div>
        <div class="collapse navbar-collapse hidden-sm hidden-xs" id="socialNavbar">
            <div class="logo-next-text" style="padding-left: 1%;font-size: 50px;position: absolute;">
            <span></span>
            <span class="span-small-text">sad4</span>
            </div>
            <ul class="nav navbar-nav navbar-right social">
                <li>
                    @if(Auth::check())
                        {{ link_to_route('frontend.auth.logout', 'Logout', [], ['class' => 'login' ]) }}
                    @else
                        {{ link_to_route('frontend.auth.login', trans('navs.frontend.login'), [], ['class' => 'login', 'data-toggle' => "modal", "data-target" => "#login-modal" ]) }}
                    @endif
                </li>
                    @if(Auth::check())
                <li>
                <a class="cart-nav" href="{{ route('frontend.checkout.cart') }}">
                    <i class="fas fa-shopping-cart"></i>
                    <span  class="cart-items-count"><span class=" notification-counter">{{ $helper->cartCount }}</span></span>
                </a>
                </li>
                   @endif
                <li>
                <a class="heart" href="{{ route('frontend.product.favourites') }}">
                    <i class="fas fa-heart"></i>
                    <span  class="cart-items-count"><span class=" notification-counter">{{ $helper->favouriteCount }}</span></span>
                </a>
                </li>
               
                <li class="rounded"><a class="facebook" href="" title="facebook"><i class="fab fa-facebook-f"></i></a></li>
                <li class="rounded"><a class="twitter" href="#" title="twitter" ><i class="fab fa-twitter"></i></a></li>
                <li class="rounded"><a class="instagram"  href="" title="instagram"><i class="fab fa-instagram"></i></a></li>
                <li class="rounded"><a class="youtube" href=""title="youtube" ><i class="fab fa-youtube"></i></a></li>
            </ul>

            <ul class="nav navbar-nav navbar-right social phonenumber">
                <li><a class="number">0000</a></li>
               <li class="rounded"><a class="phone" href="#"><i class="fas fa-phone"></i></a></li>
                
            </ul>
        </div>
        <div class="collapse navbar-collapse" id="mainNavbar">
            <ul class="nav navbar-nav">
                <li><a href="{{ url('/') }}">Home</a></li>
                <li>
                    <a href="{{ route('frontend.product.product-by-type', ['type' => 'rug']) }}" class="dropdown-toggle" data-toggle="dropdown">Rug</a>
                    <ul class="dropdown-menu multi-level">
                        <li>
                            <a href="{{ route('frontend.product.product-by-type').'?type=rug' }}">All Rugs</a>
                        </li>
                       <li>
                            <a href="{{ route('frontend.page.cleaning-restoration') }}">Rugs Cleaning</a>
                        </li>
                        <li class="{{ count($helper->rugCategoryList) > 0 ? 'dropdown-submenu' : '' }}">
                            <a href="javascript:void(0);" class="{{ count($helper->rugCategoryList) > 0 ? 'dropdown-toggle' : '' }}" {{ count($helper->rugCategoryList) > 0 ? 'data-toggle="dropdown"' : '' }}>Category</a>
                            @if(count($helper->rugCategoryList) > 0)
                                <ul class="dropdown-menu sub-sub-menu">
                                    @foreach($helper->rugCategoryList as $single)
                                        <li><a href="{{ route('frontend.product.product-by-type').'/'.$single->category.'?type=rug' }}">{{ $single->category }}</a></li>
                                    @endforeach
                                </ul>
                            @endif
                        </li>
                        <li class="{{ count($helper->rugCollection) > 0 ? 'dropdown-submenu' : '' }}">
                            <a href="javascript:void(0);" class="{{ count($helper->rugCollection) > 0 ? 'dropdown-toggle' : '' }}" {{ count($helper->rugCollection) > 0 ? 'data-toggle="dropdown"' : '' }}>Collections</a>
                            @if(count($helper->rugCollection) > 0)
                                <ul class="dropdown-menu sub-sub-menu">
                                    @foreach($helper->rugCollection as $single)
                                        <li><a href="{{ route('frontend.product.product-by-type').'?type=rug&collection='.$single->id }}">{{ $single->subcategory }}</a></li>
                                    @endforeach
                                </ul>
                            @endif
                        </li>
                        <li class="{{ count($helper->rugCollection) > 0 ? 'dropdown-submenu' : '' }}">
                            <a href="javascript:void(0);" class="{{ count($helper->rugStyleList) > 0 ? 'dropdown-toggle' : '' }}" {{ count($helper->rugStyleList) > 0 ? 'data-toggle="dropdown"' : '' }}>Styles</a>
                            @if(count($helper->rugStyleList) > 0)
                                <ul class="dropdown-menu sub-sub-menu">
                                    @foreach($helper->rugStyleList as $single)
                                        <li><a href="{{ route('frontend.product.product-by-type').'?type=rug&style='.$single->id }}">{{ $single->name }}</a></li>
                                    @endforeach
                                </ul>
                            @endif
                        </li>
                        <li class="{{ count($helper->rugMaterialList) > 0 ? 'dropdown-submenu' : '' }}">
                            <a href="javascript:void(0);" class="{{ count($helper->rugMaterialList) > 0 ? 'dropdown-toggle' : '' }}" {{ count($helper->rugMaterialList) > 0 ? 'data-toggle="dropdown"' : '' }}>Materials</a>
                            @if(count($helper->rugMaterialList) > 0)
                                <ul class="dropdown-menu sub-sub-menu">
                                    @foreach($helper->rugMaterialList as $single)
                                        <li><a href="{{ route('frontend.product.product-by-type').'?type=rug&material='.$single->id }}">{{ $single->name }}</a></li>
                                    @endforeach
                                </ul>
                            @endif
                        </li>
                        <li class="{{ count($helper->rugWeaveList) > 0 ? 'dropdown-submenu' : '' }}">
                            <a href="javascript:void(0);" class="{{ count($helper->rugWeaveList) > 0 ? 'dropdown-toggle' : '' }}" {{ count($helper->rugWeaveList) > 0 ? 'data-toggle="dropdown"' : '' }}>Weaves</a>
                            @if(count($helper->rugWeaveList) > 0)
                                <ul class="dropdown-menu sub-sub-menu">
                                    @foreach($helper->rugWeaveList as $single)
                                        <li><a href="{{ route('frontend.product.product-by-type').'?type=rug&weave='.$single->id }}">{{ $single->name }}</a></li>
                                    @endforeach
                                </ul>
                            @endif
                        </li>
                        <li class="{{ count($helper->rugColorList) > 0 ? 'dropdown-submenu' : '' }}">
                            <a href="javascript:void(0);" class="{{ count($helper->rugColorList) > 0 ? 'dropdown-toggle' : '' }}" {{ count($helper->rugColorList) > 0 ? 'data-toggle="dropdown"' : '' }}>Colors</a>
                            @if(count($helper->rugColorList) > 0)
                                <ul class="dropdown-menu sub-sub-menu">
                                    @foreach($helper->rugColorList as $single)
                                        <li><a href="{{ route('frontend.product.product-by-type').'?type=rug&color='.$single->id }}"><span class="color-btn" style="background-color: {{ $single->name }}"> </span></a></li>
                                    @endforeach
                                </ul>
                            @endif
                        </li>
                        <li class="{{ count($helper->rugShapeList) > 0 ? 'dropdown-submenu' : '' }}">
                            <a href="javascript:void(0);" class="{{ count($helper->rugShapeList) > 0 ? 'dropdown-toggle' : '' }}" {{ count($helper->rugShapeList) > 0 ? 'data-toggle="dropdown"' : '' }}>Shapes</a>
                            @if(count($helper->rugShapeList) > 0)
                                <ul class="dropdown-menu sub-sub-menu">
                                    @foreach($helper->rugShapeList as $single)
                                        <li><a href="{{ route('frontend.product.product-by-type').'?type=rug&shape='.$single->shape }}">{{ $single->shape }}</a></li>
                                    @endforeach
                                </ul>
                            @endif
                        </li>
                        <li class="{{ count($helper->rugSizeList) > 0 ? 'dropdown-submenu' : '' }}">
                            <a href="javascript:void(0);" class="{{ count($helper->rugSizeList) > 0 ? 'dropdown-toggle' : '' }}" {{ count($helper->rugSizeList) > 0 ? 'data-toggle="dropdown"' : '' }}>Sizes</a>
                            @if(count($helper->rugSizeList) > 0)
                                <ul class="dropdown-menu sub-sub-menu">
                                    @foreach($helper->rugSizeList as $single)
                                        <li><a href="{{ route('frontend.product.product-by-type').'?type=rug&size='.$single }}">{{ $single }}</a></li>
                                    @endforeach
                                </ul>
                            @endif
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="{{ route('frontend.product.product-by-type', ['type' => 'furniture']) }}" class="dropdown-toggle" data-toggle="dropdown">Furniture</a>
                    <ul class="dropdown-menu multi-level">
                    	 <li>
                            <a href="{{ route('frontend.product.product-by-type').'?type=Furniture' }}">All Furniture</a>
                        </li>
                        <li cl
                        <li class="{{ count($helper->furnitureCategoryList) > 0 ? 'dropdown-submenu' : '' }}">
                            <a href="javascript:void(0);" class="{{ count($helper->furnitureCategoryList) > 0 ? 'dropdown-toggle' : '' }}" {{ count($helper->furnitureCategoryList) > 0 ? 'data-toggle="dropdown"' : '' }}>Category</a>
                            @if(count($helper->furnitureCategoryList) > 0)
                                <ul class="dropdown-menu sub-sub-menu">
                                    @foreach($helper->furnitureCategoryList as $single)
                                        <li><a href="{{ route('frontend.product.product-by-type').'/'.$single->category.'?type=furniture' }}">{{ $single->category }}</a></li>
                                    @endforeach
                                </ul>
                            @endif
                        </li>
                        <li class="{{ count($helper->furnitureCollection) > 0 ? 'dropdown-submenu' : '' }}">
                            <a href="javascript:void(0);" class="{{ count($helper->furnitureCollection) > 0 ? 'dropdown-toggle' : '' }}" {{ count($helper->furnitureCollection) > 0 ? 'data-toggle="dropdown"' : '' }}>Collections</a>
                            @if(count($helper->furnitureCollection) > 0)
                                <ul class="dropdown-menu sub-sub-menu">
                                    @foreach($helper->furnitureCollection as $single)
                                        <li><a href="{{ route('frontend.product.product-by-type').'?type=furniture&collection='.$single->id }}">{{ $single->subcategory }}</a></li>
                                    @endforeach
                                </ul>
                            @endif
                        </li>
                        <li class="{{ count($helper->furnitureCollection) > 0 ? 'dropdown-submenu' : '' }}">
                            <a href="javascript:void(0);" class="{{ count($helper->furnitureStyleList) > 0 ? 'dropdown-toggle' : '' }}" {{ count($helper->furnitureStyleList) > 0 ? 'data-toggle="dropdown"' : '' }}>Styles</a>
                            @if(count($helper->furnitureStyleList) > 0)
                                <ul class="dropdown-menu sub-sub-menu">
                                    @foreach($helper->furnitureStyleList as $single)
                                        <li><a href="{{ route('frontend.product.product-by-type').'?type=furniture&style='.$single->id }}">{{ $single->name }}</a></li>
                                    @endforeach
                                </ul>
                            @endif
                        </li>
                        <li class="{{ count($helper->furnitureMaterialList) > 0 ? 'dropdown-submenu' : '' }}">
                            <a href="javascript:void(0);" class="{{ count($helper->furnitureMaterialList) > 0 ? 'dropdown-toggle' : '' }}" {{ count($helper->furnitureMaterialList) > 0 ? 'data-toggle="dropdown"' : '' }}>Materials</a>
                            @if(count($helper->furnitureMaterialList) > 0)
                                <ul class="dropdown-menu sub-sub-menu">
                                    @foreach($helper->furnitureMaterialList as $single)
                                        <li><a href="{{ route('frontend.product.product-by-type').'?type=furniture&material='.$single->id }}">{{ $single->name }}</a></li>
                                    @endforeach
                                </ul>
                            @endif
                        </li>
                        <li class="{{ count($helper->furnitureColorList) > 0 ? 'dropdown-submenu' : '' }}">
                            <a href="javascript:void(0);" class="{{ count($helper->furnitureColorList) > 0 ? 'dropdown-toggle' : '' }}" {{ count($helper->furnitureColorList) > 0 ? 'data-toggle="dropdown"' : '' }}>Colors</a>
                            @if(count($helper->furnitureColorList) > 0)
                                <ul class="dropdown-menu sub-sub-menu">
                                    @foreach($helper->furnitureColorList as $single)
                                        <li><a href="{{ route('frontend.product.product-by-type').'?type=furniture&color='.$single->id }}"><span class="color-btn" style="background-color: {{ $single->name }}"> </span></a></li>
                                    @endforeach
                                </ul>
                            @endif
                        </li>
                        <li class="{{ count($helper->furnitureShapeList) > 0 ? 'dropdown-submenu' : '' }}">
                            <a href="javascript:void(0);" class="{{ count($helper->furnitureShapeList) > 0 ? 'dropdown-toggle' : '' }}" {{ count($helper->furnitureShapeList) > 0 ? 'data-toggle="dropdown"' : '' }}>Shapes</a>
                            @if(count($helper->furnitureShapeList) > 0)
                                <ul class="dropdown-menu sub-sub-menu">
                                    @foreach($helper->furnitureShapeList as $single)
                                        <li><a href="{{ route('frontend.product.product-by-type').'?type=furniture&shape='.$single->shape }}">{{ $single->shape }}</a></li>
                                    @endforeach
                                </ul>
                            @endif
                        </li>

                    </ul>
                </li>
                <li>
                    <a href="{{ route('frontend.product.product-by-type', ['type' => 'lighting']) }}" class="dropdown-toggle" data-toggle="dropdown">Lighting</a>
                    <ul class="dropdown-menu multi-level">
                    	 <li>
                            <a href="{{ route('frontend.product.product-by-type').'?type=Lighting' }}">All Lightings</a>
                        </li>
                        <li cl
                        <li class="{{ count($helper->lightingCategoryList) > 0 ? 'dropdown-submenu' : '' }}">
                            <a href="javascript:void(0);" class="{{ count($helper->lightingCategoryList) > 0 ? 'dropdown-toggle' : '' }}" {{ count($helper->lightingCategoryList) > 0 ? 'data-toggle="dropdown"' : '' }}>Category</a>
                            @if(count($helper->lightingCategoryList) > 0)
                                <ul class="dropdown-menu sub-sub-menu">
                                    @foreach($helper->lightingCategoryList as $single)
                                        <li><a href="{{ route('frontend.product.product-by-type').'/'.$single->category.'?type=lighting' }}">{{ $single->category }}</a></li>
                                    @endforeach
                                </ul>
                            @endif
                        </li>
                        <li class="{{ count($helper->lightingCollection) > 0 ? 'dropdown-submenu' : '' }}">
                            <a href="javascript:void(0);" class="{{ count($helper->lightingCollection) > 0 ? 'dropdown-toggle' : '' }}" {{ count($helper->lightingCollection) > 0 ? 'data-toggle="dropdown"' : '' }}>Collections</a>
                            @if(count($helper->lightingCollection) > 0)
                                <ul class="dropdown-menu sub-sub-menu">
                                    @foreach($helper->lightingCollection as $single)
                                        <li><a href="{{ route('frontend.product.product-by-type').'?type=lighting&collection='.$single->id }}">{{ $single->subcategory }}</a></li>
                                    @endforeach
                                </ul>
                            @endif
                        </li>
                        <li class="{{ count($helper->lightingCollection) > 0 ? 'dropdown-submenu' : '' }}">
                            <a href="javascript:void(0);" class="{{ count($helper->lightingStyleList) > 0 ? 'dropdown-toggle' : '' }}" {{ count($helper->lightingStyleList) > 0 ? 'data-toggle="dropdown"' : '' }}>Styles</a>
                            @if(count($helper->lightingStyleList) > 0)
                                <ul class="dropdown-menu sub-sub-menu">
                                    @foreach($helper->lightingStyleList as $single)
                                        <li><a href="{{ route('frontend.product.product-by-type').'?type=lighting&style='.$single->id }}">{{ $single->name }}</a></li>
                                    @endforeach
                                </ul>
                            @endif
                        </li>
                        <li class="{{ count($helper->lightingMaterialList) > 0 ? 'dropdown-submenu' : '' }}">
                            <a href="javascript:void(0);" class="{{ count($helper->lightingMaterialList) > 0 ? 'dropdown-toggle' : '' }}" {{ count($helper->lightingMaterialList) > 0 ? 'data-toggle="dropdown"' : '' }}>Materials</a>
                            @if(count($helper->lightingMaterialList) > 0)
                                <ul class="dropdown-menu sub-sub-menu">
                                    @foreach($helper->lightingMaterialList as $single)
                                        <li><a href="{{ route('frontend.product.product-by-type').'?type=lighting&material='.$single->id }}">{{ $single->name }}</a></li>
                                    @endforeach
                                </ul>
                            @endif
                        </li>
                        <li class="{{ count($helper->lightingColorList) > 0 ? 'dropdown-submenu' : '' }}">
                            <a href="javascript:void(0);" class="{{ count($helper->lightingColorList) > 0 ? 'dropdown-toggle' : '' }}" {{ count($helper->lightingColorList) > 0 ? 'data-toggle="dropdown"' : '' }}>Colors</a>
                            @if(count($helper->lightingColorList) > 0)
                                <ul class="dropdown-menu sub-sub-menu">
                                    @foreach($helper->lightingColorList as $single)
                                        <li><a href="{{ route('frontend.product.product-by-type').'?type=lighting&color='.$single->id }}"><span class="color-btn" style="background-color: {{ $single->name }}"> </span></a></li>
                                    @endforeach
                                </ul>
                            @endif
                        </li>
                        <li class="{{ count($helper->lightingShapeList) > 0 ? 'dropdown-submenu' : '' }}">
                            <a href="javascript:void(0);" class="{{ count($helper->lightingShapeList) > 0 ? 'dropdown-toggle' : '' }}" {{ count($helper->lightingShapeList) > 0 ? 'data-toggle="dropdown"' : '' }}>Shapes</a>
                            @if(count($helper->lightingShapeList) > 0)
                                <ul class="dropdown-menu sub-sub-menu">
                                    @foreach($helper->lightingShapeList as $single)
                                        <li><a href="{{ route('frontend.product.product-by-type').'?type=lighting&shape='.$single->shape }}">{{ $single->shape }}</a></li>
                                    @endforeach
                                </ul>
                            @endif
                        </li>

                    </ul>
                </li>

                <li>
                    <a href="{{ route('frontend.product.product-by-type', ['type' => 'accessories']) }}" class="dropdown-toggle" data-toggle="dropdown">Accessories</a>
                    <ul class="dropdown-menu multi-level">
                    	 <li>
                            <a href="{{ route('frontend.product.product-by-type').'?type= accessories' }}">All Accesories</a>
                        </li>
                    	
                        <li class="{{ count($helper->accessoriesCategoryList) > 0 ? 'dropdown-submenu' : '' }}">
                            <a href="javascript:void(0);" class="{{ count($helper->accessoriesCategoryList) > 0 ? 'dropdown-toggle' : '' }}" {{ count($helper->accessoriesCategoryList) > 0 ? 'data-toggle="dropdown"' : '' }}>Category</a>
                            @if(count($helper->accessoriesCategoryList) > 0)
                                <ul class="dropdown-menu sub-sub-menu">
                                    @foreach($helper->accessoriesCategoryList as $single)
                                        <li><a href="{{ route('frontend.product.product-by-type').'/'.$single->category.'?type=accessories' }}">{{ $single->category }}</a></li>
                                    @endforeach
                                </ul>
                            @endif
                        </li>
                        <li class="{{ count($helper->accessoriesCollection) > 0 ? 'dropdown-submenu' : '' }}">
                            <a href="javascript:void(0);" class="{{ count($helper->accessoriesCollection) > 0 ? 'dropdown-toggle' : '' }}" {{ count($helper->accessoriesCollection) > 0 ? 'data-toggle="dropdown"' : '' }}>Collections</a>
                            @if(count($helper->accessoriesCollection) > 0)
                                <ul class="dropdown-menu sub-sub-menu">
                                    @foreach($helper->accessoriesCollection as $single)
                                        <li><a href="{{ route('frontend.product.product-by-type').'?type=accessories&collection='.$single->id }}">{{ $single->subcategory }}</a></li>
                                    @endforeach
                                </ul>
                            @endif
                        </li>
                        <li class="{{ count($helper->accessoriesCollection) > 0 ? 'dropdown-submenu' : '' }}">
                            <a href="javascript:void(0);" class="{{ count($helper->accessoriesStyleList) > 0 ? 'dropdown-toggle' : '' }}" {{ count($helper->accessoriesStyleList) > 0 ? 'data-toggle="dropdown"' : '' }}>Styles</a>
                            @if(count($helper->accessoriesStyleList) > 0)
                                <ul class="dropdown-menu sub-sub-menu">
                                    @foreach($helper->accessoriesStyleList as $single)
                                        <li><a href="{{ route('frontend.product.product-by-type').'?type=accessories&style='.$single->id }}">{{ $single->name }}</a></li>
                                    @endforeach
                                </ul>
                            @endif
                        </li>
                        <li class="{{ count($helper->accessoriesMaterialList) > 0 ? 'dropdown-submenu' : '' }}">
                            <a href="javascript:void(0);" class="{{ count($helper->accessoriesMaterialList) > 0 ? 'dropdown-toggle' : '' }}" {{ count($helper->accessoriesMaterialList) > 0 ? 'data-toggle="dropdown"' : '' }}>Materials</a>
                            @if(count($helper->accessoriesMaterialList) > 0)
                                <ul class="dropdown-menu sub-sub-menu">
                                    @foreach($helper->accessoriesMaterialList as $single)
                                        <li><a href="{{ route('frontend.product.product-by-type').'?type=accessories&material='.$single->id }}">{{ $single->name }}</a></li>
                                    @endforeach
                                </ul>
                            @endif
                        </li>
                        <li class="{{ count($helper->accessoriesColorList) > 0 ? 'dropdown-submenu' : '' }}">
                            <a href="javascript:void(0);" class="{{ count($helper->accessoriesColorList) > 0 ? 'dropdown-toggle' : '' }}" {{ count($helper->accessoriesColorList) > 0 ? 'data-toggle="dropdown"' : '' }}>Colors</a>
                            @if(count($helper->accessoriesColorList) > 0)
                                <ul class="dropdown-menu sub-sub-menu">
                                    @foreach($helper->accessoriesColorList as $single)
                                        <li><a href="{{ route('frontend.product.product-by-type').'?type=accessories&color='.$single->id }}"><span class="color-btn" style="background-color: {{ $single->name }}"> </span></a></li>
                                    @endforeach
                                </ul>
                            @endif
                        </li>
                        <li class="{{ count($helper->accessoriesShapeList) > 0 ? 'dropdown-submenu' : '' }}">
                            <a href="javascript:void(0);" class="{{ count($helper->accessoriesShapeList) > 0 ? 'dropdown-toggle' : '' }}" {{ count($helper->accessoriesShapeList) > 0 ? 'data-toggle="dropdown"' : '' }}>Shapes</a>
                            @if(count($helper->accessoriesShapeList) > 0)
                                <ul class="dropdown-menu sub-sub-menu">
                                    @foreach($helper->accessoriesShapeList as $single)
                                        <li><a href="{{ route('frontend.product.product-by-type').'?type=accessories&shape='.$single->shape }}">{{ $single->shape }}</a></li>
                                    @endforeach
                                </ul>
                            @endif
                        </li>

                    </ul>
                </li>
                <li>
                    <a href="{{ route('frontend.page.store') }}">Shop</a>
                </li>
                <li class="dropdown">
                    <a class="dropdown-toggle" href="{{ route('frontend.product.advance-search') }}">Search</a>
                    <ul class="dropdown-menu">
                        <li><a href="{{ route('frontend.product.advance-search') }}">Advanced Search</a></li>

                    </ul>
                </li>
                <li class="dropdown">
                    <a class="dropdown-toggle" href="{{ route('frontend.page.about-us') }}">About</a>
                    <ul class="dropdown-menu">
                        <li><a href="{{ route('frontend.page.about-us') }}">About Us</a></li>
                        <li><a href="{{ route('frontend.page.press') }}">Press</a></li>
                    </ul>
                </li>
                <li class="dropdown">
                    <a class="dropdown-toggle" href="">Contact Us</a>
                    <ul class="dropdown-menu">
                        <li><a href="{{ route('frontend.page.contact-us') }}">Our Store</a></li>
                        <li><a href="{{ route('frontend.page.show-room') }}">Show Room</a></li>
                        <li><a href="javascript:void(0);" data-toggle="modal" data-target="#mailing-modal">$500 Store Credit</a></li>
                    </ul>
                </li>
                
                @if(Auth::check())
				<li class="visible-xs visible-sm">
                     <a href="{{ route('frontend.auth.logout') }}" >Logout</a>
                </li>
                @else
                <li class="visible-xs visible-sm">
                     <a href="javascript:void(0);" class="login" data-toggle="modal" data-target="#login-modal">Login</a>
                </li>
                @endif

            </ul>

<div class="col-sm-3 col-md-3">
                {{ Form::open(['method' => 'GET', 'class' => 'navbar-form', 'url' => route('frontend.product.product-by-type')]) }}
                    <div class="input-group">
                        <input id="headerSearch" type="text" class="form-control" placeholder="Search" name="search" required>
                        <div class="input-group-btn">
                            <button class="btn btn-default" type="submit"><i class="glyphicon glyphicon-search"></i></button>
                        </div>
                    </div>
                {{ Form::close() }}
            </div>

            <ul class="nav navbar-nav navbar-right">
              
               <li><a target="_blank" href="">View Catalogue</a></li>
               
                <div id="google_translate_element" style="display: none"></div>
                <li class="dropdown language">
                    <a class="dropdown-toggle" href="#">Language</a>
                    <ul class="dropdown-menu">
                        <li><a href="javascript:void(0);" id="English" onclick="translateLanguage(this.id);"><img src="{{ admin_url() }}/frontend/img/flags/us.png"></a></li>
                        <li><a href="javascript:void(0);" id="French" onclick="translateLanguage(this.id);"><img src="{{ admin_url() }}/frontend/img/flags/fr.png"></a></li>
                        <li><a href="javascript:void(0);" id="Chinese (Simplified)" onclick="translateLanguage(this.id);"><img src="{{ admin_url() }}/frontend/img/flags/ch.png"></a></li>
                        <li><a href="javascript:void(0);" id="Spanish" onclick="translateLanguage(this.id);"><img src="{{ admin_url() }}/frontend/img/flags/sp.png"></a></li>
                        <li><a href="javascript:void(0);" id="Arabic" onclick="translateLanguage(this.id);"><img src="{{ admin_url() }}/frontend/img/flags/Arabic.png"></a></li>
                        <li><a href="javascript:void(0);" id="German" onclick="translateLanguage(this.id);"><img src="{{ admin_url() }}/frontend/img/flags/Germany.png"></a></li>
                        <li><a href="javascript:void(0);" id="Hindi" onclick="translateLanguage(this.id);"><img src="{{ admin_url() }}/frontend/img/flags/Indian.png"></a></li>
                        <li><a href="javascript:void(0);" id="Italian" onclick="translateLanguage(this.id);"><img src="{{ admin_url() }}/frontend/img/flags/Italain.jpg"></a></li>
                        <li><a href="javascript:void(0);" id="Persian" onclick="translateLanguage(this.id);"><img src="{{ admin_url() }}/frontend/img/flags/Persian.png"></a></li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</nav>
@php
            $actualLink = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
            @endphp
<div class="modal fade" id="login-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <div class="loginmodal-container">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close" >
                <span aria-hidden="true">×</span>
            </button>
            <h1> Register to Buy </h1><br>
          {{ Form::open(['route' => 'frontend.auth.login.post', 'class' => 'form-horizontal']) }}
          
            <input type="email" required name="email" placeholder="Email">
            <input type="password" required name="password" placeholder="Password">
            <input type="hidden" required name="url" value="{{ $actualLink }}">
            <input type="submit" name="login" class="login loginmodal-submit" value="Login">
          {{ Form::close() }}
            
          <div class="login-help">
            <a class="register-button" href="javascript:void(0)">Register</a> - <a class="forgetpassword-button" href="javascript:void(0)">Forgot Password</a>
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
            <input type="hidden" required name="url" value="{{ $actualLink }}">
            <input type="text" required name="first_name" placeholder="First Name">
            <input type="text" required name="last_name" placeholder="Last Name">
            <input type="email" required name="email" placeholder="Email">
            <input type="password" required name="password" placeholder="Password">
            <input type="password" required name="password_confirmation" placeholder="Confirm Password">
            <input type="submit" name="Register" class="login loginmodal-submit" value="Register">
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
            <h1> Enter Your Name  </h1><br>
                  
            
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
</div>

<div class="modal fade" id="joinus-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <div class="loginmodal-container">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close" >
                <span aria-hidden="true">×</span>
            </button>
            <h1>Enter your name </h1><br>
                
          {{ Form::open(['route' => 'frontend.page.mailing-submit', 'class' => 'form-horizontal', 'id' => 'joinusSubmitForm']) }}
            <input type="text" required name="firstname" placeholder="*First Name">
            <input type="text" required name="lastname" placeholder="*Last Name">
            <input type="email" required name="email" placeholder="*Email Address">
            <input type="submit" name="Submit" class="login loginmodal-submit" value="Submit">

          {{ Form::close() }}
            <a class="btn btn-submit btn-no-thanks" href="javascript:void(0)" data-dismiss="modal" aria-label="Close">No Thanks</a>
        </div>
    </div>
</div>