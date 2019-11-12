@extends ('backend.layouts.app')

@section ('title', 'Product Management' . ' | ' . 'Create Product')

@section('page-header')
    <h1>
        Product Management
        <small>Create Product</small>
    </h1>
@endsection

@section('content')
    {{ Form::open(['route' => 'admin.product.store', 'class' => 'form-horizontal', 'role' => 'form', 'method' => 'post', 'id' => 'create-role', 'files' => true]) }}

    <div class="box box-success">
        <div class="box-header with-border">
            <h3 class="box-title">Create Product</h3>

        </div><!-- /.box-header -->

        <div class="box-body">
            <div class="form-group">
                {{ Form::label('type', 'Type', ['class' => 'col-lg-2 control-label']) }}
                <div class="col-lg-10">
                    {{ Form::select('type', config('constant.product_types'), null, ['class' => 'form-control', 'required' => 'required']) }}
                </div><!--col-lg-10-->
            </div><!--form control-->
            <div class="form-group">
                {{ Form::label('name', 'Name', ['class' => 'col-lg-2 control-label']) }}

                <div class="col-lg-10">
                    {{ Form::text('name', null, ['class' => 'form-control', 'maxlength' => '191', 'required' => 'required', 'autofocus' => 'autofocus', 'placeholder' => 'Product Name']) }}
                </div><!--col-lg-10-->
            </div><!--form control-->
            <div class="form-group">
                {{ Form::label('sku', 'SKU', ['class' => 'col-lg-2 control-label']) }}

                <div class="col-lg-10">
                    {{ Form::text('sku', null, ['class' => 'form-control', 'maxlength' => '191', 'required' => 'required', 'autofocus' => 'autofocus', 'placeholder' => 'Product SKU', 'id' => 'skuInput']) }}
                </div><!--col-lg-10-->
            </div><!--form control-->
            <div class="form-group">
                {{ Form::label('supplier_sku', 'Supplier SKU', ['class' => 'col-lg-2 control-label']) }}

                <div class="col-lg-10">
                    {{ Form::text('supplier_sku', null, ['class' => 'form-control', 'maxlength' => '191', 'autofocus' => 'autofocus', 'placeholder' => 'Supplier SKU']) }}
                </div><!--col-lg-10-->
            </div><!--form control-->
            <div class="form-group">
                {{ Form::label('brand', 'Brand', ['class' => 'col-lg-2 control-label']) }}

                <div class="col-lg-10">
                    {{ Form::text('brand', null, ['class' => 'form-control', 'maxlength' => '191', 'required' => 'required', 'autofocus' => 'autofocus', 'placeholder' => 'Product Brand']) }}
                </div><!--col-lg-10-->
            </div><!--form control-->
            <div class="form-group">
                {{ Form::label('category_id', 'Category', ['class' => 'col-lg-2 control-label']) }}

                <div class="col-lg-10">
                    {{ Form::select('category_id', $categoryList, null, ['id' => 'category_id', 'class' => 'form-control', 'required' => 'required', 'placeholder' => 'Select Category']) }}
                </div><!--col-lg-10-->
            </div><!--form control-->
            <div class="form-group">
                {{ Form::label('subcategory_id', 'Collection', ['class' => 'col-lg-2 control-label']) }}

                <div class="col-lg-10">
                    {{ Form::select('subcategory_id', [], null, ['id' => 'subcategory_id', 'class' => 'form-control', 'placeholder' => 'Select Collection']) }}
                </div><!--col-lg-10-->
            </div><!--form control-->
            <div class="form-group">
                {{ Form::label('style_id', 'Style', ['class' => 'col-lg-2 control-label']) }}

                <div class="col-lg-10">
                    {{ Form::select('style_id', $styleList, null, ['class' => 'form-control', 'required' => 'required', 'placeholder' => 'Select Style']) }}
                </div><!--col-lg-10-->
            </div><!--form control-->
            <div class="form-group">
                {{ Form::label('material_id', 'Material', ['class' => 'col-lg-2 control-label']) }}

                <div class="col-lg-10">
                    {{ Form::select('material_id', $materialList, null, ['class' => 'form-control', 'required' => 'required', 'placeholder' => 'Select Material']) }}
                </div><!--col-lg-10-->
            </div><!--form control-->
            <div class="form-group">
                {{ Form::label('weave_id', 'Weaves', ['class' => 'col-lg-2 control-label']) }}

                <div class="col-lg-10">
                    {{ Form::select('weave_id', $weaveList, null, ['class' => 'form-control', 'required' => 'required', 'placeholder' => 'Select Weaves']) }}
                </div><!--col-lg-10-->
            </div><!--form control-->

            <div class="color-container">
                <div class="form-group">
                    {{ Form::label('color_id', 'Color', ['class' => 'col-lg-2 control-label']) }}

                    <div class="col-lg-10">
                        <?php /*{{ Form::select('color_id', $colorList, null, ['class' => 'form-control', 'required' => 'required', 'placeholder' => 'Select Color']) }}*/ ?>
                        <select class="form-control color_id" required="required" name="color_id[]">
                            <option selected="selected" value="">Select Color</option>
                            @foreach($colorList as $key => $value)
                                <option value="{{ $key }}" colorvalue="{{ $value }}">{{ $value }}
                                </option>
                            @endforeach
                        </select>
                    </div><!--col-lg-10-->
                </div><!--form control-->
            </div>

            <div class="form-group">
                <div class="col-md-10 col-md-offset-2">
                    <button class="btn btn-success add-color">Add More Color</button>
                </div>
            </div>

            <div class="form-group">
                {{ Form::label('border_color_id', 'Border Color', ['class' => 'col-lg-2 control-label']) }}

                <div class="col-lg-10">
                    <?php /*{{ Form::select('border_color_id', $colorList, null, ['class' => 'form-control', 'required' => 'required', 'placeholder' => 'Not Applicable']) }}*/ ?>
                    <select class="form-control" id="border_color_id" name="border_color_id">
                        <option selected="selected" value="">Not Applicable</option>
                        @foreach($colorList as $key => $value)
                            <option value="{{ $key }}" colorvalue="{{ $value }}">{{ $value }}
                            </option>
                        @endforeach
                    </select>
                </div><!--col-lg-10-->
            </div><!--form control-->
            <div class="form-group">
                {{ Form::label('shape', 'Shape', ['class' => 'col-lg-2 control-label']) }}

                <div class="col-lg-10">
                    {{ Form::select('shape', config('constant.shapes'), null, ['class' => 'form-control', 'required' => 'required', 'placeholder' => 'Select Shape']) }}
                </div><!--col-lg-10-->
            </div><!--form control-->

            <div class="size-container">

                <div class="form-group">
                    {{ Form::label('width', 'Size Width (Feet)', ['class' => 'col-lg-2 control-label']) }}

                    <div class="col-lg-10">
                        {{ Form::number('width[0]', null, ['class' => 'form-control', 'required' => 'required', 'placeholder' => 'Size Width', 'step' => '0.01']) }}
                    </div><!--col-lg-10-->
                </div><!--form control-->

                <div class="form-group">
                    {{ Form::label('length', 'Size Length (Feet)', ['class' => 'col-lg-2 control-label']) }}

                    <div class="col-lg-10">
                        {{ Form::number('length[0]', null, ['class' => 'form-control', 'required' => 'required', 'placeholder' => 'Size Length', 'step' => '0.01']) }}
                    </div><!--col-lg-10-->
                </div><!--form control-->


                <div class="form-group">
                    {{ Form::label('price', 'Cost', ['class' => 'col-lg-2 control-label']) }}

                    <div class="col-lg-10">
                        {{ Form::number('price[0]', null, ['class' => 'form-control', 'required' => 'required', 'placeholder' => 'Cost', 'step' => '0.01']) }}
                    </div><!--col-lg-10-->
                </div><!--form control-->

                <div class="form-group">
                    {{ Form::label('price_affiliate', 'IMAP Price', ['class' => 'col-lg-2 control-label']) }}

                    <div class="col-lg-10">
                        {{ Form::number('price_affiliate[0]', null, ['class' => 'form-control', 'required' => 'required', 'placeholder' => 'IMAP Price', 'step' => '0.01']) }}
                    </div><!--col-lg-10-->
                </div><!--form control-->
                <div class="form-group">
                    {{ Form::label('msrp', 'MSRP Price', ['class' => 'col-lg-2 control-label']) }}

                    <div class="col-lg-10">
                        {{ Form::number('msrp[0]', null, ['class' => 'form-control', 'required' => 'required', 'placeholder' => 'MSRP Price', 'step' => '0.01']) }}
                    </div><!--col-lg-10-->
                </div><!--form control-->
            </div>

            <div class="form-group">
                <div class="col-md-10 col-md-offset-2">
                    <button class="btn btn-success add-size">Add More Size</button>
                </div>
            </div>

            <div class="form-group">
                {{ Form::label('foundation', 'Foundation', ['class' => 'col-lg-2 control-label']) }}

                <div class="col-lg-10">
                    {{ Form::text('foundation', null, ['class' => 'form-control', 'maxlength' => '191', 'required' => 'required','placeholder' => 'Product Foundation']) }}
                </div><!--col-lg-10-->
            </div><!--form control-->

            <div class="form-group">
                {{ Form::label('knote_per_sq', 'Knote Per Sq.', ['class' => 'col-lg-2 control-label']) }}

                <div class="col-lg-10">
                    {{ Form::text('knote_per_sq', null, ['class' => 'form-control', 'maxlength' => '191', 'required' => 'required','placeholder' => 'Knote Per Sq.']) }}
                </div><!--col-lg-10-->
            </div><!--form control-->

            <div class="form-group">
                {{ Form::label('price_per_knot', 'Price Per Sq. Feet', ['class' => 'col-lg-2 control-label']) }}

                <div class="col-lg-10">
                    {{ Form::number('price_per_knot', null, ['class' => 'form-control', 'maxlength' => '191', 'required' => 'required', 'placeholder' => 'Price Per Square Feet']) }}
                </div><!--col-lg-10-->
            </div><!--form control-->

            <div class="form-group">
                {{ Form::label('price_affiliate', 'IMAP', ['class' => 'col-lg-2 control-label']) }}

                <div class="col-lg-10">
                    {{ Form::number('price_affiliate_main', null, ['class' => 'form-control', 'maxlength' => '191', 'required' => 'required', 'placeholder' => 'IMAP']) }}
                </div><!--col-lg-10-->
            </div><!--form control-->
            <div class="form-group">
                {{ Form::label('msrp', 'MSRP', ['class' => 'col-lg-2 control-label']) }}

                <div class="col-lg-10">
                    {{ Form::number('msrp_main', null, ['class' => 'form-control', 'maxlength' => '191', 'required' => 'required', 'placeholder' => 'MSRP']) }}
                </div><!--col-lg-10-->
            </div><!--form control-->

            <div class="form-group">
                {{ Form::label('weight', 'Weight', ['class' => 'col-lg-2 control-label']) }}

                <div class="col-lg-10">
                    {{ Form::number('weight', null, ['class' => 'form-control', 'maxlength' => '191', 'required' => 'required', 'placeholder' => 'Weight']) }}
                </div><!--col-lg-10-->
            </div><!--form control-->

            <div class="form-group">
                {{ Form::label('country_origin', 'Country Of Origin', ['class' => 'col-lg-2 control-label']) }}
                <div class="col-lg-10">
                    {{ Form::select('country_origin', config('constant.countries'), null, ['class' => 'form-control', 'required' => 'required', 'placeholder' => 'Select Country of Origin']) }}
                </div><!--col-lg-10-->
            </div><!--form control-->
            <div class="form-group">
                {{ Form::label('main_image', 'Image', ['class' => 'col-lg-2 control-label']) }}

                <div class="col-lg-10 image-container">
                    <div class="file-input-cloned">
                        <img class="image-display hidden">
                        {{ Form::file('main_image[]', ['id' => 'files', 'class' => 'files', 'required' => 'required', 'accept' => "image/x-png,image/gif,image/jpeg"]) }}
                    </div>
                    <button id="add_more_image" class="btn btn-success margin-top">Add More</button>
                </div><!--col-lg-10-->
            </div><!--form control-->
            <div class="form-group">
                {{ Form::label('detail', 'Details', ['class' => 'col-lg-2 control-label']) }}

                <div class="col-lg-10">
                    {{ Form::textarea('detail', null, ['class' => 'form-control', 'required' => 'required', 'placeholder' => 'Product Detail', 'rows' => 3]) }}
                </div><!--col-lg-10-->
            </div><!--form control-->
            <div class="form-group">
                {{ Form::label('meta_keywords', 'Meta Keywords', ['class' => 'col-lg-2 control-label']) }}

                <div class="col-lg-10">
                    {{ Form::textarea('meta_keywords', null, ['class' => 'form-control', 'required' => 'required', 'placeholder' => 'Meta Keywords', 'rows' => 3]) }}
                </div><!--col-lg-10-->
            </div><!--form control-->
            <div class="form-group">
                {{ Form::label('meta_description', 'Meta Description', ['class' => 'col-lg-2 control-label']) }}

                <div class="col-lg-10">
                    {{ Form::textarea('meta_description', null, ['class' => 'form-control', 'required' => 'required', 'placeholder' => 'Meta Description', 'rows' => 3]) }}
                </div><!--col-lg-10-->
            </div><!--form control-->

            <div class="form-group">
                {{ Form::label('amazon_link', 'Amazon Link', ['class' => 'col-lg-2 control-label']) }}

                <div class="col-lg-10">
                    {{ Form::text('amazon_link', null, ['class' => 'form-control', 'placeholder' => 'Product Amazon Link', 'rows' => 3]) }}
                </div><!--col-lg-10-->
            </div><!--form control-->
            <div class="form-group">
                {{ Form::label('ebay_link', 'Ebay Link', ['class' => 'col-lg-2 control-label']) }}

                <div class="col-lg-10">
                    {{ Form::text('ebay_link', null, ['class' => 'form-control', 'placeholder' => 'Product Ebay Link', 'rows' => 3]) }}
                </div><!--col-lg-10-->
            </div><!--form control-->
            <div class="form-group">
                {{ Form::label('custom_link1', 'Custom Link 1', ['class' => 'col-lg-2 control-label required']) }}

                <div class="col-lg-10">
                    {{ Form::text('custom_link1', isset($shop) && isset($shop['custom_link1']) ? $shop['custom_link1'] : null, ['class' => 'form-control box-size', 'placeholder' => 'Custom Link 1']) }}
                </div><!--col-lg-10-->
            </div><!--form control-->

            <div class="form-group">
                {{ Form::label('custom_logo1', 'Custom Logo 1', ['class' => 'col-lg-2 control-label required']) }}

                <div class="col-lg-10">
                    @if(isset($shop) && isset($shop['custom_logo1']) && $shop['custom_logo1'])
                        <img class="logo-store image-display1" src="<?php echo url('/').'/stores/'.$shop['custom_logo1']; ?>" />
                    @endif
                    {{ Form::file('custom_logo1', $attributes = array('class' => 'image1', 'accept' => "image/x-png,image/gif,image/jpeg")) }}
                </div><!--col-lg-10-->
            </div><!--form control-->

            <div class="form-group">
                {{ Form::label('custom_link2', 'Custom Link 2', ['class' => 'col-lg-2 control-label required']) }}

                <div class="col-lg-10">
                    {{ Form::text('custom_link2', isset($shop) && isset($shop['custom_link2']) ? $shop['custom_link2'] : null, ['class' => 'form-control box-size', 'placeholder' => 'Custom Link 2']) }}
                </div><!--col-lg-10-->
            </div><!--form control-->

            <div class="form-group">
                {{ Form::label('custom_logo2', 'Custom Logo 2', ['class' => 'col-lg-2 control-label required']) }}

                <div class="col-lg-10">
                    @if(isset($shop) && isset($shop['custom_logo2']) && $shop['custom_logo2'])
                        <img class="logo-store image-display2" src="<?php echo url('/').'/stores/'.$shop['custom_logo2']; ?>" />
                    @endif
                    {{ Form::file('custom_logo2', $attributes = array('class' => 'image2', 'accept' => "image/x-png,image/gif,image/jpeg")) }}
                </div><!--col-lg-10-->
            </div><!--form control-->

            <div class="form-group">
                {{ Form::label('age', 'Age', ['class' => 'col-lg-2 control-label']) }}

                <div class="col-lg-10">
                    {{ Form::text('age', null, ['class' => 'form-control', 'placeholder' => 'Age']) }}
                </div><!--col-lg-10-->
            </div><!--form control-->

            <div class="form-group">
                {{ Form::label('design', 'Design Number', ['class' => 'col-lg-2 control-label']) }}

                <div class="col-lg-10">
                    {{ Form::text('design', null, ['class' => 'form-control', 'placeholder' => 'Design']) }}
                </div><!--col-lg-10-->
            </div><!--form control-->

            <div class="form-group">
                {{ Form::label('dimension', 'Dimension', ['class' => 'col-lg-2 control-label']) }}

                <div class="col-lg-10">
                    {{ Form::text('dimension', null, ['class' => 'form-control', 'placeholder' => 'Dimension']) }}
                </div><!--col-lg-10-->
            </div><!--form control-->

			<div class="form-group">
				{{ Form::label('discount', 'Discount %', ['class' => 'col-lg-2 control-label']) }}

				<div class="col-lg-10">
					{{ Form::number('discount', null, ['class' => 'form-control', 'placeholder' => 'Discount in percentage']) }}
				</div><!--col-lg-10-->
			</div><!--form control-->

			<div class="form-group">
				{{ Form::label('clearance', 'Clearance', ['class' => 'col-lg-2 control-label']) }}

				<div class="col-lg-10">
					{{ Form::number('clearance', null, ['class' => 'form-control', 'placeholder' => 'Clearance']) }}
				</div><!--col-lg-10-->
			</div><!--form control-->

            <div class="form-group">
                {{ Form::label('shipping_weight', 'Shipping Weight', ['class' => 'col-lg-2 control-label']) }}

                <div class="col-lg-10">
                    {{ Form::number('shipping_weight', null, ['class' => 'form-control', 'maxlength' => '191', 'required' => 'required', 'placeholder' => 'Price (MAP)']) }}
                </div><!--col-lg-10-->
            </div><!--form control-->

            <div class="form-group">
                {{ Form::label('shipping_width', 'Shipping Width', ['class' => 'col-lg-2 control-label']) }}

                <div class="col-lg-10">
                    {{ Form::number('shipping_width', null, ['class' => 'form-control', 'maxlength' => '191', 'required' => 'required', 'placeholder' => 'Price (MAP)']) }}
                </div><!--col-lg-10-->
            </div><!--form control-->

            <div class="form-group">
                {{ Form::label('shipping_height', 'Shipping Height', ['class' => 'col-lg-2 control-label']) }}

                <div class="col-lg-10">
                    {{ Form::number('shipping_height', null, ['class' => 'form-control', 'maxlength' => '191', 'required' => 'required', 'placeholder' => 'Price (MAP)']) }}
                </div><!--col-lg-10-->
            </div><!--form control-->


            <div class="form-group">
                {{ Form::label('ws_price', 'Wholesale Price', ['class' => 'col-lg-2 control-label']) }}

                <div class="col-lg-10">
                    {{ Form::number('ws_price', null, ['class' => 'form-control', 'maxlength' => '191', 'required' => 'required', 'placeholder' => 'Price (MAP)']) }}
                </div><!--col-lg-10-->
            </div><!--form control-->
            
            <div class="form-group">
                {{ Form::label('status', trans('validation.attributes.backend.categories.is_active'), ['class' => 'col-lg-2 control-label']) }}

                <div class="col-lg-10">
                    <div class="control-group">
                        <label class="control control--checkbox">
                                {{ Form::checkbox('status', 1, true) }}
                            <div class="control__indicator"></div>
                        </label>
                    </div>
                </div><!--col-lg-3-->
            </div>

           


        </div><!-- /.box-body -->
    </div><!--box-->

    <div class="box box-success">
        <div class="box-body">
            <div class="pull-left">
                {{ link_to_route('admin.product.index', trans('buttons.general.cancel'), [], ['class' => 'btn btn-danger btn-xs']) }}
            </div><!--pull-left-->

            <div class="pull-right">
                {{ Form::submit(trans('buttons.general.crud.create'), ['class' => 'btn btn-success btn-xs']) }}
            </div><!--pull-right-->

            <div class="clearfix"></div>
        </div><!-- /.box-body -->
    </div><!--box-->

    {{ Form::close() }}
    <style type="text/css">
        img.logo-store {
            max-height: 50px;
        }
    </style>
