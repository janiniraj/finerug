
    <div class="form-group">
        {{ Form::label('subcategory', trans('validation.attributes.backend.subcategories.title'), ['class' => 'col-lg-2 control-label required']) }}

        <div class="col-lg-10">
            {{ Form::text('subcategory', null, ['class' => 'form-control box-size', 'placeholder' => trans('validation.attributes.backend.subcategories.title'), 'required' => 'required']) }}
        </div><!--col-lg-10-->
    </div><!--form control-->

    <div class="form-group">
        {{ Form::label('category_id', trans('validation.attributes.backend.subcategories.category'), ['class' => 'col-lg-2 control-label required']) }}

        <div class="col-lg-10">
            {{ Form::select('category_id', $categoryName, null, ['class' => 'form-control select2', 'placeholder' => trans('validation.attributes.backend.subcategories.category'), 'required' => 'required']) }}
        </div><!--col-lg-10-->
    </div><!--form control-->

    <div class="form-group">
        {{ Form::label('icon', 'Icon', ['class' => 'col-lg-2 control-label required']) }}

        <div class="col-lg-10">
            @if(isset($subcategory) && $subcategory->icon)
            <img src="{{ URL::to('/').'/img/subcategory/'.$subcategory->icon }}" style="max-height: 100px;">
            @endif
            {{ Form::file('icon', $attributes = array('accept' => "image/x-png,image/gif,image/jpeg")) }}
        </div><!--col-lg-10-->
    </div><!--form control-->

    <div class="form-group">
        {{ Form::label('image', 'Main Image', ['class' => 'col-lg-2 control-label required']) }}

        <div class="col-lg-10">
            @if(isset($subcategory) && $subcategory->image)
            <img src="{{ URL::to('/').'/img/subcategory/'.$subcategory->image }}" style="max-height: 100px;">
            @endif
            {{ Form::file('image', $attributes = array('accept' => "image/x-png,image/gif,image/jpeg")) }}
        </div><!--col-lg-10-->
    </div><!--form control-->


    <div class="form-group">
        {{ Form::label('status', trans('validation.attributes.backend.subcategories.is_active'), ['class' => 'col-lg-2 control-label']) }}

        <div class="col-lg-10">
            <div class="control-group">
                <label class="control control--checkbox">
                        @if(isset($subcategory->status) && !empty ($subcategory->status))
                            {{ Form::checkbox('status', 1, true) }}
                        @else
                            {{ Form::checkbox('status', 1, false) }}
                        @endif
                    <div class="control__indicator"></div>
                </label>
            </div>
        </div><!--col-lg-3-->
    </div>
