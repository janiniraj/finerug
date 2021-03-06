@extends ('backend.layouts.app')

@section ('title', trans('labels.backend.mailinglists.management') . ' | ' . trans('labels.backend.mailinglists.create'))

@section('page-header')
    <h1>
        {{ trans('labels.backend.mailinglists.management') }}
        <small>{{ trans('labels.backend.mailinglists.create') }}</small>
    </h1>
@endsection

@section('content')
    {{ Form::open(['route' => 'admin.mailinglists.mailinglist', 'class' => 'form-horizontal', 'role' => 'form', 'method' => 'post', 'id' => 'create-permission', 'files' => true]) }}

        <div class="box box-success">
            <div class="box-header with-border">
                <h3 class="box-title">{{ trans('labels.backend.mailinglists.create') }}</h3>

                <div class="box-tools pull-right">
                    @include('backend.includes.partials.mailinglists-header-buttons')
                </div><!--box-tools pull-right-->
            </div><!-- /.box-header -->

            {{-- Including Form blade file --}}
            <div class="box-body">
                    @include("backend.mailinglists.form")
                    <div class="edit-form-btn pull-right">
                    {{ link_to_route('admin.mailinglists.index', trans('buttons.general.cancel'), [], ['class' => 'btn btn-danger btn-md']) }}
                    {{ Form::submit(trans('buttons.general.crud.create'), ['class' => 'btn btn-primary btn-md']) }}
                    <div class="clearfix"></div>
                </div>
        </div><!--box-->
    </div>
    {{ Form::close() }}
@endsection
