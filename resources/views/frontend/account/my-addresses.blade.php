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
                            data-target="#collapseTwo">
                            My Addresses
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

            </div>

        </div>
    </div><!-- row -->
@endsection

@section('after-scripts')

@endsection