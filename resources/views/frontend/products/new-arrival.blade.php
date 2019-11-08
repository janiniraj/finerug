@extends('frontend.layouts.master')

@section('content')
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
                                <a href="{{ route('frontend.product.show', $product->id) }}">
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
    </script>
@endsection