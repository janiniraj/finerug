@extends ('backend.layouts.app')

@section ('title', trans('labels.backend.colors.management') . ' | ' . trans('labels.backend.colors.edit'))

@section('page-header')
    <h1>
        {{ trans('labels.backend.colors.management') }}
        <small>{{ trans('labels.backend.colors.edit') }}</small>
    </h1>
@endsection

@section('content')
    {{ Form::model($color, ['route' => ['admin.colors.update', $color], 'class' => 'form-horizontal', 'role' => 'form', 'method' => 'PATCH', 'id' => 'edit-role', 'files' => true]) }}

        <div class="box box-success">
            <div class="box-header with-border">
                <h3 class="box-title">{{ trans('labels.backend.colors.edit') }}</h3>

                <div class="box-tools pull-right">
                    @include('backend.includes.partials.colors-header-buttons')
                </div><!--box-tools pull-right-->
            </div><!-- /.box-header -->

            {{-- Including Form blade file --}}
            <div class="box-body">
                    @include("backend.colors.form")
                    <div class="edit-form-btn pull-right">
                    {{ link_to_route('admin.colors.index', trans('buttons.general.cancel'), [], ['class' => 'btn btn-danger btn-md']) }}
                    {{ Form::submit(trans('buttons.general.crud.update'), ['class' => 'btn btn-primary btn-md']) }}
                    <div class="clearfix"></div>
                </div>
        </div><!--box-->
    </div>
{{ Form::close() }}
@endsection

@section('after-scripts')
    <script>

        var n_match  = ntc.name($(".color-picker").val());                    
        if(n_match[1].length)
        {
            $(".display_name").val(n_match[1]);
        }

        $(document).ready(function(){
            $(".color-picker").on('change', function(){
                $(".color-picker-display").text($(this).val());

                var n_match  = ntc.name($(this).val());
                    
                if(n_match[1].length)
                {
                    $(".display_name").val(n_match[1]);
                }
            })
        });
    </script>
@endsection