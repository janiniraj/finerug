@extends('frontend.layouts.master')

@section('title', app_name() . ' | Contact Us')

@section('content')
    <div class="row" style=" margin-top: 20px;">

        <div class="col-md-8 col-md-offset-2">

            <div class="panel panel-default">
                <div class="panel-heading">{{ trans('labels.frontend.contact.box_title') }}</div>

                <div class="panel-body">

                    {{ Form::open(['route' => 'frontend.contact.send', 'class' => 'form-horizontal', 'id' => 'contactForm']) }}

                    <div class="form-group">
                        {{ Form::label('name', trans('validation.attributes.frontend.name'), ['class' => 'col-md-4 control-label']) }}
                        <div class="col-md-6">
                            {{ Form::text('name', null, ['class' => 'form-control', 'required' => 'required', 'autofocus' => 'autofocus', 'placeholder' => trans('validation.attributes.frontend.name')]) }}
                        </div><!--col-md-6-->
                    </div><!--form-group-->

                    <div class="form-group">
                        {{ Form::label('email', trans('validation.attributes.frontend.email'), ['class' => 'col-md-4 control-label']) }}
                        <div class="col-md-6">
                            {{ Form::email('email', null, ['class' => 'form-control', 'required' => 'required', 'placeholder' => trans('validation.attributes.frontend.email')]) }}
                        </div><!--col-md-6-->
                    </div><!--form-group-->

                    <div class="form-group">
                        {{ Form::label('phone', trans('validation.attributes.frontend.phone'), ['class' => 'col-md-4 control-label']) }}
                        <div class="col-md-6">
                            {{ Form::text('phone', null, ['class' => 'form-control', 'placeholder' => trans('validation.attributes.frontend.phone')]) }}
                        </div><!--col-md-6-->
                    </div><!--form-group-->

                    <div class="form-group">
                        {{ Form::label('message', trans('validation.attributes.frontend.message'), ['class' => 'col-md-4 control-label']) }}
                        <div class="col-md-6">
                            {{ Form::textarea('message', null, ['class' => 'form-control', 'required' => 'required', 'placeholder' => trans('validation.attributes.frontend.message')]) }}
                        </div><!--col-md-6-->
                    </div><!--form-group-->

                    <div class="form-group">
                        <div class="col-md-4"></div>
                        <div class="col-md-6">
                            @if(env('GOOGLE_RECAPTCHA_KEY'))
                                <div class="g-recaptcha"
                                     data-sitekey="{{env('GOOGLE_RECAPTCHA_KEY')}}">
                                </div>
                            @endif
                        </div>
                    </div><!--form-group-->

                    <div class="form-group">
                        <div class="col-md-6 col-md-offset-4">
                            {{ Form::submit(trans('labels.frontend.contact.button'), ['class' => 'btn btn-primary pull-right']) }}
                        </div><!--col-md-6-->
                    </div><!--form-group-->

                    {{ Form::close() }}
                </div><!-- panel body -->

            </div><!-- panel -->

        </div><!-- col-md-8 -->

    </div><!-- row -->
@endsection

@section('after-scripts')
<script src='https://www.google.com/recaptcha/api.js'></script>
<script>
    $("#contactForm").submit(function () {
        if (grecaptcha.getResponse() == "") {
            alert("Please verify captcha details.");
            return false;
        }
        return true;
    });
</script>
@endsection