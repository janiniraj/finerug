    <div class="form-group">
        {{ Form::label('name', trans('validation.attributes.backend.promos.title'), ['class' => 'col-lg-2 control-label required']) }}

        <div class="col-lg-10">
            {{ Form::text('name', null, ['class' => 'form-control box-size', 'placeholder' => trans('validation.attributes.backend.promos.title'), 'required' => 'required']) }}
        </div><!--col-lg-10-->
    </div><!--form control-->

    <div class="form-group">
        {{ Form::label('code', trans('validation.attributes.backend.promos.code'), ['class' => 'col-lg-2 control-label required']) }}

        <div class="col-lg-10">
            {{ Form::text('code', null, ['class' => 'form-control box-size', 'placeholder' => trans('validation.attributes.backend.promos.code'), 'required' => 'required']) }}
        </div><!--col-lg-10-->
    </div><!--form control-->

    <div class="form-group">
        {{ Form::label('type', trans('validation.attributes.backend.promos.type'), ['class' => 'col-lg-2 control-label required']) }}

        <div class="col-lg-10">
            {{ Form::select('type', ['flat' => 'Flat Discount', 'percentage' => 'Percentage Discount'], 'flat', ['class' => 'form-control box-size', 'required' => 'required']) }}
        </div><!--col-lg-10-->
    </div><!--form control-->

    <div class="form-group">
        {{ Form::label('discount', trans('validation.attributes.backend.promos.discount'), ['class' => 'col-lg-2 control-label required']) }}

        <div class="col-lg-10">
            {{ Form::number('discount', null, ['class' => 'form-control box-size', 'placeholder' => trans('validation.attributes.backend.promos.discount'), 'required' => 'required']) }}
        </div><!--col-lg-10-->
    </div><!--form control-->

    <div class="form-group">
        {{ Form::label('description', trans('validation.attributes.backend.promos.description'), ['class' => 'col-lg-2 control-label required']) }}

        <div class="col-lg-10">
            {{ Form::textarea('description', null, ['class' => 'form-control box-size', 'placeholder' => trans('validation.attributes.backend.promos.description'), 'rows' => 3]) }}
        </div><!--col-lg-10-->
    </div><!--form control-->


    
    <div class="form-group">
        {{ Form::label('status', trans('validation.attributes.backend.promos.is_active'), ['class' => 'col-lg-2 control-label']) }}

        <div class="col-lg-10">
            <div class="control-group">
                <label class="control control--checkbox">
                        @if(isset($promo->status) && !empty ($promo->status))
                            {{ Form::checkbox('status', 1, true) }}
                        @else
                            {{ Form::checkbox('status', 1, false) }}
                        @endif
                    <div class="control__indicator"></div>
                </label>
            </div>
        </div><!--col-lg-3-->
    </div>
