<div class="form-group">
    {{ Form::label('page_type', 'Type: ', ['class' => 'col-lg-2 control-label required']) }}

    <div class="col-lg-10">
        {{ Form::select('page_type', $pages, isset($homeslider) ? $homeslider->page_type : 'homepage', ['class' => 'form-control box-size slide-type', 'required' => 'required']) }}
    </div><!--col-lg-10-->
</div><!--form control-->
<div class="form-group">
    {{ Form::label('title', 'Title: ', ['class' => 'col-lg-2 control-label']) }}

    <div class="col-lg-10">
        {{ Form::text('title', null, ['class' => 'form-control box-size', 'placeholder' => 'Title (Only with Image)']) }}
    </div><!--col-lg-10-->
</div><!--form control-->
<div class="form-group">
    {{ Form::label('url', 'Url: ', ['class' => 'col-lg-2 control-label required']) }}

    <div class="col-lg-10">
        {{ Form::text('url', null, ['class' => 'form-control box-size', 'placeholder' => 'Url (Only with Image) i.e. /featured-items']) }}
    </div><!--col-lg-10-->
</div><!--form control-->
<div class="form-group">
    {{ Form::label('type', 'Type: ', ['class' => 'col-lg-2 control-label required']) }}

    <div class="col-lg-10">
        {{ Form::select('type', ['image' => 'Image', 'youtubevideo' => 'Video'], isset($homeslider) ? $homeslider->type : 'image', ['class' => 'form-control box-size slide-type', 'required' => 'required']) }}
    </div><!--col-lg-10-->
</div><!--form control-->
<div class="form-group video-upload-container hidden">
    {{ Form::label('youtubevideo_id', 'Youtube Video ID: ', ['class' => 'col-lg-2 control-label required']) }}

    <div class="col-lg-10">
        {{ Form::text('youtubevideo_id', null, ['class' => 'form-control box-size youtubevideo_id', 'placeholder' => 'Youtube Video Id (ex. EKyirtVHsK0)']) }}
    </div><!--col-lg-10-->
</div><!--form control-->
<div class="form-group image-upload-container">
    {{ Form::label('image', 'Image:', ['class' => 'col-lg-2 control-label required']) }}

    <div class="col-lg-10">
        <img class="image-display {{ isset($homeslider->image) ? '' : 'hidden' }}" src="{{ isset($homeslider->image) ? URL::to('/').'/img/sliders/'.$homeslider->image : "" }}" style="max-height: 100px;">
        {{ Form::file('image', $attributes = array('required' => 'required', 'class' => 'image', 'accept' => "image/x-png,image/gif,image/jpeg")) }}
    </div><!--col-lg-10-->
</div><!--form control-->
