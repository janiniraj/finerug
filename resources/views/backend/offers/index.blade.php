@extends ('backend.layouts.app')

@section ('title', trans('labels.backend.offers.management'))

@section('after-offers')
    {{ Html::style("css/backend/plugin/datatables/dataTables.bootstrap.min.css") }}
@endsection

@section('page-header')
    <h1>{{ trans('labels.backend.offers.management') }}</h1>
@endsection

@section('content')
    <div class="box box-success">
        <div class="box-header with-border">
            <h3 class="box-title">{{ trans('labels.backend.offers.management') }}</h3>

            <div class="box-tools pull-right">
                @include('backend.includes.partials.offers-header-buttons')
            </div>
        </div><!-- /.box-header -->

        <div class="box-body">
            <div class="table-responsive data-table-wrapper">
                <table id="offers-table" class="table table-condensed table-hover table-bordered">
                    <thead>
                        <tr>
                            <th>{{ trans('labels.backend.offers.table.product_link') }}</th>
                            <th>{{ trans('labels.backend.offers.table.offer_price') }}</th>
                            <th>{{ trans('labels.backend.offers.table.first_name') }}</th>
                            <th>{{ trans('labels.backend.offers.table.last_name') }}</th>
                            <th>{{ trans('labels.backend.offers.table.email') }}</th>
                            <th>{{ trans('labels.backend.offers.table.phone') }}</th>
                            <th>{{ trans('labels.backend.offers.table.createdat') }}</th>
                            <th>{{ trans('labels.general.actions') }}</th>
                        </tr>
                    </thead>
                    <thead class="transparent-bg">
                        <tr>
                            <th>
                                {!! Form::text('title', null, ["class" => "search-input-text form-control", "data-column" => 0, "placeholder" => trans('labels.backend.offers.table.product_name')]) !!}
                                    <a class="reset-data" href="javascript:void(0)"><i class="fa fa-times"></i></a>
                            </th>
                            <th>
                            </th>
                            <th></th>
                            <th></th>
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

    <div class="modal fade" id="offerConvesationModel" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Send Mail to Customer</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                {{ Form::open(['route' => 'admin.offers.send-mail', 'role' => 'form', 'method' => 'post', 'id' => 'sendMailForm', 'files' => true]) }}
                    <div class="modal-body">

                            <input type="hidden" name="offer_id" id="offer_id" value="">
                            <div class="form-group">
                                <label for="recipient-name" class="col-form-label">Recipient:</label>
                                <input required name="email" readonly type="text" class="form-control" id="offer_email">
                            </div>
                            <div class="form-group">
                                <label for="message-text" class="col-form-label">Message:</label>
                                <textarea rows="5" required name="description" class="form-control" id="message-text"></textarea>
                            </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <input type="submit" class="btn btn-primary" value="Send Mail">
                    </div>
                {{ Form::close() }}
            </div>
        </div>
    </div>
@endsection

@section('after-scripts')
    {{-- For DataTables --}}
    @include('includes.datatables')

    <script>
        $(function() {
            var dataTable = $('#offers-table').dataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: '{{ route("admin.offers.get") }}',
                    type: 'post'
                },
                columns: [
                    {data: 'product_link', name: '{{config('access.offer_table')}}.product_link'},
                    {data: 'offer_price', name: '{{config('access.offer_table')}}.offer_price'},
                    {data: 'first_name', name: '{{config('access.offer_table')}}.first_name'},
                    {data: 'last_name', name: '{{config('access.offer_table')}}.last_name'},
                    {data: 'email', name: '{{config('access.offer_table')}}.email'},
                    {data: 'phone', name: '{{config('access.offer_table')}}.phone'},
                    {data: 'created_at', name: '{{config('access.offer_table')}}.created_at'},
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

        $(document).ready(function () {
            $(document).on("click",".open-model-offer", function (e) {
                e.preventDefault();
                var email = $(this).attr("offer_email");
                var offer_id = $(this).attr("offer_id");
                $("#offer_email").val(email);
                $("#offer_id").val(offer_id);

                $("#offerConvesationModel").modal('show');
            })
        })
    </script>
@endsection