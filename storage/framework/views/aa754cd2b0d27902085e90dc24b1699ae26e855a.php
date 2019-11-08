
    <div class="form-group">
        <?php echo e(Form::label('subcategory', trans('validation.attributes.backend.subcategories.title'), ['class' => 'col-lg-2 control-label required'])); ?>


        <div class="col-lg-10">
            <?php echo e(Form::text('subcategory', null, ['class' => 'form-control box-size', 'placeholder' => trans('validation.attributes.backend.subcategories.title'), 'required' => 'required'])); ?>

        </div><!--col-lg-10-->
    </div><!--form control-->

    <div class="form-group">
        <?php echo e(Form::label('category_id', trans('validation.attributes.backend.subcategories.category'), ['class' => 'col-lg-2 control-label required'])); ?>


        <div class="col-lg-10">
            <?php echo e(Form::select('category_id', $categoryName, null, ['class' => 'form-control select2', 'placeholder' => trans('validation.attributes.backend.subcategories.category'), 'required' => 'required'])); ?>

        </div><!--col-lg-10-->
    </div><!--form control-->

    <div class="form-group">
        <?php echo e(Form::label('icon', 'Icon', ['class' => 'col-lg-2 control-label required'])); ?>


        <div class="col-lg-10">
            <?php if(isset($subcategory) && $subcategory->icon): ?>
            <img src="<?php echo e(URL::to('/').'/img/subcategory/'.$subcategory->icon); ?>" style="max-height: 100px;">
            <?php endif; ?>
            <?php echo e(Form::file('icon', $attributes = array('accept' => "image/x-png,image/gif,image/jpeg"))); ?>

        </div><!--col-lg-10-->
    </div><!--form control-->

    <div class="form-group">
        <?php echo e(Form::label('image', 'Main Image', ['class' => 'col-lg-2 control-label required'])); ?>


        <div class="col-lg-10">
            <?php if(isset($subcategory) && $subcategory->image): ?>
            <img src="<?php echo e(URL::to('/').'/img/subcategory/'.$subcategory->image); ?>" style="max-height: 100px;">
            <?php endif; ?>
            <?php echo e(Form::file('image', $attributes = array('accept' => "image/x-png,image/gif,image/jpeg"))); ?>

        </div><!--col-lg-10-->
    </div><!--form control-->


    <div class="form-group">
        <?php echo e(Form::label('status', trans('validation.attributes.backend.subcategories.is_active'), ['class' => 'col-lg-2 control-label'])); ?>


        <div class="col-lg-10">
            <div class="control-group">
                <label class="control control--checkbox">
                        <?php if(isset($subcategory->status) && !empty ($subcategory->status)): ?>
                            <?php echo e(Form::checkbox('status', 1, true)); ?>

                        <?php else: ?>
                            <?php echo e(Form::checkbox('status', 1, false)); ?>

                        <?php endif; ?>
                    <div class="control__indicator"></div>
                </label>
            </div>
        </div><!--col-lg-3-->
    </div>
