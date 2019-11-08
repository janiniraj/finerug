<?php
use App\Helpers\Frontend\MenuHelper;
$helper = new MenuHelper();
?>
<nav class="navbar navbar-default navbar-fixed-top">
    <div class="container-fluid">
        <div class="navbar-header">
            <a class="navbar-brand main-logo" href="{{ url('/') }}"><img src="{{ url('/').'/logo.jpg' }}"></a>
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#mainNavbar">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
        </div>
        <div class="collapse navbar-collapse hidden-sm hidden-xs" id="socialNavbar">
            <span class="logo-next-text" style="padding-left: 45%;font-size: 36px;position: absolute;">Pascoa</span>
            <ul class="nav navbar-nav navbar-right social">
                <li>
                    @if(Auth::check())
                        {{ link_to_route('frontend.auth.logout', 'Logout', [], ['class' => 'login' ]) }}
                    @else
                        {{ link_to_route('frontend.auth.login', trans('navs.frontend.login'), [], ['class' => 'login', 'data-toggle' => "modal", "data-target" => "#login-modal" ]) }}
                    @endif
                </li>
                <li>
                <a class="heart" href="{{ route('frontend.product.favourites') }}">
                    <i class="fas fa-heart"></i>
                    <span  class="cart-items-count"><span class=" notification-counter">{{ $helper->favouriteCount }}</span></span>
                </a>
                </li>
                <li class="rounded"><a class="facebook" href="#"><i class="fab fa-facebook-f"></i></a></li>
                <li class="rounded"><a class="twitter" href="#"><i class="fab fa-twitter"></i></a></li>
                <li class="rounded"><a class="instagram" href="#"><i class="fab fa-instagram"></i></a></li>
                <li class="rounded"><a class="youtube" href="#"><i class="fab fa-youtube"></i></a></li>
            </ul>

            <ul class="nav navbar-nav navbar-right social phonenumber">
                <li><a class="number">001 1234 5678</a></li>
                <li class="rounded"><a class="phone" href="#"><i class="fas fa-phone"></i></a></li>
            </ul>
        </div>
        <div class="collapse navbar-collapse" id="mainNavbar">
            <ul class="nav navbar-nav">
                <li><a href="{{ url('/') }}">Home</a></li>
                <li>
                    <a href="{{ route('frontend.product.product-by-type', ['type' => 'rug']) }}" class="dropdown-toggle" data-toggle="dropdown">Rug</a>
                    <ul class="dropdown-menu multi-level">
                        <li class="{{ count($helper->rugCategoryList) > 0 ? 'dropdown-submenu' : '' }}">
                            <a href="javascript:void(0);" class="{{ count($helper->rugCategoryList) > 0 ? 'dropdown-toggle' : '' }}" {{ count($helper->rugCategoryList) > 0 ? 'data-toggle="dropdown"' : '' }}>Category</a>
                            @if(count($helper->rugCategoryList) > 0)
                                <ul class="dropdown-menu">
                                    @foreach($helper->rugCategoryList as $single)
                                        <li><a href="{{ route('frontend.product.product-by-type').'/'.$single->category.'?type=rug' }}">{{ $single->category }}</a></li>
                                    @endforeach
                                </ul>
                            @endif
                        </li>
                        <li class="{{ count($helper->rugCollection) > 0 ? 'dropdown-submenu' : '' }}">
                            <a href="javascript:void(0);" class="{{ count($helper->rugCollection) > 0 ? 'dropdown-toggle' : '' }}" {{ count($helper->rugCollection) > 0 ? 'data-toggle="dropdown"' : '' }}>Collections</a>
                            @if(count($helper->rugCollection) > 0)
                                <ul class="dropdown-menu">
                                    @foreach($helper->rugCollection as $single)
                                        <li><a href="{{ route('frontend.product.product-by-type').'?type=rug&collection='.$single->id }}">{{ $single->subcategory }}</a></li>
                                    @endforeach
                                </ul>
                            @endif
                        </li>
                        <li class="{{ count($helper->rugCollection) > 0 ? 'dropdown-submenu' : '' }}">
                            <a href="javascript:void(0);" class="{{ count($helper->rugStyleList) > 0 ? 'dropdown-toggle' : '' }}" {{ count($helper->rugStyleList) > 0 ? 'data-toggle="dropdown"' : '' }}>Styles</a>
                            @if(count($helper->rugStyleList) > 0)
                                <ul class="dropdown-menu">
                                    @foreach($helper->rugStyleList as $single)
                                        <li><a href="{{ route('frontend.product.product-by-type').'?type=rug&style='.$single->id }}">{{ $single->name }}</a></li>
                                    @endforeach
                                </ul>
                            @endif
                        </li>
                        <li class="{{ count($helper->rugMaterialList) > 0 ? 'dropdown-submenu' : '' }}">
                            <a href="javascript:void(0);" class="{{ count($helper->rugMaterialList) > 0 ? 'dropdown-toggle' : '' }}" {{ count($helper->rugMaterialList) > 0 ? 'data-toggle="dropdown"' : '' }}>Materials</a>
                            @if(count($helper->rugMaterialList) > 0)
                                <ul class="dropdown-menu">
                                    @foreach($helper->rugMaterialList as $single)
                                        <li><a href="{{ route('frontend.product.product-by-type').'?type=rug&material='.$single->id }}">{{ $single->name }}</a></li>
                                    @endforeach
                                </ul>
                            @endif
                        </li>
                        <li class="{{ count($helper->rugWeaveList) > 0 ? 'dropdown-submenu' : '' }}">
                            <a href="javascript:void(0);" class="{{ count($helper->rugWeaveList) > 0 ? 'dropdown-toggle' : '' }}" {{ count($helper->rugWeaveList) > 0 ? 'data-toggle="dropdown"' : '' }}>Weaves</a>
                            @if(count($helper->rugWeaveList) > 0)
                                <ul class="dropdown-menu">
                                    @foreach($helper->rugWeaveList as $single)
                                        <li><a href="{{ route('frontend.product.product-by-type').'?type=rug&weave='.$single->id }}">{{ $single->name }}</a></li>
                                    @endforeach
                                </ul>
                            @endif
                        </li>
                        <li class="{{ count($helper->rugColorList) > 0 ? 'dropdown-submenu' : '' }}">
                            <a href="javascript:void(0);" class="{{ count($helper->rugColorList) > 0 ? 'dropdown-toggle' : '' }}" {{ count($helper->rugColorList) > 0 ? 'data-toggle="dropdown"' : '' }}>Colors</a>
                            @if(count($helper->rugColorList) > 0)
                                <ul class="dropdown-menu">
                                    @foreach($helper->rugColorList as $single)
                                        <li><a href="{{ route('frontend.product.product-by-type').'?type=rug&color='.$single->id }}"><span class="color-btn" style="background-color: {{ $single->name }}"> </span></a></li>
                                    @endforeach
                                </ul>
                            @endif
                        </li>
                        <li class="{{ count($helper->rugShapeList) > 0 ? 'dropdown-submenu' : '' }}">
                            <a href="javascript:void(0);" class="{{ count($helper->rugShapeList) > 0 ? 'dropdown-toggle' : '' }}" {{ count($helper->rugShapeList) > 0 ? 'data-toggle="dropdown"' : '' }}>Shapes</a>
                            @if(count($helper->rugShapeL