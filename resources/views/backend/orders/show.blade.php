@extends ('backend.layouts.app')

@section ('title', trans('labels.backend.orders.management'))

@section('after-orders')
    {{ Html::style("css/backend/plugin/datatables/dataTables.bootstrap.min.css") }}
@endsection

@section('page-header')
    <h1>{{ trans('labels.backend.orders.view') }}</h1>
@endsection

@section('content')
    @php
        $shippingData = $orderData->orderShipping;;
        $billingData = $orderData->orderBilling;
    @endphp
    <div class="box box-success">
        <div class="box-header with-border">
            <h3 class="box-title">{{ trans('labels.backend.orders.view') }}</h3>

        </div><!-- /.box-header -->

        <div class="box-body">
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group row">
                        <label for="staticEmail" class="col-sm-2 col-form-label">Order Number</label>
                        <div class="col-sm-10">
                            <p class="">{{ $orderData->id }}</p>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="staticEmail" class="col-sm-2 col-form-label">Order Status</label>
                        <div class="col-sm-10">
                            <p class="">{{ $orderData->status }}</p>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="staticEmail" class="col-sm-2 col-form-label">Order Created</label>
                        <div class="col-sm-10">
                            <p class="">{{ date('Y/m/d H:i:s', strtotime($orderData->created_at)) }}</p>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="staticEmail" class="col-sm-2 col-form-label">Subtotal</label>
                        <div class="col-sm-10">
                            <p class="">{{ $orderData->subtotal }}</p>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="staticEmail" class="col-sm-2 col-form-label">Shipping Rates</label>
                        <div class="col-sm-10">
                            <p class="">{{ $orderData->ship_rate }}</p>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="staticEmail" class="col-sm-2 col-form-label">Tax</label>
                        <div class="col-sm-10">
                            <p class="">{{ $orderData->tax }}</p>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="staticEmail" class="col-sm-2 col-form-label">Total</label>
                        <div class="col-sm-10">
                            <p class="">{{ $orderData->total }}</p>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="staticEmail" class="col-sm-2 col-form-label">Products</label>
                        <div class="col-sm-10">
                            <table class="table table-responsive table-bordered">
                                <thead>
                                    <th>Product Name</th>
                                    <th>Price</th>
                                    <th>Quantity</th>
                                    <th>Attributes</th>
                                </thead>
                                <tbody>
                                    @foreach($orderData->orderProducts as $singleKey => $singleVal)
                                        @php
                                            $productData = $singleVal->getProduct;
                                            $attributes = json_decode($singleVal->attributes, true);
                                        @endphp
                                    <tr >
                                        <td>
                                            <a target="_blank" href="{{ route('frontend.product.show', $productData->id) }}">{{ $productData->name }}</a>
                                        </td>
                                        <td>${{ $singleVal->price }}</td>
                                        <td>{{ $singleVal->quantity }}</td>
                                        <td>
                                            Size: {{ $attributes['size'] }}
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="staticEmail" class="col-sm-2 col-form-label">Shipping Address</label>
                        <div class="col-sm-10">

                            <div class="form-group row">
                                <label for="staticEmail" class="col-sm-2 col-form-label">Name</label>
                                <div class="col-sm-10">
                                    <p>{{ $shippingData->first_name.' '. $shippingData->last_name }}</p>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="staticEmail" class="col-sm-2 col-form-label">Email</label>
                                <div class="col-sm-10">
                                    <p>{{ $shippingData->email }}</p>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="staticEmail" class="col-sm-2 col-form-label">Phone Number</label>
                                <div class="col-sm-10">
                                    <p>{{ $shippingData->phone }}</p>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="staticEmail" class="col-sm-2 col-form-label">Address</label>
                                <div class="col-sm-10">
                                    <p>{{ $shippingData->address }}</p>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="staticEmail" class="col-sm-2 col-form-label">Street</label>
                                <div class="col-sm-10">
                                    <p>{{ $shippingData->street }}</p>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="staticEmail" class="col-sm-2 col-form-label">City</label>
                                <div class="col-sm-10">
                                    <p>{{ $shippingData->city }}</p>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="staticEmail" class="col-sm-2 col-form-label">State</label>
                                <div class="col-sm-10">
                                    <p>{{ $shippingData->state }}</p>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="staticEmail" class="col-sm-2 col-form-label">Country</label>
                                <div class="col-sm-10">
                                    <p>{{ $shippingData->country }}</p>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="staticEmail" class="col-sm-2 col-form-label">Post Code</label>
                                <div class="col-sm-10">
                                    <p>{{ $shippingData->postal_code }}</p>
                                </div>
                            </div>

                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="staticEmail" class="col-sm-2 col-form-label">Billing Address</label>
                        <div class="col-sm-10">

                            <div class="form-group row">
                                <label for="staticEmail" class="col-sm-2 col-form-label">Name</label>
                                <div class="col-sm-10">
                                    <p>{{ $billingData->first_name.' '. $billingData->last_name }}</p>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="staticEmail" class="col-sm-2 col-form-label">Email</label>
                                <div class="col-sm-10">
                                    <p>{{ $billingData->email }}</p>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="staticEmail" class="col-sm-2 col-form-label">Phone Number</label>
                                <div class="col-sm-10">
                                    <p>{{ $billingData->phone }}</p>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="staticEmail" class="col-sm-2 col-form-label">Address</label>
                                <div class="col-sm-10">
                                    <p>{{ $billingData->address }}</p>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="staticEmail" class="col-sm-2 col-form-label">Street</label>
                                <div class="col-sm-10">
                                    <p>{{ $billingData->street }}</p>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="staticEmail" class="col-sm-2 col-form-label">City</label>
                                <div class="col-sm-10">
                                    <p>{{ $billingData->city }}</p>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="staticEmail" class="col-sm-2 col-form-label">State</label>
                                <div class="col-sm-10">
                                    <p>{{ $billingData->state }}</p>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="staticEmail" class="col-sm-2 col-form-label">Country</label>
                                <div class="col-sm-10">
                                    <p>{{ $billingData->country }}</p>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="staticEmail" class="col-sm-2 col-form-label">Post Code</label>
                                <div class="col-sm-10">
                                    <p>{{ $billingData->postal_code }}</p>
                                </div>
                            </div>

                        </div>
                    </div>


                </div>

            </div>
        </div><!-- /.box-body -->
    </div><!--box-->

    <!--<div class="box box-info">
        <div class="box-header with-border">
            <h3 class="box-title">{{ trans('history.backend.recent_history') }}</h3>
            <div class="box-tools pull-right">
                <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
            </div><!-- /.box tools -->
    </div><!-- /.box-header -->
    <div class="box-body">
        {{-- {!! history()->renderType('Category') !!} --}}
    </div><!-- /.box-body -->
    </div><!--box box-success-->
@endsection
@section('after-scripts')

@endsection
