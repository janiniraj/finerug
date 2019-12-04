@extends('frontend.layouts.master')

@section('content')
 <header>
 <div class="container-fluid" id="header">
        <section class="slider" id="headerSlider">
            @foreach($slides as $slide)
                @if($slide->type == 'youtubevideo')
                    <!--<div>
                        <iframe class="youtube-video" src="https://www.youtube.com/embed/{{ $slide->youtubevideo_id }}" frameborder="0" allowfullscreen></iframe>
                    </div>--> 
                @else
                    <div>
                        <img height='350px' src="{{ URL::to('/').'/img/sliders/'.$slide->image }}">
                        @if($slide->title)
                            <div class="slide-caption">
                                <a href="{{url('/').'/'.$slide->url }}">
                                <h1 class="title">{{ $slide->title }}</h1>
                                </a>
                            </div>
                        @endif
                    </div>
                @endif
            @endforeach
        </section>
    </div>
   	 <!-- <div id="home-slider" class="owl-carousel">
            <div class="item">
       	 	 	<div class="row no-gutters">
                	@foreach($slides as $slide)
						@if($slide->type == 'youtubevideo')
							<!--<div class="header_content text-white text-center">
								<iframe class="youtube-video" src="https://www.youtube.com/embed/{{ $slide->youtubevideo_id }}" frameborder="0" allowfullscreen></iframe>
							</div>--
						@else
							
							<div class="col-md-7 d-none d-md-block"><img src="{{ URL::to('/').'/img/sliders/'.$slide->image }}" alt=""/></div>
							
						@endif
					@endforeach
                </div>
            </div>
            <div class="item">
       	 	 	<div class="row no-gutters">
                	<div class="col-md-7 d-none d-md-block"><img src="inc/img/header-01.jpg" alt=""/></div>
                    <div class="col-md-5">
                    	<div class="header_content text-white text-center">
                            <div>
                                <h4 class="text-uppercase m-0">Own a Rug <br> of your own Today!</h4>	
                                <h2 class="font-weight-light">@ 30% <strong class="font-weight-bold">Disocunt</strong></h2>
                                <a href="#" class="btn btn-light">Shop Now</a>
                            </div>
                        </div>
                    	<img src="/frontend/inc/img/header-02.jpg" alt=""/>
                    </div>
                </div>
            </div>
        </div>-->
    </header>  
    
    
      
    <section class="px-md-4 py-5 my-md-4">
    	<div class="container-fluid">
        	<h3 class="text-center text-uppercase font-weight-bold mb-md-4 mb-2"> Shop by</h3>
        
            <ul class="nav cust-tab text-uppercase justify-content-center mb-4" id="myTab" role="tablist">
              <li class="nav-item">
                <a class="nav-link active" data-toggle="tab" href="#shop_by_categories" role="tab"  aria-selected="true"><span class="d-none d-lg-inline">shop by</span> Categories</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" data-toggle="tab" href="#shop_by_collections" role="tab" aria-selected="false"><span class="d-none d-lg-inline">shop by</span> collections</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" data-toggle="tab" href="#shop_by_price" role="tab"  aria-selected="false"><span class="d-none d-lg-inline">shop by</span> price</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" data-toggle="tab" href="#shop_by_colors" role="tab" aria-controls="contact" aria-selected="false"><span class="d-none d-lg-inline">shop by</span> colors </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" data-toggle="tab" href="#shop_by_sizes" role="tab" aria-controls="contact" aria-selected="false"><span class="d-none d-lg-inline">shop by</span> popular sizes</a>
              </li>
              
            </ul>
            <div class="tab-content" id="myTabContent">
              <div class="tab-pane fade show active in" id="shop_by_categories">
              	<div class="row">
				@foreach($categories as $category)
					@if(file_exists(public_path().'/img/category/'.$category->icon) and $category->icon)
                	<div class=" col-lg-3 col-sm-6">
                    	<div class="fade-grid">
                        	<a href="{{ route('frontend.product.index', $category->category) }}">
                        		<figure><img src="{{ url('/').'/img/category/'.$category->icon }}" alt=""/></figure>
                                <h2>{{ $category->category }}</h2>
                            </a>
                        </div>
                    </div>
					@endif
				@endforeach	
                </div>
              </div>
              <div class="tab-pane fade" id="shop_by_collections">
			  
              	<div class="row">
				<?php $row=0;?>
				@foreach($collections as $collection)
					@if(file_exists(public_path().'/img/subcategory/'.$collection->icon) and $collection->icon)
					<?php $row++;// ?>
                	<div class="col-md-{{ $row==3 ? '3' : '3' }}">
                    	<div class="fade-grid">
                        	<a href="{{ route('frontend.product.product-by-type').'?collection='.$collection->id }}">
                        		<figure><img src="{{ url('/').'/img/subcategory/'.$collection->icon }}"  alt=""/></figure>
                                <h2>{{ $collection->subcategory }}</h2>
                            </a>
                        </div>
                    </div>
					@endif
				@endforeach
				</div>
              </div>
              <div class="tab-pane fade" id="shop_by_price" >
              	<div class="row">
                	<div class=" col-md-3">
                    	<div class="fade-grid">
                        	<a href="#">
                        		<figure><img src="/frontend/inc/img/Traditional-Rugs.jpg" alt=""/></figure>
                                <h2>Traditional Rugs</h2>
                            </a>
                        </div>
                    </div>
                    <div class=" col-md-3">
                    	<div class="fade-grid">
                        	<a href="#">
                        		<figure><img src="/frontend/inc/img/Modern-Rugs.jpg" alt=""/></figure>
                                <h2>Modern Rugs</h2>
                            </a>
                        </div>
                    </div>
                    <div class=" col-md-6">
                    	<div class="fade-grid">
                        	<a href="#">
                        		<figure><img src="/frontend/inc/img/All-rugs.jpg" alt=""/></figure>
                                <h2>All rugs</h2>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="row">
                	<div class=" col-md-3">
                    	<div class="fade-grid">
                        	<a href="#">
                        		<figure><img src="/frontend/inc/img/Carpet.jpg" alt=""/></figure>
                                <h2>Carpet</h2>
                            </a>
                        </div>
                    </div>
                    <div class=" col-md-6">
                    	<div class="fade-grid">
                        	<a href="#">
                        		<figure><img src="/frontend/inc/img/Hardwood.jpg" alt=""/></figure>
                                <h2>Hardwood</h2>
                            </a>
                        </div>
                    </div>
                    <div class=" col-md-3">
                    	<div class="fade-grid">
                        	<a href="#">
                        		<figure><img src="/frontend/inc/img/All-Flooring-products.jpg" alt=""/></figure>
                                <h2>All Flooring products</h2>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="row">
                	<div class=" col-md-6">
                    	<div class="fade-grid">
                        	<a href="#">
                        		<figure><img src="/frontend/inc/img/Kitchen-Cabinet.jpg" alt=""/></figure>
                                <h2>Kitchen Cabinet</h2>
                            </a>
                        </div>
                    </div>
                    <div class=" col-md-6">
                    	<div class="fade-grid">
                        	<a href="#">
                        		<figure><img src="/frontend/inc/img/See-All--products.jpg" alt=""/></figure>
                                <h2>See All  products</h2>
                            </a>
                        </div>
                    </div>
                </div>
              </div>
              <div class="tab-pane fade" id="shop_by_colors" >
                  <div class="row">
                      @foreach($colorList as $single)
                          <a class="col-md-1 color-front-button" href="{{ route('frontend.product.product-by-type').'?type=rug&color='. $single->id}}" style="background-color: {{$single->name}};"></a>
                      @endforeach
                  </div>
              </div>
              <div class="tab-pane fade" id="shop_by_sizes" >
                  <div class="row">
                      <div class="col-md-3 size-front-container text-center">
                          <div class="size-front-inner">
                            <a href="{{ route('frontend.product.product-by-type').'?type=rug&size=2x3'}}" class="btn size-front-button"> 2 x 3 </a>
                          </div>
                      </div>
                      <div class="col-md-3 size-front-container text-center">
                          <div class="size-front-inner">
                            <a href="{{ route('frontend.product.product-by-type').'?type=rug&size=3x5'}}" class="btn size-front-button"> 3 x 5 </a>
                          </div>
                      </div>
                      <div class="col-md-3 size-front-container text-center">
                          <div class="size-front-inner">
                            <a href="{{ route('frontend.product.product-by-type').'?type=rug&size=4x6'}}" class="btn size-front-button"> 4 x 6 </a>
                          </div>
                      </div>
                      <div class="col-md-3 size-front-container text-center">
                          <div class="size-front-inner">
                            <a href="{{ route('frontend.product.product-by-type').'?type=rug&size=5x8'}}" class="btn size-front-button"> 5 x 8 </a>
                          </div>
                      </div>
                      <div class="col-md-3 size-front-container text-center">
                          <div class="size-front-inner">
                            <a href="{{ route('frontend.product.product-by-type').'?type=rug&size=6x9'}}" class="btn size-front-button"> 6 x 9 </a>
                          </div>
                      </div>
                      <div class="col-md-3 size-front-container text-center">
                          <div class="size-front-inner">
                            <a href="{{ route('frontend.product.product-by-type').'?type=rug&size=8x10'}}" class="btn size-front-button"> 8 x 10 </a>
                          </div>
                      </div>
                      <div class="col-md-3 size-front-container text-center">
                          <div class="size-front-inner">
                            <a href="{{ route('frontend.product.product-by-type').'?type=rug&size=9x12'}}" class="btn size-front-button"> 9 x 12 </a>
                          </div>
                      </div>
                      <div class="col-md-3 size-front-container text-center">
                          <div class="size-front-inner">
                            <a href="{{ route('frontend.product.product-by-type').'?type=rug&size=10x14'}}" class="btn size-front-button"> 10 x 14 </a>
                          </div>
                      </div>
                  </div>
              </div>
            </div>
        </div>
    </section>
    
    <section class="px-md-4 py-5 bg-gray">
    	<div class="container-fluid">
        	<h2 class="text-center sorts text-uppercase text-danger h1 m-0">clearance </h2>
            <h6 class="text-center mb-5">deals too good to last</h6>
            <div class="px-4 px-md-0">
          		<div id="pro-slider" class="owl-carousel text-center">
                <div class="item">
                    <a href="#"><img src="/frontend/inc/img/img04.jpg" alt=""/></a>
               	  <h2><a href="#">Products Name</a></h2>    
            	</div>
                <div class="item">
                    <a href="#"><img src="/frontend/inc/img/img05.jpg" alt=""/></a>
                    <h2><a href="#">Products Name</a></h2>  
                </div>
                <div class="item">
                    <a href="#"><img src="/frontend/inc/img/img04.jpg" alt=""/></a>
               	  <h2><a href="#">Products Name</a></h2>    
            	</div>
                <div class="item">
                    <a href="#"><img src="/frontend/inc/img/img05.jpg" alt=""/></a>
                    <h2><a href="#">Products Name</a></h2>  
                </div>
          	</div>
            </div>
            <div class="text-center pt-4">
            	<a href="#" class="btn btn-primary btn-lg">VIEW ALL</a>
            </div>
        </div>
    </section>
    
    <section class="px-md-4 py-5 my-md-4">
    	<div class="container-fluid">
        	<h2 class="text-center text-uppercase font-weight-normal">Partners</h2>
            <hr>
            <div class="px-sm-5 px-4">
            <div id="logo-slider" class="owl-carousel text-center">
                <div class="item">
                    <a href="#"><img src="/frontend/inc/img/logo01.jpg" alt=""/></a>
               	</div>
                <div class="item">
                    <a href="#"><img src="/frontend/inc/img/logo02.jpg" alt=""/></a>
                </div>
                <div class="item">
                    <a href="#"><img src="/frontend/inc/img/logo03.jpg" alt=""/></a>
               	</div><div class="item">
                    <a href="#"><img src="/frontend/inc/img/logo01.jpg" alt=""/></a>
               	</div>
                <div class="item">
                    <a href="#"><img src="/frontend/inc/img/logo02.jpg" alt=""/></a>
                </div>
                <div class="item">
                    <a href="#"><img src="/frontend/inc/img/logo03.jpg" alt=""/></a>
               	</div><div class="item">
                    <a href="#"><img src="/frontend/inc/img/logo01.jpg" alt=""/></a>
               	</div>
                <div class="item">
                    <a href="#"><img src="/frontend/inc/img/logo02.jpg" alt=""/></a>
                </div>
                <div class="item">
                    <a href="#"><img src="/frontend/inc/img/logo03.jpg" alt=""/></a>
               	</div>
          	</div>
            </div>
        </div>
    </section>
    
    
  <?php 
