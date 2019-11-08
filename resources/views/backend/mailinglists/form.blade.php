    <div class="form-group">
        {{ Form::label('name', trans('validation.attributes.backend.mailinglists.title'), ['class' => 'col-lg-2 control-label required']) }}

        <div class="col-lg-10">
            {{ Form::text('name', null, ['class' => 'form-control box-size', 'placeholder' => trans('validation.attributes.backend.mailinglists.title'), 'required' => 'required']) }}
        </div><!--col-lg-10-->
    </div><!--form control-->

    <div class="form-group">
        {{ Form::label('email', trans('validation.attributes.backend.mailinglists.email'), ['class' => 'col-lg-2 control-label required']) }}

        <div class="col-lg-10">
            {{ Form::email('email', null, ['class' => 'form-control box-size', 'placeholder' => trans('validation.attributes.backend.mailinglists.email'), 'required' => 'required']) }}
        </div><!--col-lg-10-->
    </div><!--form control-->

    <div class="form-group">
        {{ Form::label('address', trans('validation.attributes.backend.mailinglists.address'), ['class' => 'col-lg-2 control-label required']) }}

        <div class="col-lg-10">
            {{ Form::text('address', null, ['class' => 'form-control box-size', 'placeholder' => trans('validation.attributes.backend.mailinglists.address'), 'required' => 'required']) }}
        </div><!--col-lg-10-->
    </div><!--form control-->

    <div class="form-group">
        {{ Form::label('street', trans('validation.attributes.backend.mailinglists.street'), ['class' => 'col-lg-2 control-label required']) }}

        <div class="col-lg-10">
            {{ Form::text('street', null, ['class' => 'form-control box-size', 'placeholder' => trans('validation.attributes.backend.mailinglists.street'), 'required' => 'required']) }}
        </div><!--col-lg-10-->
    </div><!--form control-->

    <div class="form-group">
        {{ Form::label('pobox', trans('validation.attributes.backend.mailinglists.pobox'), ['class' => 'col-lg-2 control-label required']) }}

        <div class="col-lg-10">
            {{ Form::text('pobox', null, ['class' => 'form-control box-size', 'placeholder' => trans('validation.attributes.backend.mailinglists.pobox'), 'required' => 'required']) }}
        </div><!--col-lg-10-->
    </div><!--form control-->

    <div class="form-group">
        {{ Form::label('city', trans('validation.attributes.backend.mailinglists.city'), ['class' => 'col-lg-2 control-label required']) }}

        <div class="col-lg-10">
            {{ Form::text('city', null, ['class' => 'form-control box-size', 'placeholder' => trans('validation.attributes.backend.mailinglists.city'), 'required' => 'required']) }}
        </div><!--col-lg-10-->
    </div><!--form control-->

    <div class="form-group">
        {{ Form::label('state', trans('validation.attributes.backend.mailinglists.state'), ['class' => 'col-lg-2 control-label required']) }}

        <div class="col-lg-10">
            {{ Form::text('state', null, ['class' => 'form-control box-size', 'placeholder' => trans('validation.attributes.backend.mailinglists.state'), 'required' => 'required']) }}
        </div><!--col-lg-10-->
    </div><!--form control-->

    <div class="form-group">
        {{ Form::label('country', trans('validation.attributes.backend.mailinglists.country'), ['class' => 'col-lg-2 control-label required']) }}

        <div class="col-lg-10">
            {{ Form::text('country', null, ['class' => 'form-control box-size', 'placeholder' => trans('validation.attributes.backend.mailinglists.country'), 'required' => 'required']) }}
        </div><!--col-lg-10-->
    </div><!--form control-->

    <div class="form-group">
        {{ Form::label('phone', trans('validation.attributes.backend.mailinglists.phone'), ['class' => 'col-lg-2 control-label required']) }}

        <div class="col-lg-10">
            {{ Form::text('phone', null, ['class' => 'form-control box-size', 'placeholder' => trans('validation.attributes.backend.mailinglists.phone'), 'required' => 'required']) }}
        </div><!--col-lg-10-->
    </div><!--form control-->

    <?php
        if(isset($mailinglist) && !empty($mailinglist->shop))
        {
            $shop = json_decode($mailinglist->shop, true);
        }
    ?>

    <div class="form-group">
        {{ Form::label('amazon_link', trans('validation.attributes.backend.mailinglists.amazon_link'), ['class' => 'col-lg-2 control-label required']) }}

        <div class="col-lg-10">
            {{ Form::text('amazon_link', isset($shop) && isset($shop['amazon_link']) ? $shop['amazon_link'] : null, ['class' => 'form-control box-size', 'placeholder' => trans('validation.attributes.backend.mailinglists.amazon_link')]) }}
        </div><!--col-lg-10-->
    </div><!--form control-->

    <div class="form-group">
        {{ Form::label('ebay_link', trans('validation.attributes.backend.mailinglists.ebay_link'), ['class' => 'col-lg-2 control-label required']) }}

        <div class="col-lg-10">
            {{ Form::text('ebay_link', isset($shop) && isset($shop['ebay_link']) ? $shop['ebay_link'] : null, ['class' => 'form-control box-size', 'placeholder' => trans('validation.attributes.backend.mailinglists.ebay_link')]) }}
        </div><!--col-lg-10-->
    </div><!--form control-->

    <div class="form-group">
        {{ Form::label('custom_link', trans('validation.attributes.backend.mailinglists.custom_link'), ['class' => 'col-lg-2 control-label required']) }}

        <div class="col-lg-10">
            {{ Form::text('custom_link', isset($shop) && isset($shop['custom_link']) ? $shop['custom_link'] : null, ['class' => 'form-control box-size', 'placeholder' => trans('validation.attributes.backend.mailinglists.custom_link')]) }}
        </div><!--col-lg-10-->
    </div><!--form control-->