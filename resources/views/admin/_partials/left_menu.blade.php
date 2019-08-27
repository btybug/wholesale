<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- Sidebar user panel -->
        {{--<div class="user-panel">--}}
            {{--<div class="pull-left image">--}}
                {{--<img src="{!! url('public/admin_theme/dist/img/user2-160x160.jpg') !!}" class="img-circle"--}}
                     {{--alt="User Image">--}}
            {{--</div>--}}
            {{--<div class="pull-left info">--}}
                {{--<p>Alexander Pierce</p>--}}
                {{--<a href="#"><i class="fa fa-circle text-success"></i> Online</a>--}}
            {{--</div>--}}
        {{--</div>--}}
        <!-- search form -->
        {{--<form action="#" method="get" class="sidebar-form">--}}
            {{--<div class="input-group">--}}
                {{--<input type="text" name="q" class="form-control" placeholder="Search...">--}}
                {{--<span class="input-group-btn">--}}
                {{--<button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>--}}
                {{--</button>--}}
              {{--</span>--}}
            {{--</div>--}}
        {{--</form>--}}
        <!-- /.search form -->
        <ul class="sidebar-menu" data-widget="tree">
            {{--<li class="header">MAIN NAVIGATION</li>--}}

            <li><a href="{{route('admin_dashboard')}}"><i class="fas fa-tachometer-alt"></i><span>Dashboard</span></a></li>

            {{--<li><a href="{{route('admin_passport')}}"><i class="fa  fa-user-secret"></i> <span>Passport</span></a></li>--}}
            @hasAccess('media')
            <li class="treeview"><a href="javascript:void(0)"><i class="fa fa-picture-o"></i> <span>Media</span>
                    <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="{{route('admin_media')}}"><i class="fa fa-circle-o"></i>Drive</a></li>
                    <li><a href="{{route('admin_media','html')}}"><i class="fa fa-circle-o"></i>Html</a></li>
                    <li><a href="{{route('admin_media','trash')}}"><i class="fa fa-circle-o"></i>Trash</a>
                    </li>
                </ul>
            </li>
            @endHasAccess

            @hasAccess('user')
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-group"></i>
                    <span>Users</span>
                    <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
                </a>
                <ul class="treeview-menu">
                    @ok('admin_staff')
                    <li><a href="{{route('admin_staff')}}"><i class="fa fa-circle-o"></i>Staff</a></li>
                    @endok
                    @ok('admin_customers')
                    <li><a href="{{route('admin_customers')}}"><i class="fa fa-circle-o"></i>Customers</a></li>
                    @endok
                    @ok('admin_wholesalers')
                    <li><a href="{{route('admin_wholesalers')}}"><i class="fa fa-circle-o"></i>Wholesalers</a></li>
                    @endok
                    @ok('admin_role_membership')
                    <li><a href="{{route('admin_role_membership')}}"><i class="fa fa-circle-o"></i>Role/Membership</a>
                    </li>
                    @endok
                    @ok('admin_campaign')
                    <li><a href="{{route('admin_campaign')}}"><i class="fa fa-circle-o"></i>Campaign</a>
                    </li>
                    @endok
                </ul>
            </li>
            @endHasAccess

            @hasAccess('inventory')
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-dropbox"></i>
                    <span>Inventory</span>
                    <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
                </a>
                <ul class="treeview-menu">
                    @ok('admin_items')
                    <li><a href="{{route('admin_items')}}"><i class="fa fa-circle-o"></i>Items</a></li>
                    @endok
                    @ok('admin_warehouses')
                    <li><a href="{{route('admin_warehouses')}}"><i class="fa fa-circle-o"></i>Warehouses</a></li>
                    @endok
                    @ok('admin_inventory_purchase')
                    <li><a href="{{route('admin_inventory_purchase')}}"><i class="fa fa-circle-o"></i> Purchase</a></li>
                    @endok
                    @ok('admin_items_transfer')
                    <li><a href="{{route('admin_items_transfer')}}"><i class="fa fa-circle-o"></i> Transfer Items</a></li>
                    @endok
                    @ok('admin_suppliers')
                    <li><a href="{{route('admin_suppliers')}}"><i class="fa fa-circle-o"></i>Suppliers</a></li>
                    @endok

                    @ok('admin_inventory_other')
                    <li><a href="{{route('admin_inventory_other')}}"><i class="fa fa-circle-o"></i>Other</a></li>
                    @endok
                    @ok('admin_inventory_barcodes')
                    <li><a href="{{route('admin_inventory_barcodes')}}"><i class="fa fa-circle-o"></i>Barcodes</a></li>
                    @endok
                </ul>
            </li>
            @endHasAccess

            @hasAccess('store')
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-dropbox"></i>
                    <span>Store</span>
                    <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
                </a>
                <ul class="treeview-menu">
                    @ok('admin_stock')
                    <li><a href="{{route('admin_stock')}}"><i class="fa fa-circle-o"></i>Products</a></li>
                    @endok
                    @ok('admin_orders')
                    <li><a href="{{route('admin_orders')}}"><i class="fa fa-circle-o"></i> All orders</a></li>
                    @endok

                    @ok('admin_store_transactions')
                    <li><a href="{{route('admin_store_transactions')}}"><i class="fa fa-circle-o"></i> Transactions</a></li>
                    @endok
                   @ok('admin_store_coupons') <li><a href="{{route('admin_store_coupons')}}"><i class="fa fa-circle-o"></i> Coupons</a></li>@endok
                   <li><a href="{{route('admin_stock_promotions')}}"><i class="fa fa-circle-o"></i> Promotions</a></li>
                </ul>
            </li>
            @endHasAccess

            @hasAccess('blog')
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-list-alt"></i>
                    <span>Blog</span>
                    <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
                </a>
                <ul class="treeview-menu">
                    @ok('admin_blog')<li><a href="{{route('admin_blog')}}"><i class="fa fa-circle-o"></i> Posts</a></li>@endok
                    @ok('show_comments')<li><a href="{{route('show_comments')}}"><i class="fa fa-circle-o"></i> Comments</a></li>@endok
                    @ok('admin_faq')<li><a href="{{route('admin_faq')}}"><i class="fa fa-circle-o"></i> FAQ</a></li>@endok
                    @ok('admin_blog_contact_us')
                    <li><a href="{{route('admin_blog_contact_us')}}"><i class="fa fa-circle-o"></i>Contact us</a></li>
                    @endok
                    @ok('admin_tickets')<li><a href="{{route('admin_tickets')}}"><i class="fa fa-circle-o"></i> Tickets</a></li>@endok
                </ul>
            </li>
            @endHasAccess

            @hasAccess('seo')
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-list-alt"></i>
                    <span>SEO</span>
                    <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
                </a>
                <ul class="treeview-menu">
                    @ok('admin_seo')<li><a href="{{route('admin_seo')}}"><i class="fa fa-circle-o"></i> General</a></li>@endok
                    @ok('admin_seo_bulk')
                    <li><a href="{{route('admin_seo_bulk')}}"><i class="fa fa-circle-o"></i> Bulk</a></li>
                    @endok
                </ul>
            </li>
            @endHasAccess

            @hasAccess('tools')
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-wrench"></i>
                    <span>Tools</span>
                    <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
                </a>
                <ul class="treeview-menu">
                    @ok('admin_categories_list')
                    <li><a href="{{route('admin_categories_list')}}"><i class="fa fa-circle-o"></i> Categories</a></li>
                    @endok
                    @ok('admin_stock_tags')
                    <li><a href="{{route('admin_stock_tags')}}"><i class="fa fa-circle-o"></i> Tags</a></li>
                    @endok
                    <li><a href="{{route('admin_tools_filters')}}"><i class="fa fa-circle-o"></i>Filters</a></li>
                    @ok('admin_stock_statuses')
                    <li><a href="{{route('admin_stock_statuses')}}"><i class="fa fa-circle-o"></i> Statuses</a></li>
                    @endok
                    @ok('admin_store_attributes')
                    <li><a href="{{route('admin_store_attributes')}}"><i class="fa fa-circle-o"></i> Attributes</a></li>
                    @endok
                    @ok('admin_tools_stickers')
                    <li><a href="{{route('admin_tools_stickers')}}"><i class="fa fa-circle-o"></i> Stickers</a></li>
                    @endok
                </ul>
            </li>
            @endHasAccess

            @hasAccess('emails_notifications')
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-newspaper-o"></i>
                    <span>Emails & Notifications</span>
                    <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
                </a>
                <ul class="treeview-menu">
                    @ok('admin_emails_notifications_emails')
                    <li><a href="{{route('admin_emails_notifications_emails')}}"><i
                                    class="fa fa-circle-o"></i>Emails</a></li>
                    @endok
                    @ok('admin_emails_newsletters')
                        <li><a href="{{route('admin_emails_newsletters')}}"><i
                                    class="fa fa-circle-o"></i>Newsletters</a></li>
                    @endok
                    @ok('admin_emails_notifications_send_email')
                    <li><a href="{{route('admin_emails_notifications_send_email')}}"><i class="fa fa-circle-o"></i>Notifications</a>
                    </li>
                    @endok

                </ul>
            </li>
            @endHasAccess

            @hasAccess('settings')
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-cog"></i>
                    <span>Settings</span>
                    <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
                </a>
                <ul class="treeview-menu">
                    @ok('admin_settings_general') <li><a href="{{route('admin_settings_languages')}}"><i class="fa fa-circle-o"></i> Languages</a></li>@endok
                    @ok('admin_settings_general')
                    <li><a href="{{route('admin_settings_general')}}"><i class="fa fa-circle-o"></i> General</a></li>
                    @endok
                    @ok('admin_settings_store')
                    <li><a href="{{route('admin_settings_store')}}"><i class="fa fa-circle-o"></i>Store</a></li>
                    @endok
                    @ok('admin_settings_events')
                    <li><a href="{{route('admin_settings_events')}}"><i class="fa fa-circle-o"></i>Events</a></li>
                    @endok
                </ul>
            </li>
            @endHasAccess

            @hasAccess('manage_api')
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-handshake-o"></i>
                    <span>Manage Api</span>
                    <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
                </a>
                <ul class="treeview-menu">
                    @ok('admin_manage_api')<li><a href="{{route('admin_manage_api')}}"><i class="fa fa-circle-o"></i>Manage</a></li>@endok
                    @ok('admin_manage_api_products')
                    <li><a href="{{route('admin_manage_api_products')}}"><i class="fa fa-circle-o"></i>Products</a></li>
                    @endok
                    @ok('admin_manage_api_items')
                    <li><a href="{{route('admin_manage_api_items')}}"><i class="fa fa-circle-o"></i>Items</a></li>
                    @endok
                </ul>

            </li>
            @endHasAccess

            @ok('import_index')
            <li><a href="{{route('import_index')}}"><i class="fa fa-download" aria-hidden="true"></i>
                    <span>Import</span></a></li>
            @endok

            @hasAccess('admin_wholesallers')
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-handshake-o"></i>
                    <span>Wholesallers</span>
                    <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
                </a>
                <ul class="treeview-menu">
                   <li><a href="{{route('admin_wholesallers')}}"><i class="fa fa-circle-o"></i>Requests</a></li>
                </ul>

            </li>
            @endHasAccess
        </ul>
    </section>
    <!-- /.sidebar -->
    <section>

    </section>
</aside>
