@extends('frontend.layouts.master')

@section('content')
    <style>
        #custom-search-input{
            padding: 5px;            
            border-radius: 6px;
            background-color: #e7e7e7;
        }

        #custom-search-input input{
            border: 0;
            box-shadow: none;
        }

        #custom-search-input button{
            margin: 2px 0 0 0;
            background: none;
            box-shadow: none;
            border: 0;
            color: #333;
            padding: 0 8px 0 10px;
        }

        #custom-search-input button:hover{
            border: 0;
            box-shadow: none;
            color: #000;
        }

        #custom-search-input .glyphicon-search{
            font-size: 23px;
        }
        .type-container .btn {
            background: #e7e7e7;
        }        
        .different-container {
            background: #e7e7e7;
        }
        .panel-heading .chevron:after {
            content: "\f077";
            cursor: pointer;
        }
        .panel-heading.collapsed .chevron:after {
            content: "\f078"; 
            cursor: pointer;
        }


        /* Separate for this page only */
        #results-page .filters .panel-heading {
            padding: 10px 15px;
        }

        #results-page .filters .panel-default
        {
            border-bottom:none;
        }
        #results-page .panel-body {
            max-height: 300px;
            overflow-y: auto;
        }
        .panel-body input[type="text"] {
            border-radius: 0;
        }
        /* End */

        @media (min-width:1025px) {
            .type-container .btn {
                margin: 0 19px;
            }
        }
    </style>
    <div class="container" id="results-page">
        <div class="section">
            <div class="col-md-12 padding">
                {{ Form::open(['method' => 'GET', 'url' => route('frontend.product.product-by-type')]) }}
                <div id="custom-search-input">
                    <div class="input-group col-md-12">
                        <span class="input-group-btn">
                            <button class="btn btn-info btn-lg" type="submit">
                                <i class="glyphicon glyphicon-search"></i>
                            </button>
                        </span>
                        <input name="search" required type="text" class="form-control input-lg" placeholder="Search..." />
                        
                    </div>
                </div>
                {{ Form::close() }}
            </div>

            {{ Form::open(['method' => 'GET', 'url' => route('frontend.product.product-by-type')]) }}

            <div class="col-md-12 padding type-container">
                <label class="btn btn-default col-md-2 col-xs-12 col-sm-12 col-md-offset-1">
                    <input type="radio" name="type" value="all"> All
                </label>
                <label class="btn btn-default col-md-2 col-xs-12 col-sm-12">
                    <input type="radio" name="type" value="rug"> Rug
                </label>
                <label class="btn btn-default col-md-2 col-xs-12 col-sm-12">
                    <input type="radio" name="type" value="furniture"> Furniture
                </label>
                <label class="btn btn-default col-md-2 col-xs-12 col-sm-12">
                    <input type="radio" name="type" value="lighting"> Lighting
                </label>
                <label class="btn btn-default col-md-2 col-xs-12 col-sm-12">
                    <input type="radio" name="type" value="accessories"> Accessories
                </label>
            </div>
            
            <div class="col-md-12 padding different-container margin">
                
                <div class="col-md-4 filters">
                    
                    <div class="panel panel-default">
                        <input type="hidden" name="country" class="filter-input">
                        <div class="panel-heading" data-toggle="collapse" data-target="#countryItems">
                            <h4 class="panel-title">Country of Origin <i class="chevron fa fa-fw pull-right" ></i></h4>
                        </div>
                        <div class="collapse in" id="countryItems">
                            <div class="panel-body">
                                <ul class="sub-filters">
                                    @foreach(config('constant.countries') as $single)
                                        <li><a class="filter-option {{ isset($filterData['country']) && $filterData['country'] == $single ? 'active' : '' }}" fieldvalue="{{ $single }}" href="javascript:void(0);">{{ $single }}</a></li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>

                    <div class="panel panel-default">
                        <input type="hidden" name="shape" class="filter-input">
                        <div class="panel-heading" data-toggle="collapse" data-target="#shapeItems">
                            <h4 class="panel-title">Shape <i class="chevron fa fa-fw pull-right" ></i></h4>
                        </div>
                        <div class="collapse in" id="shapeItems">
                            <div class="panel-body">
                                <ul class="sub-filters">
                                    @foreach(config('constant.shapes') as $single)
                                        <li><a class="filter-option {{ isset($filterData['shape']) && $filterData['shape'] == $single ? 'active' : '' }}" fieldvalue="{{ $single }}" href="javascript:void(0);">{{ $single }}</a></li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>

                    <div class="panel panel-default">
                        <div class="panel-heading" data-toggle="collapse" data-target="#knotItems">
                            <h4 class="panel-title">Knots per Sq. <i class="chevron fa fa-fw pull-right" ></i></h4>
                        </div>
                        <div class="collapse in" id="knotItems">
                            <div class="panel-body">
                                <input type="text" class="form-control" name="knote_per_sq" placeholder="Knots per Sq.">
                            </div>
                        </div>
                    </div>

                    <div class="panel panel-default">
                        <div class="panel-heading" data-toggle="collapse" data-target="#foundationItems">
                            <h4 class="panel-title">Foundation <i class="chevron fa fa-fw pull-right" ></i></h4>
                        </div>
                        <div class="collapse in" id="foundationItems">
                            <div class="panel-body">
                                <input type="text" class="form-control" name="foundation" placeholder="Foundation">
                            </div>
                        </div>
                    </div>

                </div>

                <div class="col-md-4 filters">
                    
                    <div class="panel panel-default">
                        <input type="hidden" name="category" class="filter-input">
                        <div class="panel-heading" data-toggle="collapse" data-target="#categoriesItems"> 
                            <h4 class="panel-title">Categories<i class="chevron fa fa-fw pull-right" ></i></h4>
                        </div>
                        <div class="collapse in" id="categoriesItems">
                            <div class="panel-body">
                                <ul class="sub-filters">
                                    @foreach($categoryList as $single)
                                        <li><a class="filter-option {{ isset($categoryId) && $categoryId == $single->id ? 'active' : '' }}" fieldvalue="{{ $single->id }}" href="javascript:void(0);">{{ $single->category }}</a></li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>

                    <div class="panel panel-default">
                        <div class="panel-heading" data-toggle="collapse" data-target="#skuItems">
                            <h4 class="panel-title">Item Number <i class="chevron fa fa-fw pull-right" ></i></h4>
                        </div>
                        <div class="collapse in" id="skuItems">
                            <div class="panel-body">
                                <input type="text" class="form-control" name="sku" placeholder="Item Number">
                            </div>
                        </div>
                    </div>

                    <div class="panel panel-default">
                        <input type="hidden" name="style" class="filter-input">
                        <div class="panel-heading" data-toggle="collapse" data-target="#styleItems">
                            <h4 class="panel-title">Styles<i class="chevron fa fa-fw pull-right" ></i></h4>
                        </div>
                        <div class="collapse in" id="styleItems">
                            <div class="panel-body">
                                <ul class="sub-filters">
                                    @foreach($styleList as $single)
                                        <li><a class="filter-option {{ isset($filterData['style']) && $filterData['style'] == $single->id ? 'active' : '' }}" fieldvalue="{{ $single->id }}" href="javascript:void(0);">{{ $single->name }}</a></li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>

                    <div class="panel panel-default">
                        <input type="hidden" name="material" class="filter-input">
                        <div class="panel-heading" data-toggle="collapse" data-target="#materialItems">
                            <h4 class="panel-title">Materials <i class="chevron fa fa-fw pull-right" ></i></h4>
                        </div>
                        <div class="collapse in" id="materialItems">
                            <div class="panel-body">
                                <ul class="sub-filters">
                                    @foreach($materialList as $single)
                                        <li><a class="filter-option {{ isset($filterData['material']) && $filterData['material'] == $single->id ? 'active' : '' }}" fieldvalue="{{ $single->id }}" fieldvalue="{{ $single->id }}" href="javascript:void(0);">{{ $single->name }}</a></li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>

                    <div class="panel panel-default">
                        <input type="hidden" name="weave" class="filter-input">
                        <div class="panel-heading" data-toggle="collapse" data-target="#weaveItems">
                            <h4 class="panel-title">Weaves <i class="chevron fa fa-fw pull-right" ></i></h4>
                        </div>
                        <div class="collapse in" id="weaveItems">
                            <div class="panel-body">
                                <ul class="sub-filters">
                                    @foreach($weaveList as $single)
                                        <li><a class="filter-option {{ isset($filterData['weave']) && $filterData['weave'] == $single->id ? 'active' : '' }}" fieldvalue="{{ $single->id }}" fieldvalue="{{ $single->id }}" href="javascript:void(0);">{{ $single->name }}</a></li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>

                </div>

                <div class="col-md-4 filters">
                    
                    <div class="panel panel-default">
                        <input type="hidden" name="collection" class="filter-input">
                        <div class="panel-heading" data-toggle="collapse" data-target="#collectionItems"> 
                            <h4 class="panel-title">Collections <i class="chevron fa fa-fw pull-right" ></i></h4>
                        </div>
                        <div class="collapse in" id="collectionItems">
                            <div class="panel-body">
                                <ul class="sub-filters">
                                    @foreach($collectionList as $single)
                                        <li><a class="filter-option {{ isset($filterData['collection']) && $filterData['collection'] == $single->id ? 'active' : '' }}" fieldvalue="{{ $single->id }}" href="javascript:void(0);">{{ $single->subcategory }}</a></li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>                    

                    <div class="panel panel-default">
                        <input type="hidden" name="color" class="filter-input">
                        <div class="panel-heading" data-toggle="collapse" data-target="#colorItems">
                            <h4 class="panel-title">Colors <i class="chevron fa fa-fw pull-right" ></i></h4>
                        </div>
                        <div class="collapse in" id="colorItems">
                            <div class="panel-body">
                                <ul class="sub-filters">
                                    @foreach($colorList as $single)
                                        <li>
                                            <a class="filter-option {{ isset($filterData['color']) && $filterData['color'] == $single->id ? 'active' : '' }}" fieldvalue="{{ $single->id }}" fieldvalue="{{ $single->id }}" href="javascript:void(0);">
                                                <span class="color-names" colorvalue="{{ $single->name }}">{{ $single->name }}</span>
                                                <span class="color-btn" style="background-color: {{ $single->name }}"> </span>
                                            </a>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>

                    <div class="panel panel-default">
                        <input type="hidden" name="border_color" class="filter-input">
                        <div class="panel-heading" data-toggle="collapse" data-target="#border_colorItems">
                            <h4 class="panel-title">Border Colors <i class="chevron fa fa-fw pull-right" ></i></h4>
                        </div>
                        <div class="collapse in" id="border_colorItems">
                            <div class="panel-body">
                                <ul class="sub-filters">
                                    @foreach($colorList as $single)
                                        <li>
                                            <a class="filter-option {{ isset($filterData['color']) && $filterData['color'] == $single->id ? 'active' : '' }}" fieldvalue="{{ $single->id }}" fieldvalue="{{ $single->id }}" href="javascript:void(0);">
                                                <span class="color-names" colorvalue="{{ $single->name }}">{{ $single->name }}</span>
                                                <span class="color-btn" style="background-color: {{ $single->name }}"> </span>
                                            </a>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>

                    <div class="panel panel-default">
                        <div class="panel-heading" data-toggle="collapse" data-target="#sizeItems">
                            <h4 class="panel-title">Size <i class="chevron fa fa-fw pull-right" ></i></h4>
                        </div>
                        <div class="collapse in" id="sizeItems">
                            <div class="panel-body">
                                <div class="dimensions padding">
                                    <div class="width">
                                        <label>Width</label>
                                        <div class="checkbox">
                                            <label><input type="radio" name="unit_width" value="feet" checked> Feet</label>
                                            <label><input type="radio" name="unit_width" value="inch"> Inch</label>
                                        </div>
                                        <div class="form-group">
                                            <input type="text" class="form-control" id="min" placeholder="Min" name="width_min">
                                            <input type="text" class="form-control" id="max" placeholder="Max" name="width_max">
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="length">
                                        <label>length</label>
                                        <div class="checkbox">
                                            <label><input type="radio" name="unit_length" value="feet" checked> Feet</label>
                                            <label><input type="radio" name="unit_length" value="inch"> Inch</label>
                                        </div>
                                        <div class="form-group">
                                            <input type="text" class="form-control" id="min" placeholder="Min" name="length_min">
                                            <input type="text" class="form-control" id="max" placeholder="Max" name="length_max">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

                <div class="col-md-12">
                    <a href="{{ route('frontend.product.advance-search') }}" class="btn btn-remove pull-left">Clear Filter</a>
                    <button id="filter_submit" class="btn btn-submit pull-right" type="submit">Submit</button>
                </div>

            </div>
            {{ Form::close() }}
        </div>
    </div><!-- container -->
@endsection

@section('after-scripts')
    <script>
        $(".filter-option").on('click', function (e) {
            $(this).closest('.panel.panel-default').find('.filter-option').each(function(){
                if($(this).hasClass('active'))
                {
                    $(this).removeClass('active');
                }
            });
            $(this).addClass('active');
            var fieldValue = $(this).attr('fieldvalue');
            $(this).closest('.panel.panel-default').find('.filter-input').val(fieldValue);
        });
        $(".color-names").each(function(e){
            var colorValue = $(this).attr('colorvalue');
            var n_match  = ntc.name(colorValue);
            if(n_match[1].length)
            {
                $(this).html(n_match[1]);
            }
        });
    </script>
@endsection