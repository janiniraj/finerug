@extends ('backend.layouts.app')

@section ('title', trans('labels.backend.styles.management') . ' | ' . trans('labels.backend.styles.edit'))

@section('page-header')
    <h1>
        {{ trans('labels.backend.styles.management') }}
        <small>{{ trans('labels.backend.styles.edit') }}</small>
    </h1>
@endsection

@section('content')
    {{ Form::model($style, ['route' => ['admin.styles.update', $style], 'class' => 'form-horizontal', 'role' => 'form', 'method' => 'PATCH', 'id' => 'edit-role', 'files' => true]) }}

        <div class="box box-success">
            <div class="box-header with-border">
                <h3 class="box-title">{{ trans('labels.backend.styles.edit') }}</h3>

                <div class="box-tools pull-right">
                    @include('backend.includes.partials.styles-header-buttons')
                </div><!--box-tools pull-right-->
            </div><!-- /.box-header -->

            {{-- Including Form blade file --}}
            <div class="box-body">
                    @include("backend.styles.form")
                    <div class="edit-form-btn pull-right">
                    {{ link_to_route('admin.styles.index', trans('buttons.general.cancel'), [], ['class' => 'btn btn-danger btn-md']) }}
                    {{ Form::submit(trans('buttons.general.crud.update'), ['class' => 'btn btn-primary btn-md']) }}
                    <div class="clearfix"></div>
                </div>
        </div><!--box-->
    </div>
{{ Form::close() }}
@endsection