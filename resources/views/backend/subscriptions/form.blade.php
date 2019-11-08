    <div class="form-group">
        {{ Form::label('name', trans('validation.attributes.backend.pages.title'), ['class' => 'col-lg-2 control-label required']) }}

        <div class="col-lg-10">
            {{ Form::text('name', null, ['class' => 'form-control box-size', 'placeholder' => trans('validation.attributes.backend.pages.title'), 'required' => 'required']) }}
        </div><!--col-lg-10-->
    </div><!--form control-->

    <div class="form-group">
        {{ Form::label('slug', trans('validation.attributes.backend.pages.slug'), ['class' => 'col-lg-2 control-label required']) }}

        <div class="col-lg-10">
            {{ Form::text('slug', null, ['class' => 'form-control box-size', 'placeholder' => trans('validation.attributes.backend.pages.slug'), 'required' => 'required']) }}
        </div><!--col-lg-10-->
    </div><!--form control-->

    <div class="form-group">
        {{ Form::label('content', trans('validation.attributes.backend.pages.content'), ['class' => 'col-lg-2 control-label required']) }}

        <div class="col-lg-10">
            {{ Form::textarea('content', null, ['class' => 'form-control box-size', 'placeholder' => trans('validation.attributes.backend.pages.content'), 'required' => 'required']) }}
        </div><!--col-lg-10-->
    </div><!--form control-->
