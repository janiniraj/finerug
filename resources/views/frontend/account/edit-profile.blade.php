@extends('frontend.layouts.master')

@section('title', app_name() . ' | Edit Profile')

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
                            Edit Profile
                        </h4>
                    </div>
                    <div id="collapseTwo" class="panel-collapse collapse in show">
                        <div class="panel-body">
                            {{ Form::open(['method' => 'POST','id'=> 'pricerange', 'class' => 'form-horizontal','url' => route('frontend.account.save-edit-profile')]) }}
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            {{ Form::label('first_name', 'First Name', ['class' => 'col-lg-2 control-label required']) }}

                                            <div class="col-lg-10">
                                                {{ Form::text('first_name', $userData->first_name, ['class' => 'form-control first_name', 'placeholder' => 'First Name', 'required' => 'required']) }}
                                            </div><!--col-lg-10-->
                                        </div><!--form control-->
                                        <div class="form-group">
                                            {{ Form::label('last_name', 'Last Name', ['class' => 'col-lg-2 control-label required']) }}

                                            <div class="col-lg-10">
                                                {{ Form::text('last_name', $userData->last_name, ['class' => 'form-control last_name', 'placeholder' => 'Last Name', 'required' => 'required']) }}
                                            </div><!--col-lg-10-->
                                        </div><!--form control-->
                                        <div class="form-group">
                                            {{ Form::label('email', 'Email', ['class' => 'col-lg-2 control-label required']) }}

                                            <div class="col-lg-10">
                                                {{ Form::text('email', $userData->email, ['readonly' => 'readonly', 'class' => 'form-control last_name', 'placeholder' => 'email', 'required' => 'required']) }}
                                            </div><!--col-lg-10-->
                                        </div><!--form control-->
                                        <div class="form-group">
                                            <div class="col-lg-10 col-md-offset-2">
                                                <input type="submit" class="btn btn-primary btn-lg" value="Save">
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            {{ Form::close() }}
                        </div>
                    </div>
                </div>

            </div>

        </div>
    </div><!-- row -->
@endsection

@section('after-scripts')

@endsection