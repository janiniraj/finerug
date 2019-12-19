@extends('frontend.layouts.master')

@section('title', app_name() . ' | My Account')

@section('content')
    <div class="row main-page-container" style="">
        <div class="col-md-12">
            <div class="col-sm-4">
                <div class="card">
                    <article class="card-group-item">
                        <header class="card-header"><h6 class="title">My Details </h6></header>
                        <div class="filter-content">
                            <div class="list-group list-group-flush">
                                <a href="{{ route('frontend.account.my-account') }}" class="list-group-item">My Account</a>
                                <a href="{{ route('frontend.product.favourites') }}" class="list-group-item">My Wishlist</a>
                                <a href="#" class="list-group-item">My Orders</a>
                                <a href="#" class="list-group-item">My Addresses</a>
                                <a href="#" class="list-group-item">Track Last Order</a>
                                <a href="#" class="list-group-item">Edit Profile</a>
                                <a href="{{ route('frontend.auth.logout') }}" class="list-group-item">Logout</a>
                            </div>  <!-- list-group .// -->
                        </div>
                    </article>
                </div>
            </div> <!-- col.// -->

            <div class="col-md-8">

                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4 class="panel-title"
                            data-toggle="collapse"
                            data-target="#collapseTwo">
                            Recent Address
                        </h4>
                    </div>
                    <div id="collapseTwo" class="panel-collapse collapse in show">
                        <div class="panel-body">
                            @if(!$addresses->isEmpty())
                                @foreach($addresses as $single)
                                    <div class="col-md-12">
                                        <b>Type: </b> {{ ucfirst($single->type) }}
                                    </div>

                                    <div class="col-md-12">
                                        <div class="col-md-6">
                                            <dl class="dl-horizontal">
                                                <dt>First Name</dt>
                                                <dd>{{ $single->first_name }}</dd>
                                            </dl>
                                        </div>
                                        <div class="col-md-6">
                                            <dl class="dl-horizontal">
                                                <dt>Last Name</dt>
                                                <dd>{{ $single->last_name }}</dd>
                                            </dl>
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="col-md-6">
                                            <dl class="dl-horizontal">
                                                <dt>Email</dt>
                                                <dd>{{ $single->email }}</dd>
                                            </dl>
                                        </div>
                                        <div class="col-md-6">
                                            <dl class="dl-horizontal">
                                                <dt>Phone Number</dt>
                                                <dd>{{ $single->phone }}</dd>
                                            </dl>
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="col-md-6">
                                            <dl class="dl-horizontal">
                                                <dt>Address</dt>
                                                <dd>{{ $single->address }}</dd>
                                            </dl>
                                        </div>
                                        <div class="col-md-6">
                                            <dl class="dl-horizontal">
                                                <dt>Street</dt>
                                                <dd>{{ $single->street }}</dd>
                                            </dl>
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="col-md-6">
                                            <dl class="dl-horizontal">
                                                <dt>City</dt>
                                                <dd>{{ $single->city. ', '. $single->postal_code }}</dd>
                                            </dl>
                                        </div>
                                        <div class="col-md-6">
                                            <dl class="dl-horizontal">
                                                <dt>State</dt>
                                                <dd>{{ $single->state }}</dd>
                                            </dl>
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <hr/>
                                    </div>

                                @endforeach
                            @else
                                No Addresses found.
                            @endif
                        </div>
                    </div>
                </div>

                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4 class="panel-title"
                            data-toggle="collapse"
                            data-target="#collapseOne">
                            Recent Orders
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

                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4 class="panel-title"
                            data-toggle="collapse"
                            data-target="#collapseTwo">
                            Last Order
                        </h4>
                    </div>
                    <div id="collapseTwo" class="panel-collapse collapse in show">
                        <div class="panel-body">
                            @if($lastOrder)
                                <dl class="dl-horizontal">
                                    <dt>Order Id</dt>
                                    <dd>{{ $lastOrder->id }}</dd>
                                    <dt>Order Status</dt>
                                    <dd>{{ $lastOrder->status }}</dd>
                                    <dt>Order Created</dt>
                                    <dd>{{ date('d/m/Y h:i A', strtotime($lastOrder->created_at)) }}</dd>
                                    <dt>Order Subtotal</dt>
                                    <dd>{{ '$'.$lastOrder->subtotal }}</dd>
                                    <dt>Tax Amount</dt>
                                    <dd>{{ '$'.$lastOrder->tax }}</dd>
                                    <dt>Shipping Rate</dt>
                                    <dd>{{ '$'.$lastOrder->ship_rate }}</dd>
                                    <dt>Total</dt>
                                    <dd>{{ '$'.$lastOrder->total }}</dd>
                                </dl>
                                <div class="text-right col-md-12">
                                    <a href="javascript:void(0);" class="btn btn-primary"> See Order Details</a>
                                    <hr />
                                </div>
                            @else
                                No Last Orders Found
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