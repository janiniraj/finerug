@extends ('backend.layouts.app')

@section ('title', trans('labels.backend.mailinglists.management'))

@section('after-mailinglists')
    {{ Html::style("css/backend/plugin/datatables/dataTables.bootstrap.min.css") }}
@endsection

@section('page-header')
    <h1>{{ trans('labels.backend.mailinglists.management') }}</h1>
@endsection

@section('content')
    <div class="box box-success">
        <div class="box-header with-border">
            <h3 class="box-title">{{ trans('labels.backend.mailinglists.management') }}</h3>

        </div><!-- /.box-header -->

        <div class="box-body">
            <div class="table-responsive data-table-wrapper">
                <table id="mailinglists-table" class="table table-condensed table-hover table-bordered">
                    <thead>
                        <tr>
                            <th>{{ trans('labels.backend.mailinglists.table.firstname') }}</th>
                            <th>{{ trans('labels.backend.mailinglists.table.lastname') }}</th>
                            <th>{{ trans('labels.backend.mailinglists.table.email') }}</th>
                            <th>{{ trans('labels.backend.mailinglists.table.address') }}</th>
                            <th>{{ trans('labels.backend.mailinglists.table.pobox') }}</th>
                            <th>{{ trans('labels.backend.mailinglists.table.phone') }}</th>
                            <th>{{ trans('labels.backend.mailinglists.table.createdat') }}</th>
                            <th>{{ trans('labels.general.actions') }}</th>
                        </tr>
                    </thead>
                    <thead class="transparent-bg">
                        <tr>
                            <th>
                                {!! Form::text('firstname', null, ["class" => "search-input-text form-control", "data-column" => 0, "placeholder" => trans('labels.backend.mailinglists.table.firstname')]) !!}
                                    <a class="reset-data" href="javascript:void(0)"><i class="fa fa-times"></i></a>
                            </th>
                            <th>
                                {!! Form::text('lastname', null, ["class" => "search-input-text form-control", "data-column" => 0, "placeholder" => trans('labels.backend.mailinglists.table.lastname')]) !!}
                                <a class="reset-data" href="javascript:void(0)"><i class="fa fa-times"></i></a>
                            </th>
                            <th>
                                {!! Form::text('email', null, ["class" => "search-input-text form-control", "data-column" => 0, "placeholder" => trans('labels.backend.mailinglists.table.email')]) !!}
                                <a class="reset-data" href="javascript:void(0)"><i class="fa fa-times"></i></a>
                            </th>
                            <th>
                                {!! Form::text('address', null, ["class" => "search-input-text form-control", "data-column" => 0, "placeholder" => trans('labels.backend.mailinglists.table.address')]) !!}
                                    <a class="reset-data" href="javascript:void(0)"><i class="fa fa-times"></i></a>
                            </th>
                            <th>
                                {!! Form::text('pobox', null, ["class" => "search-input-text form-control", "data-column" => 0, "placeholder" => trans('labels.backend.mailinglists.table.pobox')]) !!}
                                    <a class="reset-data" href="javascript:void(0)"><i class="fa fa-times"></i></a>
                            </th>
                            <th>
                                {!! Form::text('phone', null, ["class" => "search-input-text form-control", "data-column" => 0, "placeholder" => trans('labels.backend.mailinglists.table.phone')]) !!}
                                    <a class="reset-data" href="javascript:void(0)"><i class="fa fa-times"></i></a>
                            </th>
                            <th></th>
                            <th></th>
                            <th></th>
                        </tr>
                    </thead>
                </table>
            </div><!--table-responsive-->
        </div><!-- /.box-body -->
    </div><!--box-->

    <!--<div class="box box-info">
        <div class="box-header with-border">
            <h3 class="box-title">{{ trans('history.backend.recent_history') }}</h3>
            <div class="box-tools pull-right">
                <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
            </div><!-- /.box tools -->
        </div><!-- /.box-header -->
        <div class="box-body">
            {{-- {!! history()->renderType('Category') !!} --}}
        </div><!-- /.box-body -->
    </div><!--box box-success-->
@endsection

@section('after-scripts')
    {{-- For DataTables --}}
    @include('includes.datatables')
    
    <script>
        $(function() {
            var dataTable = $('#mailinglists-table').dataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: '{{ route("admin.mailinglists.get") }}',
                    type: 'post'
                },
                columns: [
                    {data: 'firstname', name: '{{config('access.mailinglist_table')}}.firstname'},
                    {data: 'lastname', name: '{{config('access.mailinglist_table')}}.lastname'},
                    {data: 'email', name: '{{config('access.mailinglist_table')}}.email'},
                    {data: 'address', name: '{{config('access.mailinglist_table')}}.address'},
                    {data: 'pobox', name: '{{config('access.mailinglist_table')}}.pobox'},
                    {data: 'phone', name: '{{config('access.mailinglist_table')}}.phone'},
                    {data: 'created_at', name: '{{config('access.mailinglist_table')}}.created_at'},
                    {data: 'actions', name: 'actions', searchable: false, sortable: false}
                ],
                order: [[3, "asc"]],
                searchDelay: 500,
                dom: 'lBfrtip',
                buttons: {
                    buttons: [
                        { extend: 'copy', className: 'copyButton',  exportOptions: {columns: [ 0, 1, 2, 3 ]  }},
                        { extend: 'csv', className: 'csvButton',  exportOptions: {columns: [ 0, 1, 2, 3 ]  }},
                        { extend: 'excel', className: 'excelButton',  exportOptions: {columns: [ 0, 1, 2, 3 ]  }},
                        { extend: 'pdf', className: 'pdfButton',  exportOptions: {columns: [ 0, 1, 2, 3 ]  }},
                        { extend: 'print', className: 'printButton',  exportOptions: {columns: [ 0, 1, 2, 3 ]  }}
                    ]
                }
            });

            FinBuilders.DataTableSearch.init(dataTable);
        });
    </script>
@endsection