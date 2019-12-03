<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="{{ access()->user()->picture }}" class="img-circle" alt="User Image" />
            </div><!--pull-left-->
            <div class="pull-left info">
                <p>{{ access()->user()->full_name }}</p>
                <!-- Status -->
                <a href="#"><i class="fa fa-circle text-success"></i> {{ trans('strings.backend.general.status.online') }}</a>
            </div><!--pull-left-->
        </div><!--user-panel-->

        <!-- search form (Optional) -->
        {{ Form::open(['route' => 'admin.search.index', 'method' => 'get', 'class' => 'sidebar-form']) }}
        <div class="input-group">
            {{ Form::text('q', Request::get('q'), ['class' => 'form-control', 'required' => 'required', 'placeholder' => trans('strings.backend.general.search_placeholder')]) }}

            <span class="input-group-btn">
                    <button type='submit' id='search-btn' class="btn btn-flat"><i class="fa fa-search"></i></button>
                  </span><!--input-group-btn-->
        </div><!--input-group-->
    {{ Form::close() }}
    <!-- /.search form -->

        <!-- Sidebar Menu -->
        <ul class="sidebar-menu">

            <li class="{{ active_class(Active::checkUriPattern('admin/dashboard')) }}">
                <a href="{{ route('admin.dashboard') }}">
                    <i class="fa fa-dashboard"></i>
                    <span>{{ trans('menus.backend.sidebar.dashboard') }}</span>
                </a>
            </li>

            @if(access()->hasPermission('product-management'))
            <li class="{{ active_class(Active::checkUriPattern('admin/product')) }}">
                <a href="{{ route('admin.product.index') }}">
                    <i class="fa fa-dashboard"></i>
                    <span>Product Management</span>
                </a>
            </li>
            @endif

            @if(access()->hasPermission('price-management'))
            <li class="{{ active_class(Active::checkUriPattern('admin/product')) }}">
                <a href="{{ route('admin.product.price-management') }}">
                    <i class="fa fa-dashboard"></i>
                    <span>Price Management</span>
                </a>
            </li>
            @endif

            @if(access()->hasPermission('inventory-management'))
            <li class="{{ active_class(Active::checkUriPattern('admin/product')) }}">
                <a href="{{ route('admin.product.inventory-management') }}">
                    <i class="fa fa-dashboard"></i>
                    <span>Inventory Management</span>
                </a>
            </li>
            @endif

            @role(1)
            <li class="{{ active_class(Active::checkUriPattern('admin/access/*')) }} treeview">
                <a href="#">
                    <i class="fa fa-users"></i>
                    <span>{{ trans('menus.backend.access.title') }}</span>

                    @if ($pending_approval > 0)
                        <span class="label label-danger pull-right">{{ $pending_approval }}</span>
                    @else
                        <i class="fa fa-angle-left pull-right"></i>
                    @endif
                </a>

                <ul class="treeview-menu {{ active_class(Active::checkUriPattern('admin/access/*'), 'menu-open') }}" style="display: none; {{ active_class(Active::checkUriPattern('admin/access/*'), 'display: block;') }}">
                    <li class="{{ active_class(Active::checkUriPattern('admin/access/user*')) }}">
                        <a href="{{ route('admin.access.user.index') }}">
                            <i class="fa fa-circle-o"></i>
                            <span>{{ trans('labels.backend.access.users.management') }}</span>

                            @if ($pending_approval > 0)
                                <span class="label label-danger pull-right">{{ $pending_approval }}</span>
                            @endif
                        </a>
                    </li>

                    <li class="{{ active_class(Active::checkUriPattern('admin/access/role*')) }}">
                        <a href="{{ route('admin.access.role.index') }}">
                            <i class="fa fa-circle-o"></i>
                            <span>{{ trans('labels.backend.access.roles.management') }}</span>
                        </a>
                    </li>
                </ul>
            </li>
            @endauth

            <li class="{{ active_class(Active::checkUriPattern('admin/log-viewer*')) }} treeview">
                <a href="#">
                    <i class="fa fa-list"></i>
                    <span>{{ trans('menus.backend.log-viewer.main') }}</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu {{ active_class(Active::checkUriPattern('admin/log-viewer*'), 'menu-open') }}" style="display: none; {{ active_class(Active::checkUriPattern('admin/log-viewer*'), 'display: block;') }}">
                    <li class="{{ active_class(Active::checkUriPattern('admin/log-viewer')) }}">
                        <a href="{{ route('log-viewer::dashboard') }}">
                            <i class="fa fa-circle-o"></i>
                            <span>{{ trans('menus.backend.log-viewer.dashboard') }}</span>
                        </a>
                    </li>

                    <li class="{{ active_class(Active::checkUriPattern('admin/log-viewer/logs')) }}">
                        <a href="{{ route('log-viewer::logs.list') }}">
                            <i class="fa fa-circle-o"></i>
                            <span>{{ trans('menus.backend.log-viewer.logs') }}</span>
                        </a>
                    </li>
                </ul>
            </li>
            
            @if(access()->hasPermission('category-management'))
            <li class="{{ active_class(Active::checkUriPattern('admin/categories*')) }}">
                <a href="{{ route('admin.categories.index') }}">
                    <i class="fa fa-commenting"></i>
                    <span>Category Management</span>
                </a>
            </li>
            @endif

            @if(access()->hasPermission('subcategory-management'))
            <li class="{{ active_class(Active::checkUriPattern('admin/subcategories*')) }}">
                <a href="{{ route('admin.subcategories.index') }}">
                    <i class="fa fa-commenting"></i>
                    <span>Collection</span>
                </a>
            </li>
            @endif

            @if(access()->hasPermission('order-management'))
                <li class="{{ active_class(Active::checkUriPattern('admin/orders')) }}">
                    <a href="{{ route('admin.orders.index') }}">
                        <i class="fa fa-delicious"></i>
                        <span>Order Management</span>
                    </a>
                </li>
            @endif

            @if(access()->hasPermission('slide-management'))
            <li class="{{ active_class(Active::checkUriPattern('admin/home-slider')) }}">
                <a href="{{ route('admin.home-slider.index') }}">
                    <i class="fa fa-dashboard"></i>
                    <span>Slide Management</span>
                </a>
            </li>
            @endif

            @if(access()->hasPermission('style-management'))
            <li class="{{ active_class(Active::checkUriPattern('admin/styles')) }}">
                <a href="{{ route('admin.styles.index') }}">
                    <i class="fa fa-adjust"></i>
                    <span>Style Management</span>
                </a>
            </li>
            @endif

            @if(access()->hasPermission('material-management'))
            <li class="{{ active_class(Active::checkUriPattern('admin/materials')) }}">
                <a href="{{ route('admin.materials.index') }}">
                    <i class="fa fa-delicious"></i>
                    <span>Material Management</span>
                </a>
            </li>
            @endif

            @if(access()->hasPermission('weaves-management'))
            <li class="{{ active_class(Active::checkUriPattern('admin/weaves')) }}">
                <a href="{{ route('admin.weaves.index') }}">
                    <i class="fa fa-clone"></i>
                    <span>Weaves Management</span>
                </a>
            </li>
            @endif

            @if(access()->hasPermission('color-management'))
            <li class="{{ active_class(Active::checkUriPattern('admin/colors')) }}">
                <a href="{{ route('admin.colors.index') }}">
                    <i class="fa fa-css3"></i>
                    <span>Color Management</span>
                </a>
            </li>
            @endif

            @if(access()->hasPermission('page-management'))
            <li class="{{ active_class(Active::checkUriPattern('admin/pages')) }}">
                <a href="{{ route('admin.pages.index') }}">
                    <i class="fa fa-file"></i>
                    <span>Page Management</span>
                </a>
            </li>
            @endif

            @if(access()->hasPermission('review-management'))
            <li class="{{ active_class(Active::checkUriPattern('admin/reviews*')) }}">
                <a href="{{ route('admin.reviews.index') }}">
                    <i class="fa fa-star"></i>
                    <span>Review Management</span>
                </a>
            </li>
            @endif

            @if(access()->hasPermission('setting'))
            <li class="{{ active_class(Active::checkUriPattern('admin/settings*')) }}">
                <a href="{{ route('admin.settings.index') }}">
                    <i class="fa fa-dashboard"></i>
                    <span>Settings</span>
                </a>
            </li>
            @endif

            @if(access()->hasPermission('subscription-management'))
            <li class="{{ active_class(Active::checkUriPattern('admin/subscriptions*')) }}">
                <a href="{{ route('admin.subscriptions.index') }}">
                    <i class="fa fa-paper-plane"></i>
                    <span>Subscription Management</span>
                </a>
            </li>
            @endif

            @if(access()->hasPermission('store-management'))
            <li class="{{ active_class(Active::checkUriPattern('admin/stores*')) }}">
                <a href="{{ route('admin.stores.index') }}">
                    <i class="fa fa-home"></i>
                    <span>Store Management</span>
                </a>
            </li>
            @endif

            @if(access()->hasPermission('mailinglists-management'))
            <li class="{{ active_class(Active::checkUriPattern('admin/mailinglists*')) }}">
                <a href="{{ route('admin.mailinglists.index') }}">
                    <i class="fa fa-envelope"></i>
                    <span>Mailing Lists Management</span>
                </a>
            </li>
            @endif

            @if(access()->hasPermission('activity-management'))
            <li class="{{ active_class(Active::checkUriPattern('admin/activities')) }}">
                <a href="{{ route('admin.activities.index') }}">
                    <i class="fa fa-dashboard"></i>
                    <span>Activities of User</span>
                </a>
            </li>
            @endif

            @if(access()->hasPermission('emails-management'))
            <li class="{{ active_class(Active::checkUriPattern('admin/emails*')) }}">
                <a href="{{ route('admin.emails.index') }}">
                    <i class="fa fa-envelope"></i>
                    <span>Promotional Emails</span>
                </a>
            </li>
            @endif

            @if(access()->hasPermission('promos-management'))
            <li class="{{ active_class(Active::checkUriPattern('admin/promos')) }}">
                <a href="{{ route('admin.promos.index') }}">
                    <i class="fa fa-delicious"></i>
                    <span>PromoCode Management</span>
                </a>
            </li>
            @endif

            @if(access()->hasPermission('visitor-management'))
            <li class="{{ active_class(Active::checkUriPattern('admin/visitors')) }}">
                <a href="{{ route('admin.visitors.index') }}">
                    <i class="fa fa-delicious"></i>
                    <span>Visitors List</span>
                </a>
            </li>
            @endif

        </ul><!-- /.sidebar-menu -->
    </section><!-- /.sidebar -->
</aside>