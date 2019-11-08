@extends ('backend.layouts.app')

@section ('title', 'Product Management')

@section('after-styles')
    {{ Html::style("https://cdn.datatables.net/v/bs/dt-1.10.15/datatables.min.css") }}
    <style type="text/css">
        @media screen {            
          #printSection {
              display: none;
          }
        }

        @media print {
            @page {
                margin: 0px;
            }

            div {
                padding-bottom: -15px;
                margin-bottom: -15px;
            }
            p {
                font-size: 14px;
                font-weight: bold;
            }
            .modal-barcode-image {
                margin-top: 15px;
            }
            body * {
                visibility:hidden;
            }
            #printSection, #printSection * {
                visibility:visible;
            }
            #printSection {
                position:absolute;
                left:0;
                top:0;
            }

            #barcodePrintSection {
                margin-top: 35px;
                margin-bottom: 20px;
            }

            .new-box {
                padding-left: 30px;
                width: 50%;
                height: 230px;
                display: inline-block;
                float: left;
                margin-top: -10px;
            }

        }
    </style>
@endsection

@section('page-header')
    <h1>Product Management</h1>
@endsection

@section('content')
    <div class="box box-success">
        <div class="box-header with-border">
            <h3 class="box-title">Product Management</h3>
            <div class="box-tools pull-right">                
                @include('backend.products.partials.header-buttons')
            </div>
        </div><!-- /.box-header -->

        <div class="box-body">
            <div class="table-responsive">
                <table id="products-table" class="table table-condensed table-hover">
                    <thead>
                        <tr>
                            <th>Product Name</th>
                            <th>SKU</th>
                            <th>Type</th>
                            <th>{{ trans('labels.general.actions') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($products as $key => $value)
                        <tr productid="{{ $value->id }}">
                            <td>{{ $value->name }}</td>
                            <td>{{ $value->sku }}</td>
                            <td>{{ $value->type }}</td>
                            <td>
                                <a productid="{{ $value->id }}" class="btn btn-small btn-success pull-right barcode-button">Barcode</a>
                                {{ Form::open(array('url' => 'admin/product/' . $value->id, 'class' => 'pull-right')) }}
                                {{ Form::hidden('_method', 'DELETE') }}
                                {{ Form::button('Delete', array('class' => 'btn btn-warning delete-product-button')) }}
                                {{ Form::close() }}
                                <a class="btn btn-small btn-info pull-right" href="{{ URL::to('admin/product/' . $value->id . '/edit') }}">Edit</a>

                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div><!--table-responsive-->
        </div><!-- /.box-body -->
    </div><!--box-->
    
    <div id="barcodePrintSection" class="" style="display: none;">
        
    </div>

    <div class="modal fade" id="barcodeModel" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">        
        <div class="modal-content">

            <div class="modal-header">
                <h4 class="modal-title pull-left" id="exampleModalLabel">Product</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div id="printThis">
                <div class="modal-body">
                    <div class="row">
                        <div class="form-horizontal">

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="inputEmail" class="control-label col-xs-3">Name</label>
                                    <div class="col-xs-9">
                                        <p class="form-control-static modal-name"></p>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="inputEmail" class="control-label col-xs-3">sku</label>
                                    <div class="col-xs-9">
                                        <p class="form-control-static modal-sku"></p>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="inputEmail" class="control-label col-xs-3">Color</label>
                                    <div class="col-xs-9">
                                        <p class="form-control-static modal-color"></p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="inputEmail" class="control-label col-xs-3">Material</label>
                                    <div class="col-xs-9">
                                        <p class="form-control-static modal-material"></p>
                                    </div>
                                </div>
                            </div>
                            <?php /*<div class="col-md-6">
                                <div class="form-group">
                                    <label for="inputEmail" class="control-label col-xs-3">Shape</label>
                                    <div class="col-xs-9">
                                        <p class="form-control-static modal-shape"></p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="inputEmail" class="control-label col-xs-3">Origin</label>
                                    <div class="col-xs-9">
                                        <p class="form-control-static modal-origin"></p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="inputEmail" class="control-label col-xs-3">Style</label>
                                    <div class="col-xs-9">
                                        <p class="form-control-static modal-style"></p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="inputEmail" class="control-label col-xs-3">Dimension</label>
                                    <div class="col-xs-9">
                                        <p class="form-control-static modal-dimension"></p>
                                    </div>
                                </div>
                            </div>*/ ?>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="inputEmail" class="control-label col-xs-3">URL</label>
                                    <div class="col-xs-9">
                                        <p class="form-control-static modal-url"></p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12 text-center">
                                <img class="modal-barcode-image" src="" />
                                <div>
                                <label for="inputEmail" class="control-label col-xs-3 modal-barcode"></label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button id="printButton" type="button" class="btn btn-primary modal-print">Print</button>
          </div>
        </div>
      </div>
    </div>    

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
        $(function() {
            $('#products-table').DataTable({
                dom: 'lfrtip',
                processing: false,
                autoWidth: false,
                "aaSorting": []
            });

            $(document).on("click", ".delete-product-button", function(){
                if (confirm("Are you sure you want to delete?")){
                     $(this).parent('form').submit();
                }
            });

            $(document).on("click", ".barcode-button", function(){

                var productId = $(this).attr("productid");

                $.ajax({
                    url: "<?php echo url('/'); ?>/admin/product/get-barcode-with-details/"+productId,
                    type:'GET',
                    success:function(data) {
                        $(".modal-title").text(data.name);
                        $(".modal-name").text(data.name);
                        $(".modal-sku").text(data.sku);
                        $(".modal-type").text(data.type);
                        $(".modal-material").text(data.material);
                        $(".modal-color").text(data.color);
                        $(".modal-shape").text(data.shape);
                        $(".modal-origin").text(data.origin);
                        $(".modal-barcode-image").attr("src", "data:image/png;base64,"+data.barcode_image);
                        $(".modal-barcode").text(data.barcode);
                        $(".modal-url").text(data.url);
                        $(".modal-style").text(data.style);
                        $(".modal-dimension").text(data.dimension);
                    }
                })

                $("#barcodeModel .modal-title").text("");
                $("#barcodeModel").modal("show");
            });

            document.getElementById("printButton").onclick = function () {
                printElement(document.getElementById("printThis"));
            }

            $(document).on("click", "#generateAllBarcodeBtn", function(e){
                e.preventDefault();
                var productids = [];
                $("#products-table tbody tr").each(function(){
                    productids.push($(this).attr('productid'));
                });

                $.ajax({
                    url: "<?php echo url('/'); ?>/admin/product/get-barcode-multiple",
                    type: "POST",
                    data: {"productids": productids},
                    success: function(data){
                        $("#barcodePrintSection").show();
                        $("#barcodePrintSection").html(data);                        
                        setTimeout(function(){
                           printElement(document.getElementById("barcodePrintSection"));
                            $("#barcodePrintSection").hide();
                        }, 500);                        
                    }
                });

                
            });
        });

        function printElement(elem) {
            var domClone = elem.cloneNode(true);
            
            var $printSection = document.getElementById("printSection");
            
            if (!$printSection) {
                var $printSection = document.createElement("div");
                $printSection.id = "printSection";
                document.body.appendChild($printSection);
            }
            
            $printSection.innerHTML = "";
            $printSection.appendChild(domClone);
            window.print();
        }
    </script>
@endsection
