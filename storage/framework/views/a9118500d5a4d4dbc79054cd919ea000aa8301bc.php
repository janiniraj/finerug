<?php $__env->startSection('page-header'); ?>
    <h1>
        <?php echo e(app_name()); ?>

        <small><?php echo e(trans('strings.backend.dashboard.title')); ?></small>
    </h1>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="box box-success">
        <div class="box-header with-border">
            <h3 class="box-title"><?php echo e(trans('strings.backend.dashboard.welcome')); ?> <?php echo e($logged_in_user->name); ?>!</h3>
            <div class="box-tools pull-right">
                <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
            </div><!-- /.box tools -->
        </div><!-- /.box-header -->
        <div class="box-body">
        </div><!-- /.box-body -->
    </div><!--box box-success-->

    <div class="row">
        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-aqua"><i class="fa fa-eye"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Total Visitors</span>
              <span class="info-box-number"><?php echo e($totalVisitor); ?></span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-red"><i class="fa fa-eye"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Last Week Visitors</span>
              <span class="info-box-number"><?php echo e($lastWeekVisitor); ?></span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->

        <!-- fix for small devices only -->
        <div class="clearfix visible-sm-block"></div>

        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-green"><i class="fa fa-eye"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Most Viewed Country</span>
              <span class="info-box-number"><?php echo e(isset(config('constant.countryCodeList')[$mostViewedCountry]) ? config('constant.countryCodeList')[$mostViewedCountry] : ""); ?></span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-yellow"><i class="fa fa-user"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Currently Viewing</span>
              <span class="info-box-number"><?php echo e($currentUsers); ?></span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
      </div>

    <div class="box box-info">
        <div class="box-header with-border">
            <h3 class="box-title"><?php echo e(trans('history.backend.recent_history')); ?></h3>
            <div class="box-tools pull-right">
                <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
            </div><!-- /.box tools -->
        </div><!-- /.box-header -->
        <div class="box-body">
            <?php echo history()->render(); ?>

        </div><!-- /.box-body -->
    </div><!--box box-success-->
<?php $__env->stopSection(); ?>
<?php echo $__env->make('backend.layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>