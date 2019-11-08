@extends('frontend.layouts.master')
@section('content')
   <section class="px-md-4 py-5">
    	<div class="container-fluid">
        	<div class="category-wrap">
            	<div class="left-fillter">
                
                </div>
                <div class="right-content">
                	<h2 class="text-center h3 font-weight-bold text-uppercase">Area Rugs</h2>
                    <div class="breadcrumb-cust text-center">
                    	<a href="#">Home Goods</a> <span>/</span> <a href="#">Home Decor</a> <span>/</span> <a href="#">Rugs</a> <span>/</span> Area Rugs 
						{{ 'Results '. (($products->currentPage()-1)*config('constant.perPage')+1).'-'.(($products->currentPage()-1)*config('constant.perPage')+$products->count()).' of '.$products->total() }} 
                    </div>
                    <div class="row pt-3 pb-2">
                        <div class="col-6 small">
                        	<div class="btn btn-sm btn-secondary d-inline-block d-lg-none mr-3 rounded fltr-btn"><i class="fas fa-sliders-h"></i> Fillter</div>
                            <span class="d-none d-sm-inline-block">Page  1 - 20</span>
                        </div>
                        <div class="col-6">
                        	<form class="form-inline justify-content-end">
                              <div class="form-group small">
                                <label for="inputPassword6" class="d-none d-sm-inline-block">Sort By</label>
                                <select class="custom-select custom-select-sm ml-sm-3">
                                  <option selected>Best Selling</option>
                                  <option value="1">One</option>
                                  <option value="2">Two</option>
                                  <option value="3">Three</option>
                                </select>
                              </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="category-wrap">
            	<div class="left-fillter fillter-wrap">
                	<div class="fillter-sec active">
                    	<h2>Product</h2>
                        <div class="fillter-content fix-wheight">
                        	<ul class="list-unstyled m-0">
                            	<li><a href="?type=All">All</a></li>
                            	<li><a href="?type=Rug">Rug</a></li>
                                <li><a href="?type=Furniture">Furniture</a></li>
                                <li><a href="?type=Flooring">Flooring</a></li>
                            </ul>
                        </div>
                    </div>
					@if(!empty($collectionList))
                    <div class="fillter-sec active">
                    	<h2>Collection </h2>
                        <div class="fillter-content">
                        	<ul class="list-unstyled m-0">
							@foreach($collectionList as $single)
                            	<li><a href="javascript:void(0);" fieldvalue="{{ $single->id }}">{{ $single->subcategory }}</a></li>
							@endforeach
                            </ul>
                        </div>
                    </div>
					@endif
                    <div class="fillter-sec active">
                    	<h2>Size </h2>
                        <div class="fillter-content ">
                        	<form class="d-block pb-3">
                                  <div class="form-group m-0">
                                    <input type="text" class="form-control form-control-sm" placeholder="Search">
                                  </div>
                            </form>
                        	<ul class="list-unstyled m-0 small px-2 form-list fix-wheight">
                            	<li>
                                	<div class="custom-control custom-checkbox">
                                      <input type="checkbox" class="custom-control-input" id="customCheck1">
                                      <label class="custom-control-label" for="customCheck1"> 8’ x 10’</label>
                                    </div>
                                </li>
                                <li>
                                	<div class="custom-control custom-checkbox">
                                      <input type="checkbox" class="custom-control-input" id="customCheck2">
                                      <label class="custom-control-label" for="customCheck2"> 9’ x 12’</label>
                                    </div>
                                </li>
                                <li>
                                	<div class="custom-control custom-checkbox">
                                      <input type="checkbox" class="custom-control-input" id="customCheck3">
                                      <label class="custom-control-label" for="customCheck3"> 5’ x 8’</label>
                                    </div>
                                </li>
                                <li>
                                	<div class="custom-control custom-checkbox">
                                      <input type="checkbox" class="custom-control-input" id="customCheck4">
                                      <label class="custom-control-label" for="customCheck4"> 8’ x 12’</label>
                                    </div>
                                </li>
                                <li>
                                	<div class="custom-control custom-checkbox">
                                      <input type="checkbox" class="custom-control-input" id="customCheck5">
                                      <label class="custom-control-label" for="customCheck5"> 7’ x 9’</label>
                                    </div>
                                </li>
                                <li>
                                	<div class="custom-control custom-checkbox">
                                      <input type="checkbox" class="custom-control-input" id="customCheck6">
                                      <label class="custom-control-label" for="customCheck6"> 8’ x 14’</label>
                                    </div>
                                </li>
                                <li>
                                	<div class="custom-control custom-checkbox">
                                      <input type="checkbox" class="custom-control-input" id="customCheck7">
                                      <label class="custom-control-label" for="customCheck7"> 7’ x 9’</label>
                                    </div>
                                </li>
                                <li>
                                	<div class="custom-control custom-checkbox">
                                      <input type="checkbox" class="custom-control-input" id="customCheck8">
                                      <label class="custom-control-label" for="customCheck8"> 8’ x 14’</label>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                    @if(!empty($colorList))
                     <div class="fillter-sec active">
                    	<h2>Color </h2>
                        <div class="fillter-content">
                        	<ul class="list-unstyled m-0 small px-2 color-list">
							@foreach($colorList as $singleKey => $singleValue)
                            	<li>
                                	<a href="#" style="background-color:red">{{$singleValue->id}}{{ $singleValue->name }}</a>
                                </li>
								@endforeach
                            </ul>
                        </div>
                    </div>
                    @endif
                     <div class="fillter-sec active">
                    	<h2>Price </h2>
                        <div class="fillter-content px-2 mt-2">
                        	 <input type="text" class="js-range-slider" name="my_range" value="" />
                        </div>
                    </div>
                    
                    <div class="fillter-sec active">
                    	<h2>style</h2>
                        <div class="fillter-content fix-wheight">
                        	<ul class="list-unstyled m-0">
                            	<li><a href="#">First Product Name</a></li>
                                <li><a href="#">Fourth Product Name</a></li>
                                <li><a href="#">Fifth Product Name</a></li>
                                <li><a href="#">Sixth Product Name</a></li>
                            </ul>
                        </div>
                    </div>
					@if(!empty($materialList))
                    <div class="fillter-sec">
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
                    
                    <div class="fillter-sec">
                    	<h2>Brands </h2>
                        <div class="fillter-content fix-wheight">
                        	<ul class="list-unstyled m-0">
                            	<li><a href="#">First Product Name</a></li>
                                <li><a href="#">Second Product Name</a></li>
                                <li><a href="#">Third Product Name</a></li>
                                <li><a href="#">Fourth Product Name</a></li>
                                <li><a href="#">Sixth Product Name</a></li>
                            </ul>
                        </div>
                    </div>
                    
                    <div class="fillter-sec">
                    	<h2>Discount</h2>
                        <div class="fillter-content fix-wheight">
                        	<ul class="list-unstyled m-0">
                            	<li><a href="#">First Product Name</a></li>
                                <li><a href="#">Sixth Product Name</a></li>
                                <li><a href="#">First Product Name</a></li>
                            </ul>
                        </div>
                    </div>
                    
                    
                    <div class="fillter-sec">
                    	<h2>Clearance</h2>
                        <div class="fillter-content fix-wheight">
                        	<ul class="list-unstyled m-0">
                            	<li><a href="#">First Product Name</a></li>
                                <li><a href="#">Second Product Name</a></li>
                                <li><a href="#">Third Product Name</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="fltr-apply d-block d-lg-none py-3">
                    	<button class="btn btn-lg btn-danger btn-block">Apply</button>
                    </div>
                </div>
                <div class="right-content">
                	<div class="row">
						@if(count($products))
							@foreach($products as $product)
							<div class="col-xl-3 col-md-4 col-sm-6">
								<div class="pro-grid sale_on favourite_on">
									<figure>
										<div class="sale">Sale</div>
										<a href="#" class="pro_favourite"><i class="fas fa-heart"></i></a>
										@php $images = json_decode($product->main_image, true); @endphp
										<a href="#"><img src="{{ URL::to('/').'/img/products/thumbnail/'.$images[0] }}" alt="Item"/></a>
										<a href="{{ route('frontend.product.show', $product->id) }}" class="quick-view-btn btn btn-sm btn-danger">Quick View</a>
									</figure>
									<div class="gird-price"><sub>USD</sub> {{$product->price}}</div>
									<p class="grid-info"><a href="#">{{$product->name}} - 7'10" x 10'3"</a></p>
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
        $(this).closest('.panel.panel-default').find('.filter-option').each(function(){
            if($(this).hasClass('active'))
            {
                $(this).removeClass('active');
            }
        });
        $(this).addClass('active');
        var fieldValue = $(this).attr('fieldvalue');
        $(this).closest('.panel.panel-default').find('.filter-input').val(fieldValue);
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
</script>
@endsection