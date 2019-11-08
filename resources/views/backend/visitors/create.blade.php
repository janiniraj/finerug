@extends ('backend.layouts.app')

@section ('title', trans('labels.backend.visitors.management') . ' | ' . trans('labels.backend.visitors.create'))

@section('page-header')
    <h1>
        {{ trans('labels.backend.visitors.management') }}
        <small>{{ trans('labels.backend.visitors.create') }}</small>
    </h1>
@endsection

@section('content')
    {{ Form::open(['route' => 'admin.visitors.visitor', 'class' => 'form-horizontal', 'role' => 'form', 'method' => 'post', 'id' => 'create-permission', 'files' => true]) }}

        <div class="box box-success">
            <div class="box-header with-border">
                <h3 class="box-title">{{ trans('labels.backend.visitors.create') }}</h3>

                <div class="box-tools pull-right">
                    @include('backend.includes.partials.visitors-header-buttons')
                </div><!--box-tools pull-right-->
            </div><!-- /.box-header -->

            {{-- Including Form blade file --}}
            <div class="box-body">
                    @include("backend.visitors.form")
                    <div class="edit-form-btn pull-right">
                    {{ link_to_route('admin.visitors.index', trans('buttons.general.cancel'), [], ['class' => 'btn btn-danger btn-md']) }}
                    {{ Form::submit(trans('buttons.general.crud.create'), ['class' => 'btn btn-primary btn-md']) }}
                    <div class="clearfix"></div>
                </div>
        </div><!--box-->
    </div>
    {{ Form::close() }}
@endsection

@section('after-scripts')
    <script type="text/javascript">
        $(".image1").on('change', function ()
        {
            var input = this;
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('.image-display1')
                        .attr('src', e.target.result).removeClass('hidden');
                };

                reader.readAsDataURL(input.files[0]);
            }
        });
        $(".image2").on('change', function ()
        {
            var input = this;
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('.image-display2')
                        .attr('src', e.target.result).removeClass('hidden');
                };

                reader.readAsDataURL(input.files[0]);
            }
        });
    </script>
@endsection