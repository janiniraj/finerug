    <div class="form-group">
        {{ Form::label('type_users', 'Type of User', ['class' => 'col-lg-2 control-label required']) }}

        <div class="col-lg-10">
            {{ Form::select('type_users', ['all_user' => 'All User', 'all_mailinglist' => 'All Mailing List', 'specific_user' => 'Specific Users', 'specific__mailing_list' => 'Specific Mailing List Users'], null, ['class' => 'form-control box-size']) }}
        </div><!--col-lg-10-->
    </div><!--form control-->
    <div class="form-group user-container">
        {{ Form::label('users', 'User List', ['class' => 'col-lg-2 control-label required']) }}

        <div class="col-lg-10">
            {{ Form::select('users[]', $userList, null, ['class' => 'form-control box-size', 'multiple']) }}
        </div><!--col-lg-10-->
    </div><!--form control-->

    <div class="form-group mailinglist-container">
        {{ Form::label('mailinglist', 'Mailing List', ['class' => 'col-lg-2 control-label required']) }}

        <div class="col-lg-10">
            {{ Form::select('mailinglist[]', $mailingList, null, ['class' => 'form-control box-size', 'multiple']) }}
        </div><!--col-lg-10-->
    </div><!--form control-->

    <div class="form-group">
        {{ Form::label('subject', trans('validation.attributes.backend.emails.title'), ['class' => 'col-lg-2 control-label required']) }}

        <div class="col-lg-10">
            {{ Form::text('subject', null, ['class' => 'form-control box-size', 'placeholder' => trans('validation.attributes.backend.emails.title'), 'required' => 'required']) }}
        </div><!--col-lg-10-->
    </div><!--form control-->

    <div class="form-group">
        {{ Form::label('content', trans('validation.attributes.backend.emails.content'), ['class' => 'col-lg-2 control-label required']) }}

        <div class="col-lg-10">
            {{ Form::textarea('content', null, ['class' => 'form-control box-size', 'placeholder' => trans('validation.attributes.backend.emails.content'), 'required' => 'required']) }}
        </div><!--col-lg-10-->
    </div><!--form control-->