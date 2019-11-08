@extends ('backend.layouts.app')

@section ('title', trans('labels.backend.promos.management') . ' | ' . trans('labels.backend.promos.create'))

@section('page-header')
    <h1>
        {{ trans('labels.backend.promos.management') }}
        <small>{{ trans('labels.backend.promos.create') }}</small>
    </h1>
@endsection

@section('content')
    {{ Form::open(['route' => 'admin.promos.store', 'class' => 'form-horizontal', 'role' => 'form', 'method' => 'post', 'id' => 'create-permission', 'files' => true]) }}

        <div class="box box-success">
            <div class="box-header with-border">
                <h3 class="box-title">{{ trans('labels.backend.promos.create') }}</h3>

                <div class="box-tools pull-right">
                    @include('backend.includes.partials.promos-header-buttons')
                </div><!--box-tools pull-right-->
            </div><!-- /.box-header -->

            {{-- Including Form blade file --}}
            <div class="box-body">
                    @include("backend.promos.form")
                    <div class="edit-form-btn pull-right">
                    {{ link_to_route('admin.promos.index', trans('buttons.general.cancel'), [], ['class' => 'btn btn-danger btn-md']) }}
                    {{ Form::submit(trans('buttons.general.crud.create'), ['class' => 'btn btn-primary btn-md']) }}
                    <div class="clearfix"></div>
                </div>
        </div><!--box-->
    </div>
    {{ Form::close() }}
@endsection
