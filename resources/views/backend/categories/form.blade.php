    <div class="form-group">
        {{ Form::label('category', trans('validation.attributes.backend.categories.title'), ['class' => 'col-lg-2 control-label required']) }}

        <div class="col-lg-10">
            {{ Form::text('category', null, ['class' => 'form-control box-size', 'placeholder' => trans('validation.attributes.backend.categories.title'), 'required' => 'required']) }}
        </div><!--col-lg-10-->
    </div><!--form control-->

    <div class="form-group">
        {{ Form::label('icon', 'Icon', ['class' => 'col-lg-2 control-label required']) }}

        <div class="col-lg-10">
            @if(isset($category) && $category->icon)
            <img src="{{ URL::to('/').'/img/category/'.$category->icon }}" style="max-height: 100px;">
            @endif
            {{ Form::file('icon', $attributes = array('accept' => "image/x-png,image/gif,image/jpeg")) }}
        </div><!--col-lg-10-->
    </div><!--form control-->

    <div class="form-group">
        {{ Form::label('image', 'Main Image', ['class' => 'col-lg-2 control-label required']) }}

        <div class="col-lg-10">
            @if(isset($category) && $category->image)
            <img src="{{ URL::to('/').'/img/category/'.$category->image }}" style="max-height: 100px;">
            @endif
            {{ Form::file('image', $attributes = array('accept' => "image/x-png,image/gif,image/jpeg")) }}
        </div><!--col-lg-10-->
    </div><!--form control-->

    <div class="form-group">
        {{ Form::label('status', trans('validation.attributes.backend.categories.is_active'), ['class' => 'col-lg-2 control-label']) }}

        <div class="col-lg-10">
            <div class="control-group">
                <label class="control control--checkbox">
                        @if(isset($category->status) && !empty ($category->status))
                            {{ Form::checkbox('status', 1, true) }}
                        @else
                            {{ Form::checkbox('status', 1, false) }}
                        @endif
                    <div class="control__indicator"></div>
                </label>
            </div>
        </div><!--col-lg-3-->
    </div>
