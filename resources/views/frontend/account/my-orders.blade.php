@extends('frontend.layouts.master')

@section('title', app_name() . ' | My Orders')

@section('content')
    <div class="row main-page-container" style="">
        <div class="col-md-12">
            @include("frontend.account.sidebar")

            <div class="col-md-8">

                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4 class="panel-title"
                            data-toggle="collapse"
                            data-target="#collapseOne">
                            My Orders
                        </h4>
                    </div>
                    <div id="collapseOne" class="panel-collapse collapse in show">
                        <div class="panel-body">
                            @if(!$orders->isEmpty())
                                @foreach($orders as $single)
                                    <dl class="dl-horizontal">
                                        <dt>Order Id</dt>
                                        <dd>{{ $single->id }}</dd>
                                        <dt>Order Status</dt>
                                        <dd>{{ $single->status }}</dd>
                                        <dt>Order Created</dt>
                                        <dd>{{ date('d/m/Y h:i A', strtotime($single->created_at)) }}</dd>
                                        <dt>Order Subtotal</dt>
                                        <dd>{{ '$'.$single->subtotal }}</dd>
                                        <dt>Tax Amount</dt>
                                        <dd>{{ '$'.$single->tax }}</dd>
                                        <dt>Shipping Rate</dt>
                                        <dd>{{ '$'.$single->ship_rate }}</dd>
                                        <dt>Total</dt>
                                        <dd>{{ '$'.$single->total }}</dd>
                                    </dl>
                                    <div class="text-right col-md-12">
                                        <a href="javascript:void(0);" class="btn btn-primary"> See Order Details</a>
                                        <hr />
                                    </div>

                                @endforeach
                            @else
                                No Orders Found
                            @endif
                        </div>
                    </div>
                </div>

            </div>

        </div>
    </div><!-- row -->
@endsection

@section('after-scripts')

@endsection