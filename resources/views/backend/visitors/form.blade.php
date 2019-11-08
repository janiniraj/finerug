    <div class="form-group">
        {{ Form::label('name', trans('validation.attributes.backend.visitors.title'), ['class' => 'col-lg-2 control-label required']) }}

        <div class="col-lg-10">
            {{ Form::text('name', null, ['class' => 'form-control box-size', 'placeholder' => trans('validation.attributes.backend.visitors.title'), 'required' => 'required']) }}
        </div><!--col-lg-10-->
    </div><!--form control-->

    <div class="form-group">
        {{ Form::label('email', trans('validation.attributes.backend.visitors.email'), ['class' => 'col-lg-2 control-label required']) }}

        <div class="col-lg-10">
            {{ Form::email('email', null, ['class' => 'form-control box-size', 'placeholder' => trans('validation.attributes.backend.visitors.email'), 'required' => 'required']) }}
        </div><!--col-lg-10-->
    </div><!--form control-->

    <div class="form-group">
        {{ Form::label('address', trans('validation.attributes.backend.visitors.address'), ['class' => 'col-lg-2 control-label required']) }}

        <div class="col-lg-10">
            {{ Form::text('address', null, ['class' => 'form-control box-size', 'placeholder' => trans('validation.attributes.backend.visitors.address'), 'required' => 'required']) }}
        </div><!--col-lg-10-->
    </div><!--form control-->

    <div class="form-group">
        {{ Form::label('street', trans('validation.attributes.backend.visitors.street'), ['class' => 'col-lg-2 control-label required']) }}

        <div class="col-lg-10">
            {{ Form::text('street', null, ['class' => 'form-control box-size', 'placeholder' => trans('validation.attributes.backend.visitors.street'), 'required' => 'required']) }}
        </div><!--col-lg-10-->
    </div><!--form control-->

    <div class="form-group">
        {{ Form::label('pobox', trans('validation.attributes.backend.visitors.pobox'), ['class' => 'col-lg-2 control-label required']) }}

        <div class="col-lg-10">
            {{ Form::text('pobox', null, ['class' => 'form-control box-size', 'placeholder' => trans('validation.attributes.backend.visitors.pobox'), 'required' => 'required']) }}
        </div><!--col-lg-10-->
    </div><!--form control-->

    <div class="form-group">
        {{ Form::label('city', trans('validation.attributes.backend.visitors.city'), ['class' => 'col-lg-2 control-label required']) }}

        <div class="col-lg-10">
            {{ Form::text('city', null, ['class' => 'form-control box-size', 'placeholder' => trans('validation.attributes.backend.visitors.city'), 'required' => 'required']) }}
        </div><!--col-lg-10-->
    </div><!--form control-->

    <div class="form-group">
        {{ Form::label('state', trans('validation.attributes.backend.visitors.state'), ['class' => 'col-lg-2 control-label required']) }}

        <div class="col-lg-10">
            {{ Form::text('state', null, ['class' => 'form-control box-size', 'placeholder' => trans('validation.attributes.backend.visitors.state'), 'required' => 'required']) }}
        </div><!--col-lg-10-->
    </div><!--form control-->

    <div class="form-group">
        {{ Form::label('country', trans('validation.attributes.backend.visitors.country'), ['class' => 'col-lg-2 control-label required']) }}

        <div class="col-lg-10">
            {{ Form::text('country', null, ['class' => 'form-control box-size', 'placeholder' => trans('validation.attributes.backend.visitors.country'), 'required' => 'required']) }}
        </div><!--col-lg-10-->
    </div><!--form control-->

    <div class="form-group">
        {{ Form::label('phone', trans('validation.attributes.backend.visitors.phone'), ['class' => 'col-lg-2 control-label required']) }}

        <div class="col-lg-10">
            {{ Form::text('phone', null, ['class' => 'form-control box-size', 'placeholder' => trans('validation.attributes.backend.visitors.phone'), 'required' => 'required']) }}
        </div><!--col-lg-10-->
    </div><!--form control-->

    <?php
        if(isset($visitor) && !empty($visitor->shop))
        {
            $shop = json_decode($visitor->shop, true);
        }
    ?>

    <div class="form-group">
        {{ Form::label('amazon_link', trans('validation.attributes.backend.visitors.amazon_link'), ['class' => 'col-lg-2 control-label required']) }}

        <div class="col-lg-10">
            {{ Form::text('amazon_link', isset($shop) && isset($shop['amazon_link']) ? $shop['amazon_link'] : null, ['class' => 'form-control box-size', 'placeholder' => trans('validation.attributes.backend.visitors.amazon_link')]) }}
        </div><!--col-lg-10-->
    </div><!--form control-->

    <div class="form-group">
        {{ Form::label('ebay_link', trans('validation.attributes.backend.visitors.ebay_link'), ['class' => 'col-lg-2 control-label required']) }}

        <div class="col-lg-10">
            {{ Form::text('ebay_link', isset($shop) && isset($shop['ebay_link']) ? $shop['ebay_link'] : null, ['class' => 'form-control box-size', 'placeholder' => trans('validation.attributes.backend.visitors.ebay_link')]) }}
        </div><!--col-lg-10-->
    </div><!--form control-->

    <div class="form-group">
        {{ Form::label('custom_link1', 'Custom Link 1', ['class' => 'col-lg-2 control-label required']) }}

        <div class="col-lg-10">
            {{ Form::text('custom_link1', isset($shop) && isset($shop['custom_link1']) ? $shop['custom_link1'] : null, ['class' => 'form-control box-size', 'placeholder' => 'Custom Link 1']) }}
        </div><!--col-lg-10-->
    </div><!--form control-->

    <div class="form-group">
        {{ Form::label('custom_logo1', 'Custom Logo 1', ['class' => 'col-lg-2 control-label required']) }}

        <div class="col-lg-10">
            @if(isset($shop) && isset($shop['custom_logo1']) && $shop['custom_logo1'])
                <img class="logo-visitor image-display1" src="<?php echo url('/').'/visitors/'.$shop['custom_logo1']; ?>" />
            @endif            
            {{ Form::file('custom_logo1', $attributes = array('class' => 'image1', 'accept' => "image/x-png,image/gif,image/jpeg")) }}
        </div><!--col-lg-10-->
    </div><!--form control-->

    <div class="form-group">
        {{ Form::label('custom_link2', 'Custom Link 2', ['class' => 'col-lg-2 control-label required']) }}

        <div class="col-lg-10">
            {{ Form::text('custom_link2', isset($shop) && isset($shop['custom_link2']) ? $shop['custom_link2'] : null, ['class' => 'form-control box-size', 'placeholder' => 'Custom Link 2']) }}
        </div><!--col-lg-10-->
    </div><!--form control-->

    <div class="form-group">
        {{ Form::label('custom_logo2', 'Custom Logo 2', ['class' => 'col-lg-2 control-label required']) }}

        <div class="col-lg-10">
            @if(isset($shop) && isset($shop['custom_logo2']) && $shop['custom_logo2'])
                <img class="logo-visitor image-display2" src="<?php echo url('/').'/visitors/'.$shop['custom_logo2']; ?>" />
            @endif
            {{ Form::file('custom_logo2', $attributes = array('class' => 'image2', 'accept' => "image/x-png,image/gif,image/jpeg")) }}
        </div><!--col-lg-10-->
    </div><!--form control-->

    <style type="text/css">
        img.logo-visitor {
            max-height: 50px;
        }
    </style>
