@extends('frontend.layouts.master')

@section('content')
    <style>
        .product-close {
            font-size: 40px;
            position: absolute;
            right: 20px;
            opacity: 5;
        }
    </style>
    <div class="container accessories" id="results-page">
        <div class="section">

            <div class="results-limit">
                <select name="resultsLimiter" id="resultsLimiter">
                    <option value="">{{ 'Showing '. (($products->currentPage()-1)*config('constant.perPage')+1).'-'.(($products->currentPage()-1)*config('constant.perPage')+$products->count()).' of '.$products->total() }} results</option>
                </select>
            </div>

            <div class="row">

                <div class="col-sm-12 resutls">
                    <div class="row items">
                        @foreach($products as $product)
                            <div class="col-xs-4 item">
                                <input type="hidden" value="{{ $product->product_id }}" class="product-id">
                                <a href="{{ route('frontend.product.show', $product->product_id) }}">
                                    <button type="button" class="close product-close" >
                                        <span aria-hidden="true">×</span>
                                    </button>
                                    @php $images = json_decode($product->main_image, true); @endphp
                                    <img src="{{ URL::to('/').'/img/products/thumbnail/'.$images[0] }}" alt="Item" class="img-responsive">
                                    <div class="text-center product-title">{{ $product->name }}</div>
                                </a>
                            </div>
                        @endforeach
                    </div>
                    {{ $products->links() }}

                </div>
            </div>

        </div>
    </div><!-- container -->
@endsection

@section('after-scripts')
    <script>
        $(".filter-option").on('click', function (e) {
            var fieldValue = $(this).attr('fieldvalue');
            $(this).closest('.panel.panel-default').find('.filter-input').val(fieldValue);
        });

        $(".product-close").on('click', function(e){
            e.preventDefault();
            var parent = $(this).closest('.item');
            var productId = parent.find('.product-id').val();

            var data = {
                product_id: productId,
                favourite: 0
            };
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
                            parent.remove();
                        });
                    }
                }
            });

        });

    </script>
@endsection