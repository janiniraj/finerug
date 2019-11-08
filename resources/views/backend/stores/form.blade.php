    <div class="form-group">
        {{ Form::label('name', trans('validation.attributes.backend.stores.title'), ['class' => 'col-lg-2 control-label required']) }}

        <div class="col-lg-10">
            {{ Form::text('name', null, ['class' => 'form-control box-size', 'placeholder' => trans('validation.attributes.backend.stores.title'), 'required' => 'required']) }}
        </div><!--col-lg-10-->
    </div><!--form control-->

    <div class="form-group">
        {{ Form::label('email', trans('validation.attributes.backend.stores.email'), ['class' => 'col-lg-2 control-label required']) }}

        <div class="col-lg-10">
            {{ Form::email('email', null, ['class' => 'form-control box-size', 'placeholder' => trans('validation.attributes.backend.stores.email'), 'required' => 'required']) }}
        </div><!--col-lg-10-->
    </div><!--form control-->

    <div class="form-group">
        {{ Form::label('address', trans('validation.attributes.backend.stores.address'), ['class' => 'col-lg-2 control-label required']) }}

        <div class="col-lg-10">
            {{ Form::text('address', null, ['class' => 'form-control box-size', 'placeholder' => trans('validation.attributes.backend.stores.address'), 'required' => 'required']) }}
        </div><!--col-lg-10-->
    </div><!--form control-->

    <div class="form-group">
        {{ Form::label('street', trans('validation.attributes.backend.stores.street'), ['class' => 'col-lg-2 control-label required']) }}

        <div class="col-lg-10">
            {{ Form::text('street', null, ['class' => 'form-control box-size', 'placeholder' => trans('validation.attributes.backend.stores.street'), 'required' => 'required']) }}
        </div><!--col-lg-10-->
    </div><!--form control-->

    <div class="form-group">
        {{ Form::label('pobox', trans('validation.attributes.backend.stores.pobox'), ['class' => 'col-lg-2 control-label required']) }}

        <div class="col-lg-10">
            {{ Form::text('pobox', null, ['class' => 'form-control box-size', 'placeholder' => trans('validation.attributes.backend.stores.pobox'), 'required' => 'required']) }}
        </div><!--col-lg-10-->
    </div><!--form control-->

    <div class="form-group">
        {{ Form::label('city', trans('validation.attributes.backend.stores.city'), ['class' => 'col-lg-2 control-label required']) }}

        <div class="col-lg-10">
            {{ Form::text('city', null, ['class' => 'form-control box-size', 'placeholder' => trans('validation.attributes.backend.stores.city'), 'required' => 'required']) }}
        </div><!--col-lg-10-->
    </div><!--form control-->

    <div class="form-group">
        {{ Form::label('state', trans('validation.attributes.backend.stores.state'), ['class' => 'col-lg-2 control-label required']) }}

        <div class="col-lg-10">
            {{ Form::text('state', null, ['class' => 'form-control box-size', 'placeholder' => trans('validation.attributes.backend.stores.state'), 'required' => 'required']) }}
        </div><!--col-lg-10-->
    </div><!--form control-->

    <div class="form-group">
        {{ Form::label('country', trans('validation.attributes.backend.stores.country'), ['class' => 'col-lg-2 control-label required']) }}

        <div class="col-lg-10">
            {{ Form::text('country', null, ['class' => 'form-control box-size', 'placeholder' => trans('validation.attributes.backend.stores.country'), 'required' => 'required']) }}
        </div><!--col-lg-10-->
    </div><!--form control-->

    <div class="form-group">
        {{ Form::label('phone', trans('validation.attributes.backend.stores.phone'), ['class' => 'col-lg-2 control-label required']) }}

        <div class="col-lg-10">
            {{ Form::text('phone', null, ['class' => 'form-control box-size', 'placeholder' => trans('validation.attributes.backend.stores.phone'), 'required' => 'required']) }}
        </div><!--col-lg-10-->
    </div><!--form control-->

    <?php
        if(isset($store) && !empty($store->shop))
        {
            $shop = json_decode($store->shop, true);
        }
    ?>

    <div class="form-group">
        {{ Form::label('amazon_link', trans('validation.attributes.backend.stores.amazon_link'), ['class' => 'col-lg-2 control-label required']) }}

        <div class="col-lg-10">
            {{ Form::text('amazon_link', isset($shop) && isset($shop['amazon_link']) ? $shop['amazon_link'] : null, ['class' => 'form-control box-size', 'placeholder' => trans('validation.attributes.backend.stores.amazon_link')]) }}
        </div><!--col-lg-10-->
    </div><!--form control-->

    <div class="form-group">
        {{ Form::label('ebay_link', trans('validation.attributes.backend.stores.ebay_link'), ['class' => 'col-lg-2 control-label required']) }}

        <div class="col-lg-10">
            {{ Form::text('ebay_link', isset($shop) && isset($shop['ebay_link']) ? $shop['ebay_link'] : null, ['class' => 'form-control box-size', 'placeholder' => trans('validation.attributes.backend.stores.ebay_link')]) }}
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
                <img class="logo-store image-display1" src="<?php echo url('/').'/stores/'.$shop['custom_logo1']; ?>" />
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
                <img class="logo-store image-display2" src="<?php echo url('/').'/stores/'.$shop['custom_logo2']; ?>" />
            @endif            
            {{ Form::file('custom_logo2', $attributes = array('class' => 'image2', 'accept' => "image/x-png,image/gif,image/jpeg")) }}
        </div><!--col-lg-10-->
    </div><!--form control-->

    <div class="form-group">
        {{ Form::label('custom_link3', 'Custom Link 3', ['class' => 'col-lg-2 control-label required']) }}

        <div class="col-lg-10">
            {{ Form::text('custom_link3', isset($shop) && isset($shop['custom_link3']) ? $shop['custom_link3'] : null, ['class' => 'form-control box-size', 'placeholder' => 'Custom Link 3']) }}
        </div><!--col-lg-10-->
    </div><!--form control-->

    <div class="form-group">
        {{ Form::label('custom_logo3', 'Custom Logo 3', ['class' => 'col-lg-2 control-label required']) }}

        <div class="col-lg-10">
            @if(isset($shop) && isset($shop['custom_logo3']) && $shop['custom_logo3'])
                <img class="logo-store image-display3" src="<?php echo url('/').'/stores/'.$shop['custom_logo3']; ?>" />
            @endif            
            {{ Form::file('custom_logo3', $attributes = array('class' => 'image3', 'accept' => "image/x-png,image/gif,image/jpeg")) }}
        </div><!--col-lg-10-->
    </div><!--form control-->

    <div class="form-group">
        {{ Form::label('custom_link4', 'Custom Link 4', ['class' => 'col-lg-2 control-label required']) }}

        <div class="col-lg-10">
            {{ Form::text('custom_link4', isset($shop) && isset($shop['custom_link4']) ? $shop['custom_link4'] : null, ['class' => 'form-control box-size', 'placeholder' => 'Custom Link 4']) }}
        </div><!--col-lg-10-->
    </div><!--form control-->

    <div class="form-group">
        {{ Form::label('custom_logo4', 'Custom Logo 4', ['class' => 'col-lg-2 control-label required']) }}

        <div class="col-lg-10">
            @if(isset($shop) && isset($shop['custom_logo4']) && $shop['custom_logo4'])
                <img class="logo-store image-display4" src="<?php echo url('/').'/stores/'.$shop['custom_logo4']; ?>" />
            @endif            
            {{ Form::file('custom_logo4', $attributes = array('class' => 'image4', 'accept' => "image/x-png,image/gif,image/jpeg")) }}
        </div><!--col-lg-10-->
    </div><!--form control-->

    <div class="form-group">
        {{ Form::label('custom_link5', 'Custom Link 5', ['class' => 'col-lg-2 control-label required']) }}

        <div class="col-lg-10">
            {{ Form::text('custom_link5', isset($shop) && isset($shop['custom_link5']) ? $shop['custom_link5'] : null, ['class' => 'form-control box-size', 'placeholder' => 'Custom Link 5']) }}
        </div><!--col-lg-10-->
    </div><!--form control-->

    <div class="form-group">
        {{ Form::label('custom_logo5', 'Custom Logo 5', ['class' => 'col-lg-2 control-label required']) }}

        <div class="col-lg-10">
            @if(isset($shop) && isset($shop['custom_logo5']) && $shop['custom_logo5'])
                <img class="logo-store image-display3" src="<?php echo url('/').'/stores/'.$shop['custom_logo5']; ?>" />
            @endif            
            {{ Form::file('custom_logo5', $attributes = array('class' => 'image5', 'accept' => "image/x-png,image/gif,image/jpeg")) }}
        </div><!--col-lg-10-->
    </div><!--form control-->

    <style type="text/css">
        img.logo-store {
            max-height: 50px;
        }
    </style>
