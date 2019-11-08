@extends ('backend.layouts.app')

@section ('title', trans('labels.backend.home_slider.management') . ' | ' . trans('labels.backend.home_slider.edit'))

@section('page-header')
    <h1>
        {{ trans('labels.backend.home_slider.management') }}
        <small>{{ trans('labels.backend.home_slider.edit') }}</small>
    </h1>
@endsection

@section('content')
    {{ Form::model($homeslider, ['route' => ['admin.home-slider.update', $homeslider], 'class' => 'form-horizontal', 'role' => 'form', 'method' => 'PATCH', 'id' => 'edit-role', 'files' => true]) }}
        {{ form::hidden('id', $homeslider->id) }}
        <div class="box box-success">
            <div class="box-header with-border">
                <h3 class="box-title">{{ trans('labels.backend.home_slider.edit') }}</h3>

                <div class="box-tools pull-right">
                    @include('backend.includes.partials.home-slider-header-buttons')
                </div><!--box-tools pull-right-->
            </div><!-- /.box-header -->

            {{-- Including Form blade file --}}
            <div class="box-body">
                @include("backend.homeSlider.form")
                <div class="edit-form-btn pull-right">
                    {{ Form::submit(trans('buttons.general.crud.update'), ['class' => 'btn btn-primary btn-md']) }}
                    {{ link_to_route('admin.home-slider.index', trans('buttons.general.cancel'), [], ['class' => 'btn btn-danger btn-md']) }}
                    <div class="clearfix"></div>
                </div>
            </div><!--box-->
        </div>
    {{ Form::close() }}
@endsection

@section('after-scripts')
    <script>
        $(".slide-type").on('change', function()
        {
            if($(this).val() == 'youtubevideo')
            {
                $(".video-upload-container").removeClass('hidden');
                $(".image-upload-container").addClass('hidden');
                $(".youtubevideo_id").prop('required', true);
                $(".image").prop('required', false);
            }
            else
            {
                $(".image-upload-container").removeClass('hidden');
                $(".video-upload-container").addClass('hidden');
                $(".youtubevideo_id").prop('required', false);
                <?php if(!(isset($homeslider->image) && $homeslider->image)) { ?>
                $(".image").prop('required', true);
                <?php } else { ?>
                $(".image").prop('required', false);
                <?php } ?>
            }
        });
        $(".slide-type").change();
        $(".image").on('change', function ()
        {
            var input = this;
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('.image-display')
                        .attr('src', e.target.result).removeClass('hidden');
                };

                reader.readAsDataURL(input.files[0]);
            }
        });
    </script>
@endsection