@extends('frontend.layouts.master')

@section('after-styles')
{{ Html::style('/frontend/css/normalize.css') }}
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css">
<style type="text/css">
    body {
        padding-top: 135px;
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
                        <img class="xzoom" id="xzoom-default" src="{{ url('/'). '/img/products/thumbnail/'.$images[0] }}" xoriginal="{{ url('/'). '/img/products/'.$images[0] }}" />
                        <div class="xzoom-thumbs">
                            @foreach($images as $singleKey => $singleValue)
                                <a href="{{ url('/'). '/img/products/'.$singleValue }}"><img class="xzoom-gallery" width="80" src="{{ url('/'). '/img/products/thumbnail/'.$singleValue }}" ></a>
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

                    <ul class="nav nav-pills nav-justified">
                        <li class="active"><a data-toggle="pill" href="#specs">Specs</a></li>
                        <li><a data-toggle="pill" href="#shop">Shop</a></li>
                        <li><a href="#reviews-section">Review</a></li>
                    </ul>

                    <div class="tab-content">
                        <div id="specs" class="tab-pane fade in active">
                            <table>
                                <tr>
                                    <td>SKU</td>
                                    <td>{{ $product->sku }}</td>
                                </tr>
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
                                    <td>Size</td>
                                    <td>
                                        @if(count($product->size))
                                            @foreach($product->size as $single)
                                                <span class="badge badge-secondary">{{ $single->length+0 }} x {{ $single->width+0 }} feet</span>
                                            @endforeach
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <td>Shape</td>
                                    <td>{{ $product->shape }}</td>
                                </tr>
                                <tr>
                                    <td>Design</td>
                                    <td>{{ (isset($product->style) && $product->style) ? $product->style->name : '' }}</td>
                                </tr>
                                <tr>
                                    <td>Matterials</td>
                                    <td>{{ (isset($product->material) && $product->material) ? $product->material->name : '' }}</td>
                                </tr>
                                <tr>
                                    <td>Color</td>
                                    <td>{!! (isset($product->color) && $product->color) ? '<span class="color-btn" style="background-color: '.$product->color->name.'"> </span>' : '' !!}</td>
                                </tr>
                                <tr>
                                    <td>Border Color</td>
                                    <td>{!! (isset($product->borderColor) && $product->borderColor) ? '<span class="color-btn" style="background-color: '.$product->borderColor->name.'"> </span>' : '' !!}</td>
                                </tr>
                                <tr>
                                    <td>Foundation</td>
                                    <td>{{ $product->foundation }}</td>
                                </tr>
                                <tr>
                                    <td>Knote per sq.</td>
                                    <td>{{ $product->knote_per_sq }}</td>
                                </tr>
                            </table>
                        </div>
                        <div id="shop" class="tab-pane fade text-center padding">
                            @php
                                $shop = json_decode($product->shop, true);
                            @endphp

                            @if(isset($shop['amazon_link']))
                                <a class="shop-icon fa-3x" target="_blank" href="{{ $shop['amazon_link'] }}"><i class="fab fa-amazon"></i></a>
                            @endif

                            @if(isset($shop['ebay_link']))
                                <a class="shop-icon fa-3x" target="_blank" href="{{ $shop['ebay_link'] }}"><i class="fab fa-ebay "></i></a>
                            @endif

                            @if(isset($shop['other_link']))
                                <a class="shop-icon fa-3x" target="_blank" href="{{ $shop['other_link'] }}"><i class="fas fa-link"></i></a>
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
                        <p>{{ $product->detail }}</p>
                    </div>
                </div>
            </div>

            <div class="might-like">

                <div class="heading">
                    <hr><h1><span>You Might Like This</span></h1>
                </div>

                <section class="slider" id="mightLikeSlider">
                    @foreach($productLike as $singleProduct)
                        @php $images = json_decode($singleProduct->main_image, true); @endphp
                        <div class="">
                            <figure class="snip1174 grey">
                                <img src="{{ URL::to('/').'/img/products/thumbnail/'.$images[0] }}" alt="sq-sample33" />
                                <figcaption>
                                    <a href="{{ route('frontend.product.show', $singleProduct->id) }}">Quick View</a>
                                    <h2>{{ $singleProduct->name }}</h2>
                                </figcaption>
                            </figure>
                        </div>
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
                                <img src="{{ URL::to('/').'/img/products/thumbnail/'.$images[0] }}" alt="sq-sample33" />
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
            $("#shareIcons").toggleClass( "hidden", 1000 );
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
    });
</script>
@endsection