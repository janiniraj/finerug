@extends ('backend.layouts.app')

@section ('title', 'Home Page Slider Management')

@section('page-header')
    <h1>
        Home Page Slider Management
        <small>Slides</small>
    </h1>
@endsection

@section('content')
    <div index="0" class="panel panel-primary">
        <div class="panel-heading">Slide</div>
        {{ Form::open(['route' => 'admin.home-slider.store', 'class' => 'form-horizontal', 'role' => 'form', 'method' => 'post', 'files' => true]) }}
            {{ Form::hidden('id', null, ['class' => 'id']) }}
            <div class="panel-body">
                <div class="form-group">
                    {{ Form::label('type', 'Type: ', ['class' => 'col-lg-2 control-label required']) }}

                    <div class="col-lg-10">
                        {{ Form::select('type', ['image' => 'Image', 'youtubevideo' => 'Video'], 'image', ['class' => 'form-control box-size slide-type', 'required' => 'required']) }}
                    </div><!--col-lg-10-->
                </div><!--form control-->
                <div class="form-group video-upload-container hidden">
                    {{ Form::label('youtubevideo_id', 'Youtube Video ID: ', ['class' => 'col-lg-2 control-label required']) }}

                    <div class="col-lg-10">
                        {{ Form::text('youtubevideo_id', null, ['class' => 'form-control box-size', 'placeholder' => 'Youtube Video Id (ex. EKyirtVHsK0)', 'required' => 'required']) }}
                    </div><!--col-lg-10-->
                </div><!--form control-->
                <div class="form-group image-upload-container">
                    {{ Form::label('image', 'Image:', ['class' => 'col-lg-2 control-label required']) }}

                    <div class="col-lg-10">
                        {{ Form::file('image', $attributes = array('accept' => "image/x-png,image/gif,image/jpeg")) }}
                    </div><!--col-lg-10-->
                </div><!--form control-->
                {{ Form::submit('Save', ['class' => 'save-button btn btn-primary btn-md']) }}
                {{ Form::submit('Save And Add New', ['class' => 'save-add-button btn btn-success btn-md']) }}
            </div>
        {{ Form::close() }}
    </div>

@endsection

@section('after-scripts')
<script>
    $(document).ready(function(){
        $(document).on(".slide-type", "click", function(){
            if($(this).val() == 'image')
            {
                $(this).closest('.panel-body').
            }
        });
    });
</script>
@endsection
