@extends ('backend.layouts.app')

@section ('title', 'Product Management')

@section('after-styles')
    {{ Html::style("https://cdn.datatables.net/v/bs/dt-1.10.15/datatables.min.css") }}
    
@endsection

@section('page-header')
    <h1>Inventory Management</h1>
@endsection

@section('content')
    <div class="box box-success">
        <div class="box-header with-border">
            <h3 class="box-title">Inventory Management</h3>
            <div class="col-md-8 pull-right">
                <form action="{{ route('admin.product.inventory-management') }}" method="GET"> 
                  <div class="row">
                    <div class="col-xs-6 col-md-4">
                      <div class="input-group">
                        <input type="text" name="q" value="{{ isset($_GET['q']) ? $_GET['q'] : '' }}" class="form-control" placeholder="Search" id="txtSearch"/>
                        <div class="input-group-btn">
                          <button class="btn btn-primary" type="submit">
                            <span class="glyphicon glyphicon-search"></span>
                          </button>
                        </div>
                      </div>
                    </div>
                  </div>
                </form>   
            </div>
            <div class="box-tools pull-right">
                             
                <button class="btn btn-success save-all">Save All</button>
            </div>
        </div><!-- /.box-header -->

        <div class="box-body">
            {{ Form::open(['route' => 'admin.product.inventory-management-store', 'class' => 'form-horizontal', 'role' => 'form', 'method' => 'post', 'id' => 'priceManagementForm', 'files' => true]) }}
            <div class="table-responsive">
                <table id="products-table" class="table table-condensed table-hover table-bordered">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Product Name</th>
                            <th>SKU</th>
                            <th>Type</th>
                            <th>In Stock</th>
                            <th>Size - Quantity</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($products as $key => $value)
                        <tr productid="{{ $value->id }}">
                            <input type="hidden" name="data[{{$key}}][id]" value="{{ $value->id }}" />
                            <td>{{ $value->id }}</td>
                            <td>{{ $value->name }}</td>
                            <td>{{ $value->sku }}</td>
                            <td>{{ $value->type }}</td>
                            <td>
                                <select class="form-control" name="data[{{$key}}][is_stock]">
                                    <option {{ $value->is_stock == 1 ? 'selected' : '' }} value="1">In Stock</option>
                                    <option {{ $value->is_stock == 0 ? 'selected' : '' }} value="0">Out of Stock</option>
                                </select>
                            </td>
                            <td>
                                <table class="table table-condensed table-hover table-bordered">
                                    <tbody>
                                        @foreach($value->size as $sKey => $sValue)
                                            <tr>
                                                <input type="hidden" name="data[{{ $key }}][size][{{ $sKey }}][id]" value="{{ $sValue->id }}" />
                                                <td>{{ ($sValue->width+0).' x '. ($sValue->length+0) }}</td>
                                                <td>
                                                    <input type="number" class="form-control size_price_input" name="data[{{ $key }}][size][{{ $sKey }}][quantity]" placeholder="Quantity" value="{{ $sValue->quantity }}" width="{{ $sValue->width }}" length="{{ $sValue->length }}" />
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div><!--table-responsive-->
            {{ Form::close() }}
        </div><!-- /.box-body -->
    </div><!--box-->
    {!! $products->links() !!}
    <div class="box box-info">
        <div class="box-header with-border">
            <h3 class="box-title">{{ trans('history.backend.recent_history') }}</h3>
            <div class="box-tools pull-right">
                <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
            </div><!-- /.box tools -->
        </div><!-- /.box-header -->
        <div class="box-body">
            {!! history()->renderType('Product') !!}
        </div><!-- /.box-body -->
    </div><!--box box-success-->
@endsection

@section('after-scripts')
    {{ Html::script("https://cdn.datatables.net/v/bs/dt-1.10.15/datatables.min.js") }}
    {{ Html::script("js/backend/plugin/datatables/dataTables-extend.js") }}

    <script>
        $(document).ready(function(){
            $(".sidebar-toggle").click();
            $(".save-all").on("click", function(e){
                e.preventDefault();

                $("#priceManagementForm").submit();
            });
            $(".size_price_input").on("change", function(){
                var width = parseFloat($(this).attr("width"));
                var length = parseFloat($(this).attr("length"));
                var currentval = parseFloat($(this).val());

                $(this).closest('td').find(".size_price_span").text("$"+parseFloat(width*length*currentval).toFixed(2));
            });
            $(".size_price_affiliate_input").on("change", function(){
                var width = parseFloat($(this).attr("width"));
                var length = parseFloat($(this).attr("length"));
                var currentval = parseFloat($(this).val());

                $(this).closest('td').find(".size_price_affiliate_span").text("$"+parseFloat(width*length*currentval).toFixed(2));
            });
        });
    </script>
@endsection
