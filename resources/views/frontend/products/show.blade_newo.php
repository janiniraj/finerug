@extends('frontend.layouts.master')

@section('after-styles')
{{ Html::style('/frontend/css/normalize.css') }}
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css">
<style type="text/css">
    body {
        padding-top: 135px;
    }
    span.color-btn {
        margin-top: 3px;
    }
</style>
@endsection

@section('content')
    <div class="container" id="product">
        <input id="product_id" type="hidden" value="{{ $product->id }}">
        <div class="section">

            <div class="row">
                <div class="col-md-5">
                    @php
                        $images = json_decode($product->main_image, true);
                    @endphp
                    <div class="xzoom-container col-md-12">
                    	<div class="xzoom-main-image-container">
                        <img class="xzoom" id="xzoom-default" src="{{ admin_url(). '/img/products/thumbnail/'.$images[0] }}" xoriginal="{{ admin_url(). '/img/products/'.$images[0] }}" />
                      </div>
                        <div class="xzoom-thumbs">
                            @foreach($images as $singleKey => $singleValue)
                                <a href="{{ admin_url(). '/img/products/'.$singleValue }}"><img class="xzoom-gallery" width="80" src="{{ admin_url(). '/img/products/thumbnail/'.$singleValue }}" ></a>
                            @endforeach
                        </div>
                    </div>

                </div>

                <div class="col-md-7 product-desc">
                    <div class="path">                                                
                        <a id="favourite" class="heart {{ $favourite ? 'active' : '' }}" href="javascript:void(0);"><i class="fas fa-heart"></i></a>
                        <a class="share" href="#"><i class="fas fa-share-alt"></i></a>
                        <div id="shareIcons" class="hidden"></div>
                    </div>

                    <h2>{{ $product->name }}</h2>
                    <div class="row">
                        <div class="col-md-12">
                            @if($averageStar > 0)
                                <div value="{{ $averageStar }}" class="rating-display"></div>
                            @endif
                        </div>
                    </div>
	                  
	                  @if(Auth::check())
                        <div class="row">
                            <div class="col-md-12 padding-bottom">
                                <div class="col-md-4">
                                    <h3 class="cost">
                                        @php
                                            $user = Auth::user();
                                            $role = $user->roles->first();
                                        @endphp
                                        @if($role->name == 'Affiliate')
                                            @php 
                                                $finalPrice = number_format($product->size[0]->length*$product->size[0]->width*$product->size[0]->price_affiliate, 2, '.', '');
                                            @endphp
                                            Price : $ <span class="price-display">{{ $finalPrice }}</span>
                                        @else
                                            @php 
                                                $finalPrice = number_format($product->size[0]->length*$product->size[0]->width*$product->size[0]->price, 2, '.', '');
                                            @endphp
                                            Price : $ <span class="price-display">{{ $finalPrice }}</span>
                                        @endif
                                        
                                    </h3>
                                </div>
                                <div class="col-md-4">
                                    <select class="form-control size-select">
                                        @foreach($product->size as $single)
                                            @php
                                            $width = $single->width+0;
                                                $length = $single->length+0;

                                                $explodedLength = explode(".", $length);
                                                $explodedWidth = explode(".", $width);
                                            @endphp
                                            <option value="{{ $single->id }}">{{ $explodedWidth[0]."'".(isset($explodedWidth[1]) ? $explodedWidth[1]."''" : "") }} x {{ $explodedLength[0]."'".(isset($explodedLength[1]) ? $explodedLength[1]."''" : "") }} feet</option>
                                        @endforeach
                                    </select>
                                </div>
                                <button class="btn btn-default add-to-cart col-md-4">Add To Cart</button>
                            </div>
                        </div>
                        @else
                       		 @php 
                        		 $finalPrice = number_format($product->size[0]->length*$product->size[0]->width*$product->size[0]->price, 2, '.', '');
                     		@endphp
                      		Price : $ <span class="price-display">{{ $finalPrice }}</span>
                    @endif
	                  
                    <ul class="nav nav-pills nav-justified">
                        <li class="active"><a data-toggle="pill" href="#specs">Specs</a></li>

                       
 @if(Auth::check())
                            <li><a data-toggle="pill" href="#shop">shop</a></li>
                        @else
                            <li><a data-toggle="modal" data-target="#login-modal" href="javascript:void(0);">Buy</a></li>
                        @endif

                        <li><a href="#reviews-section">Review</a></li>
                    </ul>

                    <div class="tab-content">
                        <div id="specs" class="tab-pane fade in active">
                            <table>
                                <tr>
                                    <td>SKU</td>
                                    <td>{{ $product->sku }}</td>
                                </tr>
                                
                                 @if($product->type == 'rug')
                                    @if($product->design)
                                    <tr>
                                        <td>Design Number</td>
                                        <td>{{ $product->design }}</td>
                                    </tr>
                                    @endif
                                    @endif
                                
                                <tr>
                                    <td>Brand</td>
                                    <td>{{ $product->brand }}</td>
                                </tr>
                                @if($product->subcategory_id)
                                <tr>
                                    <td>Collection</td>
                                    <td>{{ !empty($product->subcategory) ? $product->subcategory->subcategory : '' }}</td>
                                </tr>
                                @endif
                                
                               
                                <tr>
                                    <td>Design</td>
                                    <td>{{ (isset($product->style) && $product->style) ? $product->style->name : '' }}</td>
                                </tr>
                                <tr>
                                    <td>Matterials</td>
                                    <td>{{ (isset($product->material) && $product->material) ? $product->material->name : '' }}</td>
                                </tr>
                                @if($product->type == 'rug')
                                <tr>
                                     
                                      <tr>
                                   
                                   <td>Shape</td>
                                    <td>{{ $product->shape }}</td>
                                </tr>
                                     
                                     <td>Weaves</td>
                                    <td>{{ (isset($product->weave) && $product->weave) ? $product->weave->name : '' }}</td>
                                </tr>
                                @endif
                                @if($product->colors)
                                <tr>
                                    <td>Primary Colors</td>
                                    <td>
                                        @foreach($product->colors as $single)
                                            <div class="color-container">
                                                {!! (isset($single->color) && $single->color) ? '<span class="color-btn" style="background-color: '.$single->color->name.'"> </span><span class="color-names" colorvalue="'.$single->color->name.'"></span>' : '' !!}
                                            </div>
                                        @endforeach                                    
                                    </td>
                                </tr>
                                @endif                                
                                @if($product->type == 'rug')
                                <tr>
                                    <td>Border Color</td>
                                    <td>{!! (isset($product->borderColor) && $product->borderColor) ? '<span class="color-btn" style="background-color: '.$product->borderColor->name.'"> </span><span class="color-names" colorvalue="'.$product->borderColor->name.'"></span>' : 'N/A' !!}</td>
                                </tr>                                
                               <tr>
                                    <td>Size</td>
                                    <td>
                                        @if(count($product->size))
                                            @foreach($product->size as $single)
                                                @php
                                                      $width = $single->width+0;
                                                    $length = $single->length+0;
                                                  $explodedWidth = explode(".", $width);
                                                    $explodedLength = explode(".", $length);
                                                    
                                                @endphp

                                                <span class="badge badge-secondary">{{ $explodedLength[0]."'".(isset($explodedLength[1]) ? $explodedLength[1]."''" : "") }} x {{ $explodedWidth[0]."'".(isset($explodedWidth[1]) ? $explodedWidth[1]."''" : "") }} feet</span>
                                            @endforeach
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <td>Foundation</td>
                                    <td>{{ $product->foundation }}</td>
                                </tr>
                               
                               <tr>
                                    <td>Country Of Origin</td>
                                    <td>{{ $product->country_origin }}</td>
                                </tr>
                            
                                @endif

                                
                                @if($product->type == 'rug')
                                    @if($product->age)
                                    <tr>
                                        <td>Age</td>
                                        <td>{{ $product->age }}</td>
                                    </tr>
                                    @endif
                                    
                                @endif
                                @if($product->type == 'furniture')
                                <tr>
                                    <td>Dimension</td>
                                    <td>{{ $product->dimension }}</td>
                                
                        </tr>
                        <tr>
                                    <td>Color Number</td>
                                    <td>{{ $product->design }}</td>
                                </tr>
                                @endif
                                
                                  @if($product->type == 'accessories')
                                <tr>
                                    <td>Dimension</td>
                                    <td>{{ $product->dimension }}</td>
                                </tr>
                                 
                                 <tr>
                                    <td>DesignNumber</td>
                                    <td>{{ $product->design }}</td>
                                </tr>
                                 
                                 <tr>
                                    <td>Country Of Origin</td>
                                    <td>{{ $product->country_origin }}</td>
                                </tr>
                            
                                @endif
                            
                              @if($product->type == 'lighting')
                                <tr>
                                    <td>Dimension</td>
                                    <td>{{ $product->dimension }}</td>
                                </tr>
                                @endif
                            </table>
                        </div>
                        <div id="shop" class="tab-pane fade text-center padding">
                            @php
                                $shop = json_decode($product->shop, true);
                            @endphp

                            @if(isset($shop['custom_link1']) && $shop['custom_link1'] && isset($shop['custom_logo1']) && $shop['custom_logo1'])
                                <a class="shop-icon fa-3x" target="_blank" href="{{ $shop['custom_link1'] }}"><img src="{{ admin_url().'/stores/'.$shop['custom_logo1'] }}" /></a>
                            @endif

                            @if(isset($shop['custom_link2']) && $shop['custom_link2'] && isset($shop['custom_logo2']) && $shop['custom_logo2'])
                                <a class="shop-icon fa-3x" target="_blank" href="{{ $shop['custom_link2'] }}"><img src="{{ admin_url().'/stores/'.$shop['custom_logo2'] }}" /></a>
                            @endif                            

                        </div>
                        <div id="review" class="tab-pane fade">
                            <p>Review</p>
                        </div>
                    </div>

                </div>
            </div>

            <div class="product-details">
                <h2>Product Detail</h2>
                <div class="row">
                    <div class="col-md-11 col-md-offset-1">
                        <p>{!! nl2br($product->detail) !!}</p>
                    </div>
                </div>
            </div>

            <div class="might-like">

                <div class="heading">
                    <hr><h1><span>You Might Like</span></h1>
                </div>

                <section class="slider" id="mightLikeSlider">
                    @foreach($productLike as $singleProduct)
                        @php $images = json_decode($singleProduct->main_image, true); @endphp
                        @if(isset($images) && count($images) >0)
                        <div class="">
                            <figure class="snip1174 grey">
                                <img src="{{ admin_url().'/img/products/thumbnail/'.$images[0] }}" alt="sq-sample33" />
                                <figcaption>
                                    <a href="{{ route('frontend.product.show', $singleProduct->id) }}">Quick View</a>
                                    <h2>{{ $singleProduct->name }}</h2>
                                </figcaption>
                            </figure>
                        </div>
                        @endif
                    @endforeach
                </section>

            </div>

            <div class="section" id="arrivals">
                <div class="heading">
                        <hr><h1><span>New Arrivals</span></h1>
                    <a href="{{ route('frontend.product.new-arrival') }}" class="btn btn-default btn-view-all">View All</a>
                </div>
                <section class="slider" id="arrivalsSlider">
                    @foreach($newArrivals as $singleProduct)
                        @php $images = json_decode($singleProduct->main_image, true); @endphp
                        <div class="">
                            <figure class="snip1174 grey">
                            	@if(isset($images[0]))
                                 <img src="{{ admin_url().'/img/products/thumbnail/'.$images[0] }}" alt="sq-sample33" />
                                 @endif
                                <figcaption>
                                    <a href="{{ route('frontend.product.show', $singleProduct->id) }}">Quick View</a>
                                    <h2>{{ $singleProduct->name }}</h2>
                                </figcaption>
                            </figure>
                        </div>
                    @endforeach
                </section>
            </div>

            <div id="reviews-section" class="reviews-section">
                <ul class="nav nav-tabs">
                    <li class="active"><a data-toggle="tab" href="#writeReview">WRITE A REVIEW</a></li>
                    <li><a data-toggle="tab" href="#reviews">REVIEW</a></li>
                    <?php /*<li><a data-toggle="tab" href="#question">QUESTION</a></li>*/ ?>
                </ul>

                <div class="tab-content">
                    <div id="writeReview" class="tab-pane fade in active">                    
                        {{ Form::open(array('url' => route('frontend.product.write-review'), 'id' => 'write_review_form')) }}
                            
                            <div class="form-group">
                                <label for="score">Score:</label>
                                <div id="reviewDiv"></div>
                                <input type="hidden" value="2" required id="reviewInput" name="star">
                                <input type="hidden" value="{{ $product->id }}" name="product_id">
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
                            
                        {{ Form::close() }}
                    </div>
                    <div id="reviews" class="tab-pane fade">
                        @if(count($reviews) > 0)
                            @foreach($reviews as $single)
                                <div class="user-review">
                                    <div class="username">
                                        <span>{{ $single->first_name . ' ' . $single->last_name }}</span>
                                    </div>
                                    <div class="stars">
                                        @for($i = 1; $i <= 5; $i++)
                                            <span class="fa fa-star {{ $i <= $single->star ? 'checked' : '' }}"></span>
                                        @endfor
                                    </div>
                                    <div class="user-review">
                                        <p>{{ $single->title }}</p>
                                    </div>
                                    <div class="user-review">
                                        <p>{{ $single->content }}</p>
                                    </div>
                                </div>
                            @endforeach
                        @else
                        <div class="alert alert-warning">
                            No Reviews yet.
                        </div>                              
                        @endif
                    </div>
                    <?php /*<div id="question" class="tab-pane fade">
                        <h3>Menu 2</h3>
                        <p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam.</p>
                    </div>*/ ?>
                </div>
            </div>


        </div>

    </div>
    <style type="text/css">
        .color-container {
                display: table;
        }
        
