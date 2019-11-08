<div class="pull-right mb-10 hidden-sm hidden-xs">
    <button type="button" id="generateAllBarcodeBtn" href="javascript:void(0);" class="btn btn-warning btn-xs">Generate Barcode for Visible Products</button>
    <a download href="<?php echo e(route('admin.product.export-products')); ?>" class="btn btn-info btn-xs">Export All Product</a>
    <button type="button" class="btn btn-warning btn-xs" data-toggle="modal" data-target="#productUploadModal">Upload Excel</button>
    <?php echo e(link_to_route('admin.product.index', 'All Products', [], ['class' => 'btn btn-primary btn-xs'])); ?>

    <?php echo e(link_to_route('admin.product.create', 'Create Product', [], ['class' => 'btn btn-success btn-xs'])); ?>

</div><!--pull right-->

<div class="pull-right mb-10 hidden-lg hidden-md">
    <div class="btn-group">
        <button type="button" class="btn btn-primary btn-xs dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
            Products <span class="caret"></span>
        </button>

        <ul class="dropdown-menu" role="menu">
            <li><?php echo e(link_to_route('admin.product.index', 'All Products')); ?></li>
            <li><?php echo e(link_to_route('admin.product.create', 'Create Product')); ?></li>
        </ul>
    </div><!--btn group-->
</div><!--pull right-->

<div class="clearfix"></div>

<div class="modal fade" id="productUploadModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <?php echo e(Form::open(array('url' => route('admin.product.upload-sheet'), 'files' => true))); ?>

    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Upload Product</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        
          <div class="form-group">            
            <a download href="<?php echo e(route('admin.product.download-sheet')); ?>">Download Sample file</a>            
          </div>
          <div class="form-group">
            <label for="exampleInputPassword1">File Upload (.csv, .xls)</label>
            <input required type="file" class="form-control" name="file" accept=".csv, application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel">
          </div>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Save changes</button>
      </div>
    </div>
    <?php echo e(Form::close()); ?>

  </div>
</div>
