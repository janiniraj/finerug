@extends ('backend.layouts.app')

@section ('title', trans('labels.backend.home_slider.management') . ' | ' . trans('labels.backend.home_slider.create'))

@section('page-header')
    <h1>
        {{ trans('labels.backend.home_slider.management') }}
        <small>{{ trans('labels.backend.home_slider.create') }}</small>
    </h1>
@endsection

@section('content')
    {{ Form::open(['route' => 'admin.home-slider.store', 'class' => 'form-horizontal', 'role' => 'form', 'method' => 'post', 'id' => 'create-permission', 'files' => true]) }}

        <div class="box box-success">
            <div class="box-header with-border">
                <h3 class="box-title">{{ trans('labels.backend.home_slider.create') }}</h3>

                <div class="box-tools pull-right">
                    @include('backend.includes.partials.home-slider-header-buttons')
                </div><!--box-tools pull-right-->
            </div><!-- /.box-header -->

            {{-- Including Form blade file --}}
            <div class="box-body">
                @include("backend.homeSlider.form")
                <div class="edit-form-btn pull-right">
                    {{ Form::submit(trans('buttons.general.crud.create'), ['class' => 'btn btn-primary btn-md']) }}
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
                $(".image").prop('required', true);
            }
        });
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
