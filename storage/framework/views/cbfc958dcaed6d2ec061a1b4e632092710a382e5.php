<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="<?php echo e(access()->user()->picture); ?>" class="img-circle" alt="User Image" />
            </div><!--pull-left-->
            <div class="pull-left info">
                <p><?php echo e(access()->user()->full_name); ?></p>
                <!-- Status -->
                <a href="#"><i class="fa fa-circle text-success"></i> <?php echo e(trans('strings.backend.general.status.online')); ?></a>
            </div><!--pull-left-->
        </div><!--user-panel-->

        <!-- search form (Optional) -->
        <?php echo e(Form::open(['route' => 'admin.search.index', 'method' => 'get', 'class' => 'sidebar-form'])); ?>

        <div class="input-group">
            <?php echo e(Form::text('q', Request::get('q'), ['class' => 'form-control', 'required' => 'required', 'placeholder' => trans('strings.backend.general.search_placeholder')])); ?>


            <span class="input-group-btn">
                    <button type='submit' id='search-btn' class="btn btn-flat"><i class="fa fa-search"></i></button>
                  </span><!--input-group-btn-->
        </div><!--input-group-->
    <?php echo e(Form::close()); ?>

    <!-- /.search form -->

        <!-- Sidebar Menu -->
        <ul class="sidebar-menu">

            <li class="<?php echo e(active_class(Active::checkUriPattern('admin/dashboard'))); ?>">
                <a href="<?php echo e(route('admin.dashboard')); ?>">
                    <i class="fa fa-dashboard"></i>
                    <span><?php echo e(trans('menus.backend.sidebar.dashboard')); ?></span>
                </a>
            </li>

            <?php if(access()->hasPermission('product-management')): ?>
            <li class="<?php echo e(active_class(Active::checkUriPattern('admin/product'))); ?>">
                <a href="<?php echo e(route('admin.product.index')); ?>">
                    <i class="fa fa-dashboard"></i>
                    <span>Product Management</span>
                </a>
            </li>
            <?php endif; ?>

            <?php if(access()->hasPermission('price-management')): ?>
            <li class="<?php echo e(active_class(Active::checkUriPattern('admin/product'))); ?>">
                <a href="<?php echo e(route('admin.product.price-management')); ?>">
                    <i class="fa fa-dashboard"></i>
                    <span>Price Management</span>
                </a>
            </li>
            <?php endif; ?>

            <?php if(access()->hasPermission('inventory-management')): ?>
            <li class="<?php echo e(active_class(Active::checkUriPattern('admin/product'))); ?>">
                <a href="<?php echo e(route('admin.product.inventory-management')); ?>">
                    <i class="fa fa-dashboard"></i>
                    <span>Inventory Management</span>
                </a>
            </li>
            <?php endif; ?>

            <?php if (access()->hasRole(1)): ?>
            <li class="<?php echo e(active_class(Active::checkUriPattern('admin/access/*'))); ?> treeview">
                <a href="#">
                    <i class="fa fa-users"></i>
                    <span><?php echo e(trans('menus.backend.access.title')); ?></span>

                    <?php if($pending_approval > 0): ?>
                        <span class="label label-danger pull-right"><?php echo e($pending_approval); ?></span>
                    <?php else: ?>
                        <i class="fa fa-angle-left pull-right"></i>
                    <?php endif; ?>
                </a>

                <ul class="treeview-menu <?php echo e(active_class(Active::checkUriPattern('admin/access/*'), 'menu-open')); ?>" style="display: none; <?php echo e(active_class(Active::checkUriPattern('admin/access/*'), 'display: block;')); ?>">
                    <li class="<?php echo e(active_class(Active::checkUriPattern('admin/access/user*'))); ?>">
                        <a href="<?php echo e(route('admin.access.user.index')); ?>">
                            <i class="fa fa-circle-o"></i>
                            <span><?php echo e(trans('labels.backend.access.users.management')); ?></span>

                            <?php if($pending_approval > 0): ?>
                                <span class="label label-danger pull-right"><?php echo e($pending_approval); ?></span>
                            <?php endif; ?>
                        </a>
                    </li>

                    <li class="<?php echo e(active_class(Active::checkUriPattern('admin/access/role*'))); ?>">
                        <a href="<?php echo e(route('admin.access.role.index')); ?>">
                            <i class="fa fa-circle-o"></i>
                            <span><?php echo e(trans('labels.backend.access.roles.management')); ?></span>
                        </a>
                    </li>
                </ul>
            </li>
            <?php endif; ?>

            <li class="<?php echo e(active_class(Active::checkUriPattern('admin/log-viewer*'))); ?> treeview">
                <a href="#">
                    <i class="fa fa-list"></i>
                    <span><?php echo e(trans('menus.backend.log-viewer.main')); ?></span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu <?php echo e(active_class(Active::checkUriPattern('admin/log-viewer*'), 'menu-open')); ?>" style="display: none; <?php echo e(active_class(Active::checkUriPattern('admin/log-viewer*'), 'display: block;')); ?>">
                    <li class="<?php echo e(active_class(Active::checkUriPattern('admin/log-viewer'))); ?>">
                        <a href="<?php echo e(route('log-viewer::dashboard')); ?>">
                            <i class="fa fa-circle-o"></i>
                            <span><?php echo e(trans('menus.backend.log-viewer.dashboard')); ?></span>
                        </a>
                    </li>

                    <li class="<?php echo e(active_class(Active::checkUriPattern('admin/log-viewer/logs'))); ?>">
                        <a href="<?php echo e(route('log-viewer::logs.list')); ?>">
                            <i class="fa fa-circle-o"></i>
                            <span><?php echo e(trans('menus.backend.log-viewer.logs')); ?></span>
                        </a>
                    </li>
                </ul>
            </li>
            
            <?php if(access()->hasPermission('category-management')): ?>
            <li class="<?php echo e(active_class(Active::checkUriPattern('admin/categories*'))); ?>">
                <a href="<?php echo e(route('admin.categories.index')); ?>">
                    <i class="fa fa-commenting"></i>
                    <span>Category Management</span>
                </a>
            </li>
            <?php endif; ?>

            <?php if(access()->hasPermission('subcategory-management')): ?>
            <li class="<?php echo e(active_class(Active::checkUriPattern('admin/subcategories*'))); ?>">
                <a href="<?php echo e(route('admin.subcategories.index')); ?>">
                    <i class="fa fa-commenting"></i>
                    <span>Collection</span>
                </a>
            </li>
            <?php endif; ?>

            <?php if(access()->hasPermission('slide-management')): ?>
            <li class="<?php echo e(active_class(Active::checkUriPattern('admin/home-slider'))); ?>">
                <a href="<?php echo e(route('admin.home-slider.index')); ?>">
                    <i class="fa fa-dashboard"></i>
                    <span>Slide Management</span>
                </a>
            </li>
            <?php endif; ?>

            <?php if(access()->hasPermission('style-management')): ?>
            <li class="<?php echo e(active_class(Active::checkUriPattern('admin/styles'))); ?>">
                <a href="<?php echo e(route('admin.styles.index')); ?>">
                    <i class="fa fa-adjust"></i>
                    <span>Style Management</span>
                </a>
            </li>
            <?php endif; ?>

            <?php if(access()->hasPermission('material-management')): ?>
            <li class="<?php echo e(active_class(Active::checkUriPattern('admin/materials'))); ?>">
                <a href="<?php echo e(route('admin.materials.index')); ?>">
                    <i class="fa fa-delicious"></i>
                    <span>Material Management</span>
                </a>
            </li>
            <?php endif; ?>

            <?php if(access()->hasPermission('weaves-management')): ?>
            <li class="<?php echo e(active_class(Active::checkUriPattern('admin/weaves'))); ?>">
                <a href="<?php echo e(route('admin.weaves.index')); ?>">
                    <i class="fa fa-clone"></i>
                    <span>Weaves Management</span>
                </a>
            </li>
            <?php endif; ?>

            <?php if(access()->hasPermission('color-management')): ?>
            <li class="<?php echo e(active_class(Active::checkUriPattern('admin/colors'))); ?>">
                <a href="<?php echo e(route('admin.colors.index')); ?>">
                    <i class="fa fa-css3"></i>
                    <span>Color Management</span>
                </a>
            </li>
            <?php endif; ?>

            <?php if(access()->hasPermission('page-management')): ?>
            <li class="<?php echo e(active_class(Active::checkUriPattern('admin/pages'))); ?>">
                <a href="<?php echo e(route('admin.pages.index')); ?>">
                    <i class="fa fa-file"></i>
                    <span>Page Management</span>
                </a>
            </li>
            <?php endif; ?>

            <?php if(access()->hasPermission('review-management')): ?>
            <li class="<?php echo e(active_class(Active::checkUriPattern('admin/reviews*'))); ?>">
                <a href="<?php echo e(route('admin.reviews.index')); ?>">
                    <i class="fa fa-star"></i>
                    <span>Review Management</span>
                </a>
            </li>
            <?php endif; ?>

            <?php if(access()->hasPermission('setting')): ?>
            <li class="<?php echo e(active_class(Active::checkUriPattern('admin/settings*'))); ?>">
                <a href="<?php echo e(route('admin.settings.index')); ?>">
                    <i class="fa fa-dashboard"></i>
                    <span>Settings</span>
                </a>
            </li>
            <?php endif; ?>

            <?php if(access()->hasPermission('subscription-management')): ?>
            <li class="<?php echo e(active_class(Active::checkUriPattern('admin/subscriptions*'))); ?>">
                <a href="<?php echo e(route('admin.subscriptions.index')); ?>">
                    <i class="fa fa-paper-plane"></i>
                    <span>Subscription Management</span>
                </a>
            </li>
            <?php endif; ?>

            <?php if(access()->hasPermission('store-management')): ?>
            <li class="<?php echo e(active_class(Active::checkUriPattern('admin/stores*'))); ?>">
                <a href="<?php echo e(route('admin.stores.index')); ?>">
                    <i class="fa fa-home"></i>
                    <span>Store Management</span>
                </a>
            </li>
            <?php endif; ?>

            <?php if(access()->hasPermission('mailinglists-management')): ?>
            <li class="<?php echo e(active_class(Active::checkUriPattern('admin/mailinglists*'))); ?>">
                <a href="<?php echo e(route('admin.mailinglists.index')); ?>">
                    <i class="fa fa-envelope"></i>
                    <span>Mailing Lists Management</span>
                </a>
            </li>
            <?php endif; ?>

            <?php if(access()->hasPermission('activity-management')): ?>
            <li class="<?php echo e(active_class(Active::checkUriPattern('admin/activities'))); ?>">
                <a href="<?php echo e(route('admin.activities.index')); ?>">
                    <i class="fa fa-dashboard"></i>
                    <span>Activities of User</span>
                </a>
            </li>
            <?php endif; ?>

            <?php if(access()->hasPermission('emails-management')): ?>
            <li class="<?php echo e(active_class(Active::checkUriPattern('admin/emails*'))); ?>">
                <a href="<?php echo e(route('admin.emails.index')); ?>">
                    <i class="fa fa-envelope"></i>
                    <span>Promotional Emails</span>
                </a>
            </li>
            <?php endif; ?>

            <?php if(access()->hasPermission('promos-management')): ?>
            <li class="<?php echo e(active_class(Active::checkUriPattern('admin/promos'))); ?>">
                <a href="<?php echo e(route('admin.promos.index')); ?>">
                    <i class="fa fa-delicious"></i>
                    <span>PromoCode Management</span>
                </a>
            </li>
            <?php endif; ?>

            <?php if(access()->hasPermission('visitor-management')): ?>
            <li class="<?php echo e(active_class(Active::checkUriPattern('admin/visitors'))); ?>">
                <a href="<?php echo e(route('admin.visitors.index')); ?>">
                    <i class="fa fa-delicious"></i>
                    <span>Visitors List</span>
                </a>
            </li>
            <?php endif; ?>

        </ul><!-- /.sidebar-menu -->
    </section><!-- /.sidebar -->
</aside>