@endsection

@section('after-scripts')
    <script>
        $(document).ready(function() {
            $("#add_more_image").on('click', function(e){
                e.preventDefault();
                var html = '<div class="file-input-cloned"> <img class="image-display hidden"><input class="files" required="required" accept="image/x-png,image/gif,image/jpeg" name="main_image[]" type="file"><span class="remove">X</span></div>';
                $(html).insertBefore(this);
            });

            $(document).on('change', ".files", function ()
            {
                var fileInput = $(this);
                var input = this;
                if (input.files && input.files[0]) {
                    var reader = new FileReader();

                    reader.onload = function (e) {
                        fileInput.closest('div').find('.image-display')
                            .attr('src', e.target.result).removeClass('hidden');
                    };

                    reader.readAsDataURL(input.files[0]);
                }
            });
            $(document).on('click', '.remove', function()
            {
                $(this).closest('div').remove();
            });

            $("#category_id").on('change', function (e) {
                var html = '<option selected="selected" value="">Select Collection</option>';
                var categoryId = $(this).val();
                if(categoryId)
                {
                    $.ajax({
                        url: "<?php echo url('/') ?>"+"/admin/subcategories/"+categoryId+"/get",
                        type:'GET',
                        success:function(data) {
                            $.each(data, function (singleKey, singleValue) {
                                html += '<option value="'+singleValue.id+'">'+singleValue.subcategory+'</option>';
                            });
                            $("#subcategory_id").html(html);
                        }
                    });
                }
                else
                {
                    $("#subcategory_id").html(html);
                }
            });
            var closeButtonHtml = "<button class='btn btn-sm btn-warning delete-rule'>X</button>";
            ruleIndex = 0;
            $(".add-size").on('click', function(e){
                e.preventDefault();
                var clonedInput = $('.size-container').eq(0).clone();
                ruleIndex++;
                clonedInput.find('input').each(function() {
                    this.name   = this.name.replace('[0]', '['+ruleIndex+']');
                    this.value  = "";
                });
                if(clonedInput.find('.delete-rule').length == 0)
                {
                    $(clonedInput).append(closeButtonHtml);
                }
                $(clonedInput).insertAfter(".size-container:last");
                //$('.size-container:last').append(closeButtonHtml);
            });

            $(document).on('click', ".delete-rule", function(e){
                e.preventDefault();
                $(this).closest('.size-container').remove();
            });

            var closeColorButtonHtml = "<button class='btn btn-sm btn-warning delete-color'>X</button>";
            colorIndex = 0;

            $(".add-color").on('click', function(e){
                e.preventDefault();
                var clonedInput = $('.color-container').eq(0).clone();
                colorIndex++;
                clonedInput.find('input').each(function() {
                    this.name   = this.name.replace('[0]', '['+colorIndex+']');
                    this.value  = "";
                });
                if(clonedInput.find('.delete-color').length == 0)
                {
                    $(clonedInput).append(closeColorButtonHtml);
                }
                $(clonedInput).insertAfter(".color-container:last");
            });

            $(document).on('click', ".delete-color", function(e){
                e.preventDefault();
                $(this).closest('.color-container').remove();
            });

            $(".color_id option, #border_color_id option").each(function(e){
                var colorValue = $(this).attr('colorvalue');
                if(colorValue !== undefined)
                {
                    var n_match  = ntc.name(colorValue);
                    if(n_match[1].length)
                    {
                        $(this).html(n_match[1]);
                    }
                }
            });

            $(".image1").on('change', function ()
            {
                var input = this;
                if (input.files && input.files[0]) {
                    var reader = new FileReader();

                    reader.onload = function (e) {
                        $('.image-display1')
                            .attr('src', e.target.result).removeClass('hidden');
                    };

                    reader.readAsDataURL(input.files[0]);
                }
            });
            $(".image2").on('change', function ()
            {
                var input = this;
                if (input.files && input.files[0]) {
                    var reader = new FileReader();

                    reader.onload = function (e) {
                        $('.image-display2')
                            .attr('src', e.target.result).removeClass('hidden');
                    };

                    reader.readAsDataURL(input.files[0]);
                }
            });

            getSKU('rug');
            $("#type").on("change", function(e){
                var typeVal = $(this).val();
                getSKU(typeVal);
            });
        });

        function getSKU($type)
        {
            $.ajax({
                url: "<?php echo url('/') ?>"+"/admin/product/get-sku-by-type/"+$type,
                type:'GET',
                success:function(data) {
                    $("#skuInput").val(data);
                }
            });
        }
    </script>
@endsection