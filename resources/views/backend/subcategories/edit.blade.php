@extends ('backend.layouts.app')

@section ('title', trans('labels.backend.subcategories.management') . ' | ' . trans('labels.backend.subcategories.edit'))

@section('page-header')
    <h1>
        {{ trans('labels.backend.subcategories.management') }}
        <small>{{ trans('labels.backend.subcategories.edit') }}</small>
    </h1>
@endsection

@section('content')
    {{ Form::model($subcategory, ['route' => ['admin.subcategories.update', $subcategory], 'class' => 'form-horizontal', 'role' => 'form', 'method' => 'PATCH', 'id' => 'edit-role', 'files' => true]) }}

        <div class="box box-success">
            <div class="box-header with-border">
                <h3 class="box-title">{{ trans('labels.backend.subcategories.edit') }}</h3>

                <div class="box-tools pull-right">
                    @include('backend.includes.partials.subcategories-header-buttons')
                </div><!--box-tools pull-right-->
            </div><!-- /.box-header -->

            {{-- Including Form blade file --}}
            <div class="box-body">
                <div class="form-group">
                    @include("backend.subcategories.form")
                    <div class="edit-form-btn">
                    {{ link_to_route('admin.subcategories.index', trans('buttons.general.cancel'), [], ['class' => 'btn btn-danger btn-md']) }}
                    {{ Form::submit(trans('buttons.general.crud.update'), ['class' => 'btn btn-primary btn-md']) }}
                    <div class="clearfix"></div>
                </div>
            </div>
        </div><!--box-->
    </div>
{{ Form::close() }}
@endsection