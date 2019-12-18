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
                                <a href="#" class="list-group-item">My Account</a>
                                <a href="#" class="list-group-item">My Orders</a>
                                <a href="#" class="list-group-item">My Addresses</a>
                                <a href="#" class="list-group-item">Track Last Order</a>
                                <a href="#" class="list-group-item">Edit Profile</a>
                                <a href="#" class="list-group-item">Logout</a>
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
                            All the hidden content
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
                            All the hidden content
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
                            All the hidden content
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div><!-- row -->
@endsection

@section('after-scripts')

@endsection