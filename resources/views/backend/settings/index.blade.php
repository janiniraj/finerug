@extends ('backend.layouts.app')

@section ('title', 'Settings' )

@section('page-header')
    <h1>
        Settings
        <small>Settings</small>
    </h1>
@endsection

@section('content')
    {{ Form::open(['route' => 'admin.settings.store', 'class' => 'form-horizontal', 'role' => 'form', 'method' => 'post', 'id' => 'create-role', 'files' => true]) }}

        <div class="box box-success">
            <div class="box-header with-border">
                <h3 class="box-title">Settings</h3>
            </div><!-- /.box-header -->

            <div class="box-body">
                <div class="form-group">
                    {{ Form::label('site_name', 'Site Name: ', ['class' => 'col-lg-2 control-label']) }}
                    
                    <?php
                        $match = null;
                        foreach($settings as $singleKey => $singleValue)
                        {
                            if($singleValue->key == 'site_name')
                            {
                                $match = $singleKey;
                            ?>
                                <input type="hidden" name="setting[0][id]" value="{{ $singleValue->id }}">
                            <?php
                            }  
                        }
                    ?>

                    {{ Form::hidden('setting[0][key]', 'site_name') }}
                    <div class="col-lg-10">

                        {{ Form::text('setting[0][value]', $match !== null ? $settings[$match]->value : null, ['class' => 'form-control box-size', 'placeholder' => 'Site Name']) }}
                    </div><!--col-lg-10-->
                </div><!--form control-->
                <div class="form-group image-upload-container">
                    {{ Form::label('logo', 'Logo:', ['class' => 'col-lg-2 control-label required']) }}
                    
                    <?php
                        $match = null;
                        foreach($settings as $singleKey => $singleValue)
                        {
                            if($singleValue->key == 'logo')
                            {
                                $match = $singleKey;
                            ?>
                                <input type="hidden" name="setting[1][id]" value="{{ $singleValue->id }}">
                            <?php
                            }  
                        }
                    ?>

                    {{ Form::hidden('setting[1][key]', 'logo') }}
                    <div class="col-lg-10">

                        <img class="image-display {{ isset($setting->image) ? '' : 'hidden' }}" src="{{ isset($setting->image) ? URL::to('/').'/img/sliders/'.$setting->image : "" }}" style="max-height: 100px;">
                        
                        {{ Form::file('setting[1][value]', $attributes = array($match !== null ? '' : 'required', 'class' => 'image', 'accept' => "image/x-png,image/gif,image/jpeg")) }}
                        
                        @if($match !== null)
                            <a download="{{ $settings[$match]->value}}" href="{{url('/').'/settings/'.$settings[$match]->value}}">{{ $settings[$match]->value }}</a>
                        @endif

                    </div><!--col-lg-10-->
                </div><!--form control-->

                <div class="form-group">
                    {{ Form::label('catalog', 'Catalog:', ['class' => 'col-lg-2 control-label required']) }}
                    
                    <?php
                        $match = null;
                        foreach($settings as $singleKey => $singleValue)
                        {
                            if($singleValue->key == 'catalog')
                            {
                                $match = $singleKey;
                            ?>
                                <input type="hidden" name="setting[2][id]" value="{{ $singleValue->id }}">
                            <?php
                            }  
                        }
                    ?>

                    {{ Form::hidden('setting[2][key]', 'catalog') }}
                    <div class="col-lg-10">
                        {{ Form::file('setting[2][value]', $attributes = array($match !== null ? '' : 'required', 'accept' => "application/pdf")) }}
                        @if($match !== null)
                            <a target="_blank" href="{{url('/').'/settings/'.$settings[$match]->value}}">{{ $settings[$match]->value }}</a>
                        @endif
                    </div><!--col-lg-10-->
                </div><!--form control-->

                <div class="form-group">
                    {{ Form::label('vendor_form', 'Vendor Form:', ['class' => 'col-lg-2 control-label required']) }}
                    
                    <?php
                        $match = null;
                        foreach($settings as $singleKey => $singleValue)
                        {
                            if($singleValue->key == 'vendor_form')
                            {
                                $match = $singleKey;
                            ?>
                                <input type="hidden" name="setting[3][id]" value="{{ $singleValue->id }}">
                            <?php
                            }  
                        }
                    ?>

                    {{ Form::hidden('setting[3][key]', 'vendor_form') }}
                    <div class="col-lg-10">
                        {{ Form::file('setting[3][value]', $attributes = array($match !== null ? '' : 'required', 'accept' => "application/pdf")) }}

                        @if($match !== null)
                            <a target="_blank" href="{{url('/').'/settings/'.$settings[$match]->value}}">{{ $settings[$match]->value }}</a>
                        @endif
                    </div><!--col-lg-10-->
                </div><!--form control-->
                <div class="form-group">
                    {{ Form::label('contact_us_latitude', 'Contact Us Latitude:', ['class' => 'col-lg-2 control-label required']) }}
                    
                    <?php
                        $match = null;
                        foreach($settings as $singleKey => $singleValue)
                        {
                            if($singleValue->key == 'contact_us_latitude')
                            {
                                $match = $singleKey;
                            ?>
                                <input type="hidden" name="setting[4][id]" value="{{ $singleValue->id }}">
                            <?php
                            }  
                        }
                    ?>

                    {{ Form::hidden('setting[4][key]', 'contact_us_latitude') }}
                    <div class="col-lg-10">
                        <a href="https://www.latlong.net/" target="_blank">To find Latitude and Longitude click here</a>
                        {{ Form::text('setting[4][value]', $match !== null ? $settings[$match]->value : null, ['class' => 'form-control box-size', 'placeholder' => 'Contact Us Latitude']) }}
                    </div><!--col-lg-10-->
                </div><!--form control-->
                <div class="form-group">
                    {{ Form::label('contact_us_longitude', 'Contact Us Longitude:', ['class' => 'col-lg-2 control-label required']) }}
                    
                    <?php
                        $match = null;
                        foreach($settings as $singleKey => $singleValue)
                        {
                            if($singleValue->key == 'contact_us_longitude')
                            {
                                $match = $singleKey;
                            ?>
                                <input type="hidden" name="setting[5][id]" value="{{ $singleValue->id }}">
                            <?php
                            }  
                        }
                    ?>

                    {{ Form::hidden('setting[5][key]', 'contact_us_longitude') }}
                    <div class="col-lg-10">
                        {{ Form::text('setting[5][value]', $match !== null ? $settings[$match]->value : null, ['class' => 'form-control box-size', 'placeholder' => 'Contact Us Longitude']) }}
                    </div><!--col-lg-10-->
                </div><!--form control-->
                <div class="form-group">
                    {{ Form::label('contact_us_address', 'Contact Us Address:', ['class' => 'col-lg-2 control-label required']) }}
                    
                    <?php
                        $match = null;
                        foreach($settings as $singleKey => $singleValue)
                        {
                            if($singleValue->key == 'contact_us_address')
                            {
                                $match = $singleKey;
                            ?>
                                <input type="hidden" name="setting[6][id]" value="{{ $singleValue->id }}">
                            <?php
                            }  
                        }
                    ?>

                    {{ Form::hidden('setting[6][key]', 'contact_us_address') }}
                    <div class="col-lg-10">
                        {{ Form::text('setting[6][value]', $match !== null ? $settings[$match]->value : null, ['class' => 'form-control box-size', 'placeholder' => 'Contact Us Address']) }}
                    </div><!--col-lg-10-->
                </div><!--form control-->

                <div class="form-group">
                    {{ Form::label('rug_school_application_form', 'Rug School Application Form:', ['class' => 'col-lg-2 control-label required']) }}
                    
                    <?php
                        $match = null;
                        foreach($settings as $singleKey => $singleValue)
                        {
                            if($singleValue->key == 'rug_school_application_form')
                            {
                                $match = $singleKey;
                            ?>
                                <input type="hidden" name="setting[7][id]" value="{{ $singleValue->id }}">
                            <?php
                            }  
                        }
                    ?>

                    {{ Form::hidden('setting[7][key]', 'rug_school_application_form') }}
                    <div class="col-lg-10">
                        {{ Form::file('setting[7][value]', $attributes = array($match !== null ? '' : 'required', 'accept' => "application/pdf")) }}

                        @if($match !== null)
                            <a target="_blank" href="{{url('/').'/settings/'.$settings[$match]->value}}">{{ $settings[$match]->value }}</a>
                        @endif
                    </div><!--col-lg-10-->
                </div><!--form control-->
                <div class="form-group">
                    {{ Form::label('rug_school_one_day_workshop', 'Rug School One Day Workshop:', ['class' => 'col-lg-2 control-label required']) }}
                    
                    <?php
                        $match = null;
                        foreach($settings as $singleKey => $singleValue)
                        {
                            if($singleValue->key == 'rug_school_one_day_workshop')
                            {
                                $match = $singleKey;
                            ?>
                                <input type="hidden" name="setting[8][id]" value="{{ $singleValue->id }}">
                            <?php
                            }  
                        }
                    ?>

                    {{ Form::hidden('setting[8][key]', 'rug_school_one_day_workshop') }}
                    <div class="col-lg-10">
                        {{ Form::file('setting[8][value]', $attributes = array($match !== null ? '' : 'required', 'accept' => "application/pdf")) }}

                        @if($match !== null)
                            <a target="_blank" href="{{url('/').'/settings/'.$settings[$match]->value}}">{{ $settings[$match]->value }}</a>
                        @endif
                    </div><!--col-lg-10-->
                </div><!--form control-->
            </div>
        </div><!--box-->

        <div class="box box-success">
            <div class="box-body">
                <div class="pull-left">
                    {{ link_to_route('admin.product.index', trans('buttons.general.cancel'), [], ['class' => 'btn btn-danger btn-xs']) }}
                </div><!--pull-left-->

                <div class="pull-right">
                    {{ Form::submit(trans('buttons.general.crud.create'), ['class' => 'btn btn-success btn-xs']) }}
                </div><!--pull-right-->

                <div class="clearfix"></div>
            </div><!-- /.box-body -->
        </div><!--box-->

    {{ Form::close() }}
@endsection

@section('after-scripts')
<script>
    $(document).ready(function() {
        $(".image").on('change', function ()
        {
            var input = this;
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('.image-display')
                        .attr('src', e.target.result).removeClass('hidden');
                };

                reader.readAsDataURL(input.files[0]);
            }
        });
    });
</script>
@endsection