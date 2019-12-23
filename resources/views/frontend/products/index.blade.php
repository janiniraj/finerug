<?php

if(isset($_GET['price_range'])){
	$tempArray = explode(";",$_GET['price_range']);
	$price_range_from = $tempArray[0];
	$price_range_to = $tempArray[1];
}else{
	$price_range_from = 0;
	$price_range_to = 50000;
}

?>
@extends('frontend.layouts.master')
@section('content')
 <style>
        .bootstrap-tagsinput {
            border: none;
            box-shadow: none;
        }
        .bootstrap-tagsinput .tag.label {
            font-size: 15px;
        }
        .bootstrap-tagsinput input {
            display: none;
        }
		.label-default {
			background-color: #453dc1;
		}
		.clear-filter{
			margin-left:20px !important;
		}
    </style>
   <section class="px-md-4 py-5">
    	<div class="container-fluid">
        	<div class="category-wrap">
            	<div class="left-fillter">
				<a href="{{ route('frontend.product.product-by-type',['type' => 'all']) }}" class="btn-lg btn-danger clear-filter" >Clear Filter</a>
                <div class="col-md-8">
                <input value="" id="filter_display">
            </div>
				</div>
                <div class="right-content">
				<?php
				$str = "";$strArr = array();
				$title = "";
				foreach($filterDisplay as $k => $fvalue){
					$tempArr =  explode(": ",$fvalue);
					if($k=='Product'){
						$title = $tempArr[1];
						$strArr[]  = "<a href='". route('frontend.product.product-by-type',['type' => strtolower($title)])."'>".$tempArr[1]."</a>";
					}
					if($k=='Category') $strArr[]  = "<a href='".route('frontend.product.product-by-type')."/".$tempArr[1]."?type=".strtolower($title)."'>".$tempArr[1]."</a>";
					if($k=='Collection') $strArr[]  = $tempArr[1];
					$str = implode(' <span>/</span> ',$strArr);
				}

				?>
                	<h2 class="text-center h3 font-weight-bold text-uppercase">
					{{$title}}</h2>
                    <div class="breadcrumb-cust text-center">
					<?php echo $str;?>
                    	&nbsp;&nbsp;&nbsp;
						{{ 'Results '. (($products->currentPage()-1)*config('constant.perPage')+1).'-'.(($products->currentPage()-1)*config('constant.perPage')+$products->count()).' of '.$products->total() }} 
                    </div>
                    <div class="row pt-3 pb-2">
                        <div class="col-6 small">
                        	<div class="btn btn-sm btn-secondary d-inline-block d-lg-none mr-3 rounded fltr-btn"><i class="fas fa-sliders-h"></i> Fillter</div>
                            <span class="d-none d-sm-inline-block">Page  1 - 20</span>
                        </div>
                        <div class="col-6">
                            {{ Form::open(['method' => 'GET','id'=> 'sortForm','name'=> 'sortForm', 'class' => 'form-inline justify-content-end']) }}
                              <div class="form-group small">
                                <label for="inputPassword6" class="d-none d-sm-inline-block">Sort By</label>
                                <select name="sort" class="custom-select custom-select-sm ml-sm-3 sort-select">
                                  <option {{ (!isset($filterData['sort']) || (isset($filterData['sort']) && $filterData['sort'] == 'best_selling')) ? 'selected' : '' }} value="best_selling">Best Selling</option>
                                  <option {{ (isset($filterData['sort']) && $filterData['sort'] == 'new_arrival') ? 'selected' : '' }} value="new_arrival">New Arrival</option>
                                  <option {{ (isset($filterData['sort']) && $filterData['sort'] == 'name_asc') ? 'selected' : '' }} value="name_asc">Name(A-Z)</option>
                                  <option {{ (isset($filterData['sort']) && $filterData['sort'] == 'name_desc') ? 'selected' : '' }} value="name_desc">Name(Z-A)</option>
                                  <option {{ (isset($filterData['sort']) && $filterData['sort'] == 'price_asc') ? 'selected' : '' }} value="price_asc">Price (Low to High)</option>
                                  <option {{ (isset($filterData['sort']) && $filterData['sort'] == 'price_desc') ? 'selected' : '' }} value="price_desc">Price (High to Low)</option>
                                </select>
                              </div>
                            {{ Form::close() }}
                        </div>
                    </div>
                </div>
            </div>
            <div class="category-wrap">
            	<div class="left-fillter fillter-wrap">
				{{ Form::open(['method' => 'GET','id'=> 'filterForm','name'=> 'filterForm']) }}
                	<div class="fillter-sec active" style="display:none;">
					<input type="hidden" name="type" class="filter-input" value="{{ isset($filterData['type']) && $filterData['type'] ? $filterData['type'] : 'all' }}">
                    	<h2>Product</h2>
                        <div class="fillter-content fix-wheight">
                        	<ul class="list-unstyled m-0">
                            	<li><a  class="filter-option {{ !isset($filterData['type']) || (isset($filterData['type']) && $filterData['type'] == 'all') ? 'active' : '' }}" fieldvalue="all" href="{{ route('frontend.product.product-by-type',['type' => 'all']) }}">All</a></li>
                            	<li><a class="filter-option {{ isset($filterData['type']) && $filterData['type'] == 'rug' ? 'active' : '' }}" fieldvalue="rug" href="javascript:void(0);" >Rug</a></li>
                                <li><a class="filter-option {{ isset($filterData['type']) && $filterData['type'] == 'furniture' ? 'active' : '' }}" fieldvalue="furniture" href="javascript:void(0);">Furniture</a></li>
                                <li><a class="filter-option {{ isset($filterData['type']) && $filterData['type'] == 'flooring' ? 'active' : '' }}" fieldvalue="flooring" href="javascript:void(0);">Flooring</a></li>
                            </ul>
                        </div>
                    </div>
					@if(!empty($collectionList))
                    <div class="fillter-sec active">
                       <input type="hidden" name="collection" class="filter-input">
                    	<h2>Collection </h2>
                        <div class="fillter-content">
                        	<ul class="list-unstyled m-0 small px-2 form-list fix-wheight">
							@foreach($collectionList as $single)
                            	<li><a class="filter-option {{ isset($filterData['collection']) && $filterData['collection'] == $single->id ? 'active' : '' }}" fieldvalue="{{ $single->id }}" href="javascript:void(0);">{{ $single->subcategory }}</a></li>
							@endforeach
                            </ul>
                        </div>
                    </div>
					@endif
					
					@if(!empty($sizeList))
                    <div class="fillter-sec active">
                    	<h2>Size </h2>
                        <div class="fillter-content ">
                        	<!--<formx class="d-block pb-3" >
                                  <div class="form-group m-0">
                                    <input type="text" class="form-control form-control-sm" placeholder="Search">
                                  </div>
                            </formx>
						 -->
							
                        	<ul class="list-unstyled m-0 small px-2 form-list fix-wheight">
							<?php
								$i=0;
								$selectedSizeArray[] = 0;
								if(isset($_GET['sizes']))foreach($_GET['sizes'] as $val) $selectedSizeArray[] = $val;
							?>
							@foreach($sizeList as $single)
                            	<li>
                                	<div class="custom-control custom-checkbox">
                                      <input type="checkbox" class="custom-control-input" name="sizes[]" id="customCheck{{++$i}}" value="{{floor($single->width)}}x{{floor($single->length)}}" {{ isset($_GET['collection']) && array_search(floor($single->width)."x".floor($single->length),$selectedSizeArray) ? 'checked' : '' }}>
                                      <label class="custom-control-label" for="customCheck{{$i}}" >{{floor($single->width)}}’ x {{floor($single->length)}}’</label>
                                    </div>
                                </li>
							@endforeach
                            </ul>
                        </div>
                    </div>
					@endif
                    @if(!empty($colorList))
                     <div class="fillter-sec active">
                       <input type="hidden" name="color" id="color" class="filter-input">
                    	<h2>Color </h2>
                        <div class="fillter-content">
                        	<ul class="list-unstyled m-0 small px-2 color-list">
							@foreach($colorList as $single)
                            	<li>
                                	<a href="javascript:void(0);" class="filter-option"  style="background-color:{{$single->name}}" fieldvalue="{{ $single->id }}"></a>
                                </li>
								@endforeach
                            </ul>
                        </div>
                    </div>
                    @endif
                     <div class="fillter-sec active">
                    	<h2>Price </h2>
                        <div class="fillter-content px-2 mt-2">
                        	 <input type="text" class="js-range-slider" name="price_range" id="price_range" value="<?php echo @$_GET['price_range']?>" />
                        </div>
                    </div>
                    
                    @if(!empty($styleList))
						<div class="fillter-sec active">
                         <input type="hidden" name="style" class="filter-input">
							<h2>style</h2>
							<div class="fillter-content fix-wheight">
								<ul class="list-unstyled m-0">
								@foreach($styleList as $single)
									<li><a class="filter-option {{ isset($filterData['style']) && $filterData['style'] == $single->id ? 'active' : '' }}" fieldvalue="{{ $single->id }}" href="javascript:void(0);">{{ $single->name }}</a></li>
								@endforeach
								</ul>
							</div>
						</div>
					@endif
					@if(!empty($materialList))
                    <div class="fillter-sec active">
						<input type="hidden" name="material" class="filter-input">
						<h2>Material</h2>
                        <div class="fillter-content fix-wheight">
                        	<ul class="list-unstyled m-0">
							@foreach($materialList as $single)
                            	<li><a class="filter-option {{ isset($filterData['material']) && $filterData['material'] == $single->id ? 'active' : '' }}" fieldvalue="{{ $single->id }}" fieldvalue="{{ $single->id }}" href="javascript:void(0);">{{ $single->name }}</a></li>
							@endforeach
                            </ul>
                        </div>
                    </div>
					@endif
                      @if(!empty($brandList))
                    <div class="fillter-sec active">
					<input type="hidden" name="brand" class="filter-input">
                    	<h2>Brands </h2>
                        <div class="fillter-content fix-wheight">
                        	<ul class="list-unstyled m-0">
								@foreach($brandList as $single)
									<li><a class="filter-option {{ isset($filterData['brand']) && $filterData['brand'] == $single->brand ? 'active' : '' }}" fieldvalue="{{ $single->brand }}" fieldvalue="{{ $single->id }}" href="javascript:void(0);">{{ $single->brand }}</a></li>
								@endforeach      
							</ul>
                        </div>
                    </div>
					@endif
					
                    @if(!empty($discountList))
                    <div class="fillter-sec active">
						<input type="hidden" name="discount" class="filter-input">
                    	<h2>Discount</h2>
                        <div class="fillter-content fix-wheight">
                        	<ul class="list-unstyled m-0">
								@foreach($discountList as $single)
									<li><a class="filter-option {{ isset($filterData['discount']) && $filterData['discount'] == $single->discount ? 'active' : '' }}" fieldvalue="{{ $single->discount }}" fieldvalue="{{ $single->id }}" href="javascript:void(0);">Discount {{ $single->discount }}%</a></li>
								@endforeach 
                            </ul>
                        </div>
                    </div>
                    @endif
                    
                    <div class="fillter-sec">
                    	<h2>Clearance</h2>
                        <div class="fillter-content fix-wheight">
                        	<ul class="list-unstyled m-0">
                            	<li><a href="#">First Clearance</a></li>
                                <li><a href="#">Second Clearance</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="fltr-apply d-block d-lg py-3">
                    	<button id="filter_submit" type="submit" class="btn btn-lg btn-danger btn-block">Apply</button>
                    </div>
				</form>
                </div>
                <div class="right-content">
                    <div class="row">
                        @if($collectionData)
                            <img src="{{ URL::to('/').'/img/subcategory/'.$collectionData->image }}">

                        @elseif($categoryData)
                            <img src="{{ URL::to('/').'/img/category/'.$categoryData->image }}">
                        @endif
                    </div>
                	<div class="row">
						@if(count($products))
							@foreach($products as $product)
                                @php
                                    $isSoldOut = 1;

                                    foreach ($product->size as $single)
                                    {
                                        if($single->quantity > 0)
                                        {
                                            $isSoldOut = 0;
                                        }
                                    }
                                @endphp
							<div class="col-xl-3 col-md-4 col-sm-6">
								<div class="pro-grid sale_on favourite_on">
									<figure>
										<!--<div class="sale">Sale</div>-->
										<a href="#" class="pro_favourite"><i class="fas fa-heart"></i></a>
										@php $images = json_decode($product->main_image, true); @endphp
										<a href="{{ route('frontend.product.show', $product->id) }}">
										<?php
										if(count($images)>0){
										?><img src="{{ URL::to('/').'/img/products/thumbnail/'.$images[0] }}" alt="Item"/>
										<?php } ?>
										</a>
										<a href="{{ route('frontend.product.show', $product->id) }}" class="quick-view-btn btn btn-sm btn-danger">Quick View</a>
                                        @if($isSoldOut == 1)
                                            <a class="sold_out" href="#">Sold out</a>
                                        @endif
									</figure>
									<div class="gird-price"><sub>USD</sub> {{$product->price}} </div>
									<p class="grid-info"><a href="{{ route('frontend.product.show', $product->id) }}">{{$product->name}}</a></p>
								</div>
							</div>
							@endforeach
						@else
							<div class="alert alert-warning">
                            No Products Found.
                        </div>
						@endif
					{{ $products->links() }}
                        
                        
                    </div>
                    <div class="py-4">
					<!--
                    	<nav aria-label="navigation">
                          <ul class="pagination pagination-custom justify-content-center">
                            <li class="page-item disabled">
                              <a class="page-link" href="#" tabindex="-1" aria-disabled="true"><i class="fas fa-chevron-left"></i></a>
                            </li>
                            <li class="page-item active"><a class="page-link" href="#">1</a></li>
                            <li class="page-item"><a class="page-link" href="#">2</a></li>
                            <li class="page-item"><a class="page-link" href="#">3</a></li>
                            <li class="page-item"><a class="page-link" href="#">4</a></li>
                            <li class="page-item"><a class="page-link" href="#">5</a></li>
                            <li class="page-item">
                              <a class="page-link" href="#"><i class="fas fa-chevron-right"></i></a>
                            </li>
                          </ul>
                        </nav>
                    </div>
					-->
                </div>
            </div>
        </div>
    </section>
	
	<section class="px-md-4 pb-5">
    	<div class="container-fluid">
        	<div class="row">
            	<div class="col-lg-6 mb-3"><a href="#"><img src="../frontend/inc/img/banner.jpg" alt=""/></a></div>
                <div class="col-lg-6"><a href="#"><img src="../frontend/inc/img/banner02.jpg" alt=""/></a></div>
            </div>
        </div>
    </section>