/*
    <div class="container-fluid" id="header">
        <section class="slider" id="headerSlider">
            @foreach($slides as $slide)
                @if($slide->type == 'youtubevideo')
                    <div>
                        <iframe class="youtube-video" src="https://www.youtube.com/embed/{{ $slide->youtubevideo_id }}" frameborder="0" allowfullscreen></iframe>
                    </div>
                @else
                    <div>
                        <img src="{{ URL::to('/').'/img/sliders/'.$slide->image }}">
                        @if($slide->title)
                            <div class="slide-caption">
                                <a href="{{url('/').'/'.$slide->url }}">
                                <h1 class="title">{{ $slide->title }}</h1>
                                </a>
                            </div>
                        @endif
                    </div>
                @endif
            @endforeach
        </section>
    </div>

    <div class="container sections" id="homepage">
        <div class="section" id="categories">
            <div class="heading">
                <hr><h1><span>Categories</span></h1>
            </div>
            <section class="slider" id="categoriesSlider">
                @foreach($categories as $category)
                    <div class="">
                        <figure class="snip1174 grey">
                            <img src="{{ url('/').'/img/category/'.$category->icon }}" alt="sq-sample33" />
                            <figcaption>
                                <a href="{{ route('frontend.product.index', $category->category) }}">Quick View</a>
                                <h2>{{ $category->category }}</h2>
                            </figcaption>
                        </figure>
                    </div>
                @endforeach
            </section>
        </div>

        <div class="section" id="featured">
            <div class="heading">
                <hr><h1><span>Featured Items</span></h1>
            </div>
            <section class="slider" id="featuredSlider">
                @foreach($collections as $collection)
                    <div class="">
                        <figure class="snip1174 grey">
                            <img src="{{ url('/').'/img/subcategory/'.$collection->icon }}" alt="sq-sample33" />
                            <figcaption>
                                <a href="{{ route('frontend.product.product-by-type').'?collection='.$collection->id }}">Quick View</a>
                                <h2>{{ $collection->subcategory }}</h2>
                            </figcaption>
                        </figure>
                    </div>
                @endforeach
            </section>
        </div>

        <div class="section" id="services">
            <div class="heading">
                    <hr><h1><span>Chic & Modern Furniture</span></h1>
            </div>
            <section class="slider" id="servicesSlider">
                @foreach($furnitures as $product)
                    @php $images = json_decode($product->main_image, true); @endphp
                    <div class="">
                        <figure class="snip1174 grey">
                            <img src="{{ URL::to('/').'/img/products/thumbnail/'.$images[0] }}" alt="sq-sample33" />
                            <figcaption>
                                <a href="{{ route('frontend.product.show', $product->id) }}">Quick View</a>
                                <h2>{{ $product->name }}</h2>
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
                @foreach($newArrivals as $product)
                    @php $images = json_decode($product->main_image, true); @endphp
                    <div class="">
                        <figure class="snip1174 grey">
                            <img src="{{ URL::to('/').'/img/products/thumbnail/'.$images[0] }}" alt="sq-sample33" />
                            <figcaption>
                                <a href="{{ route('frontend.product.show', $product->id) }}">Quick View</a>
                                <h2>{{ $product->name }}</h2>
                            </figcaption>
                        </figure>
                    </div>
                @endforeach
            </section>
        </div>

    </div>
    */?>
@endsection