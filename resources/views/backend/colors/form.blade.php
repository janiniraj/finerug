    <div class="form-group">
        {{ Form::label('name', trans('validation.attributes.backend.colors.title'), ['class' => 'col-lg-2 control-label required']) }}

        <div class="col-lg-10">
            {{ Form::color('name', null, ['class' => 'box-size color-picker', 'placeholder' => trans('validation.attributes.backend.colors.title'), 'required' => 'required']) }}
            <span class="color-picker-display"><?= isset($color->name) ? $color->name : '#00000' ?></span>
        </div><!--col-lg-10-->
    </div><!--form control-->

    <div class="form-group">
        {{ Form::label('display_name', trans('validation.attributes.backend.colors.title'), ['class' => 'col-lg-2 control-label required']) }}

        <div class="col-lg-10">
            {{ Form::text('display_name', null, ['class' => 'form-control display_name', 'placeholder' => trans('validation.attributes.backend.colors.title'), 'required' => 'required']) }}
        </div><!--col-lg-10-->
    </div><!--form control-->
    
    <div class="form-group">
        {{ Form::label('status', trans('validation.attributes.backend.colors.is_active'), ['class' => 'col-lg-2 control-label']) }}

        <div class="col-lg-10">
            <div class="control-group">
                <label class="control control--checkbox">
                        @if(isset($color->status) && !empty ($color->status))
                            {{ Form::checkbox('status', 1, true) }}
                        @else
                            {{ Form::checkbox('status', 1, false) }}
                        @endif
                    <div class="control__indicator"></div>
                </label>
            </div>
        </div><!--col-lg-3-->
    </div>

    <div class="form-group">
        {{ Form::label('status', trans('validation.attributes.backend.colors.is_menu'), ['class' => 'col-lg-2 control-label']) }}

        <div class="col-lg-10">
            <div class="control-group">
                <label class="control control--checkbox">
                        @if(isset($color->is_menu) && !empty ($color->is_menu))
                            {{ Form::checkbox('is_menu', 1, true) }}
                        @else
                            {{ Form::checkbox('is_menu', 1, false) }}
                        @endif
                    <div class="control__indicator"></div>
                </label>
            </div>
        </div><!--col-lg-3-->
    </div>