@endsection
@section('after-scripts')
<script>
    var filterData = <?php echo json_encode($filterDisplay); ?>;
    $(".filter-option").on('click', function (e) {
		$(this).closest('.fillter-sec').find('.filter-option').each(function(){
            if($(this).hasClass('active'))
            {
                $(this).removeClass('active');
            }
        });
        $(this).addClass('active');
        var fieldValue = $(this).attr('fieldvalue');
        $(this).closest('.fillter-sec').find('.filter-input').val(fieldValue);
		$("#filterForm").submit();
    });
	$(".custom-control-input").on('click', function (e) {
		$("#filterForm").submit();
	});
	$("#price_range").on('change', function (e) {
		$("#filterForm").submit();
	});
	
	$(".sort-select").on('change', function () {
        $("#sortForm").submit();
    });
	
    var elt = $('#filter_display');
    $('#filter_display').tagsinput({
        tagClass: function(item) {
            if(item.type=='Color')
            {
                return 'label cl color-' + item.value;
            }

            if(item.type=='Border Color')
            {
                return 'label cl border-' + item.value;
            }
            return 'label label-default';
        },
        itemValue: 'value',
        itemText: 'text'
    });

    $.each(filterData, function( i , v )
    {
        elt.tagsinput('add', { "value": v , "text": v , "type": i });
        changeColor();
    });

    function changeColor()
    {
        $(".cl").each(function(){
            var classList = this.classList;
            var label = this;
            $.each(classList, function(){
                if(this.indexOf("color-") != -1)
                {
                    var colorName = this.replace("color-",'');
                    $(label).attr('style', 'background: '+ colorName);
                    var html = $(label).html();
                    $(label).html(html.replace(colorName,'Color'));
                }

                if(this.indexOf("border-") != -1)
                {
                    var colorName = this.replace("border-",'');
                    $(label).attr('style', 'background: '+ colorName);
                    var html = $(label).html();
                    $(label).html(html.replace(colorName,'Border Color'));
                }
            });
        });
    }

    elt.on('itemRemoved', function(event) {
        if(event.item.type == 'Color')
        {
            $('select[name="color"]').val("");
        }

        if(event.item.type == 'Product')
        {
            $('.filter-input[name="type"]').val("");
        }

        if(event.item.type == 'Category')
        {
            $('.filter-input[name="category"]').val("");
        }

        if(event.item.type == 'Collection')
        {
            $('.filter-input[name="Collection"]').val("");
        }

        if(event.item.type == 'Style')
        {
            $('.filter-input[name="Style"]').val("");
        }

        if(event.item.type == 'Material')
        {
            $('.filter-input[name="Material"]').val("");
        }

        if(event.item.type == 'Weave')
        {
            $('.filter-input[name="Weave"]').val("");
        }

        if(event.item.type == 'Shape')
        {
            $('.filter-input[name="Shape"]').val("");
        }

        if(event.item.type == 'Size')
        {
            $('input[name="width_min"],input[name="width_max"],input[name="length_min"],input[name="length_max"]').val("")
        }
        $("#filter_submit").click();
    });
	
	$(".js-range-slider").ionRangeSlider({
        type: "double",
        min: 0,
        max: 50000,
        from: <?php echo $price_range_from;?>,
        to: <?php echo $price_range_to;?>,
        grid: false
    });
</script>
@endsection