#iv-container {
            z-index: 1050;
            cursor: zoom-in;
        }
        
    </style>
@endsection

@section('after-scripts')
<script>
    /*$('.xzoom5, .xzoom-gallery5').xzoom({
        tint: '#006699',
        Xoffset: 15,
        fadeIn: true,
        smooth: true,
        smoothZoomMove: 3
    });
    $('#productImages').slickLightbox({
        itemSelector        : 'a',
        navigateByKeyboard  : true
    });*/
    $(document).ready(function() {

        $("#shareIcons").jsSocials({
            showLabel: false,
            showCount: false,
            shares: ["email", "twitter", "facebook", "googleplus", "linkedin", "pinterest", "stumbleupon", "whatsapp"]
        });

        $(".share").on('click', function(){
            $("#shareIcons").toggleClass( "hidden", 500 );
            $("#shareIcons").attr("style","");
        });

        var productId = $("#product_id").val();
        $("#favourite").on('click', function(e){
            e.preventDefault();

            var data = {
                product_id: productId
            };

            if($(this).hasClass('active'))
            {
                data['favourite'] = 0;
            }
            else
            {
                data['favourite'] = 1;
            }

            $.ajax({
                type: 'GET',
                url: "<?php echo route('frontend.product.add-favourites'); ?>",
                data: data,
                success: function(data){
                    if(data.error)
                    {
                        swal({
                            title:'Errors',
                            text: data.message,
                            type:'error'
                        }).then(function () {

                        });
                    }
                    else
                    {
                        swal({
                            title:'Thank you!',
                            text: data.message,
                            type:'success'
                        }).then(function () {
                            $("#favourite").toggleClass('active');
                        });
                    }
                }
            });
        });
        $("#reviewDiv").rateYo({
            rating: 2,
            fullStar: true,
            ratedFill: "#d4122e",
            onChange: function (rating, rateYoInstance) { 
              $("#reviewInput").val(rating);
            }
        });  

        if($(".rating-display").length)
        {
            var defaultRating = $(".rating-display").attr('value');
            $(".rating-display").rateYo({
                rating: defaultRating,
                fullStar: true,
                readOnly: true,
                ratedFill: "#d4122e",
            });
        }

        $(".color-names").each(function(e){
            var colorValue = $(this).attr('colorvalue');
            var n_match  = ntc.name(colorValue);
            if(n_match[1].length)
            {
                $(this).html(n_match[1]);
            }
        });
        var viewer = ImageViewer();
        $("#xzoom-default").on("click", function(){
            var imgSrc = this.src,
            highResolutionImage = $(this).attr("xoriginal");
             viewer.show(imgSrc, highResolutionImage);
           $(".iv-container").attr("title", "Use Mouse to zoom in and out");
        });
        

        $(".size-select").on("change", function(e){
            var sizeId = $(this).val();
            $.ajax({
                type: 'GET',
                url: "<?php echo route('frontend.product.get-price'); ?>",
                data: {
                    "product_id": productId,
                    "size_id": sizeId
                },
                dataType: "JSON",
                success: function(data) {
                    $(".price-display").text(data.price);
                }
            });
        });
        $(".add-to-cart").on('click', function(e){
            var sizeId = $(".size-select").val();
            var csrfToken = window.Laravel.csrfToken;
            $.ajax({
                type: 'POST',
                url: "<?php echo route('frontend.product.add-to-cart'); ?>",
                data: {
                    "product_id": productId,
                    "size_id": sizeId,
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
                        window.location = "<?php echo route('frontend.checkout.cart'); ?>";    
                    }
                    
                }
            });
        });
        
    });
</script>
@endsection