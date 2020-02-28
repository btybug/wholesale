<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <ul class="sidebar-menu" data-widget="tree">
            {{--<li class="header">MAIN NAVIGATION</li>--}}

            <li><a href="{{route('admin_dashboard')}}"><i class="fas fa-tachometer-alt"></i><span>Dashboard</span></a>
            </li>

            {{--<li><a href="{{route('admin_passport')}}"><i class="fa  fa-user-secret"></i> <span>Passport</span></a></li>--}}
            @hasAccess('media')
            <li class="treeview"><a href="javascript:void(0)"><i class="far fa-images"></i> <span>Media</span>
                    <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="{{route('admin_media')}}"><i class="far fa-circle fa-xs"></i>Drive</a></li>
                    <li><a href="{{route('admin_media','html')}}"><i class="far fa-circle fa-xs"></i>Html</a></li>
                    <li><a href="{{route('admin_media','trash')}}"><i class="far fa-circle fa-xs"></i>Trash</a>
                    </li>
                </ul>
            </li>
            @endHasAccess

            @hasAccess('user')
            <li class="treeview">
                <a href="#">
                    <i class="fas fa-users"></i>
                    <span>Users</span>
                    <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
                </a>
                <ul class="treeview-menu">
                    @ok('admin_staff')
                    <li><a href="{{route('admin_staff')}}"><i class="far fa-circle fa-xs"></i>Staff</a></li>
                    @endok
                    @ok('admin_customers')
                    <li><a href="{{route('admin_customers')}}"><i class="far fa-circle fa-xs"></i>Customers</a></li>
                    @endok

                    @ok('admin_role_membership')
                    <li><a href="{{route('admin_role_membership')}}"><i class="far fa-circle fa-xs"></i>Role/Membership</a>
                    </li>
                    @endok
                    @ok('admin_campaign')
                    <li><a href="{{route('admin_campaign')}}"><i class="far fa-circle fa-xs"></i>Campaign</a>
                    </li>
                    @endok
                </ul>
            </li>
            @endHasAccess

            @hasAccess('inventory')
            <li class="treeview">
                <a href="#">
                    <i class="fas fa-inbox"></i>
                    <span>Inventory</span>
                    <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
                </a>
                <ul class="treeview-menu">
                    @ok('admin_items')
                    <li><a href="{{route('admin_items')}}"><i class="far fa-circle fa-xs"></i>Items</a></li>
                    @endok
                    @ok('admin_warehouses')
                    <li><a href="{{route('admin_warehouses')}}"><i class="far fa-circle fa-xs"></i>Warehouses</a></li>
                    @endok
                    @ok('admin_inventory_purchase')
                    <li><a href="{{route('admin_inventory_purchase')}}"><i class="far fa-circle fa-xs"></i> Purchase</a>
                    </li>
                    @endok
                    @ok('admin_items_transfer')
                    <li><a href="{{route('admin_items_transfer')}}"><i class="far fa-circle fa-xs"></i> Transfer
                            Items</a></li>
                    @endok
                    @ok('admin_suppliers')
                    <li><a href="{{route('admin_suppliers')}}"><i class="far fa-circle fa-xs"></i>Suppliers</a></li>
                    @endok

                    @ok('admin_inventory_barcodes')
                    <li><a href="{{route('admin_inventory_barcodes')}}"><i class="far fa-circle fa-xs"></i>Barcodes</a>
                    </li>
                    @endok
                </ul>
            </li>
            @endHasAccess

            @hasAccess('store')
            <li class="treeview">
                <a href="#">
                    <i class="fas fa-box-open"></i>
                    <span>Store</span>
                    <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
                </a>
                <ul class="treeview-menu">
                    @ok('admin_stock')
                    <li><a href="{{route('admin_stock')}}"><i class="far fa-circle fa-xs"></i>Products</a></li>
                    @endok
                    @ok('admin_orders')
                    <li><a href="{{route('admin_orders')}}"><i class="far fa-circle fa-xs"></i> All orders</a></li>
                    @endok

                    @ok('admin_store_transactions')
                    <li><a href="{{route('admin_store_transactions')}}"><i class="far fa-circle fa-xs"></i> Transactions</a>
                    </li>
                    @endok
                    @ok('admin_store_coupons')
                    <li><a href="{{route('admin_store_coupons')}}"><i class="far fa-circle fa-xs"></i> Coupons</a></li>
                    @endok
                    @ok('admin_stock_promotions')
                    <li><a href="{{route('admin_stock_promotions')}}"><i class="far fa-circle fa-xs"></i>Promotions</a></li>
                    @endok
                </ul>
            </li>
            @endHasAccess

            @hasAccess('front_pages')
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-list-alt"></i>
                    <span>Front pages</span>
                    <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
                </a>
                <ul class="treeview-menu">
                    @ok('admin_blog')
                    <li><a href="{{route('admin_blog')}}"><i class="far fa-circle fa-xs"></i> Posts</a></li>
                    @endok
                    @ok('admin_blog_brands')
                    <li><a href="{{route('admin_blog_brands')}}"><i class="far fa-circle fa-xs"></i> Brands</a></li>
                    @endok
                    @ok('show_comments')
                    <li><a href="{{route('show_comments')}}"><i class="far fa-circle fa-xs"></i>Comments</a></li>
                    @endok
                    @ok('admin_faq')
                    <li><a href="{{route('admin_faq')}}"><i class="far fa-circle fa-xs"></i> FAQ</a></li>
                    @endok
                    @ok('admin_store_attributes')
                    <li><a href="{{route('admin_store_attributes')}}"><i class="far fa-circle fa-xs"></i> Attributes</a>
                    </li>
                    @endok
                    @ok('admin_blog_contact_us')
                    <li><a href="{{route('admin_blog_contact_us')}}"><i class="far fa-circle fa-xs"></i>Contact us</a>
                    </li>
                    @endok
                    @ok('admin_tickets')
                    <li><a href="{{route('admin_tickets')}}"><i class="far fa-circle fa-xs"></i> Tickets</a></li>
                    @endok
                    @ok('admin_reviews')
                    <li><a href="{{route('admin_reviews')}}"><i class="far fa-circle fa-xs"></i> Reviews</a></li>
                    @endok
                    @ok('admin_category')
                    <li><a href="{{route('admin_category')}}"><i class="far fa-circle fa-xs"></i>Category</a></li>
                    @endok
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
                    @ok('admin_seo')
                    <li><a href="{{route('admin_seo')}}"><i class="far fa-circle fa-xs"></i> General</a></li>
                    @endok
                    @ok('admin_seo_bulk')
                    <li><a href="{{route('admin_seo_bulk')}}"><i class="far fa-circle fa-xs"></i> Bulk</a></li>
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
                    @ok('admin_settings_general')
                    <li><a href="{{route('admin_settings_languages')}}"><i class="far fa-circle fa-xs"></i>
                            Languages</a></li>
                    @endok
                    @ok('admin_settings_translations')
                    <li><a href="{{route('admin_settings_translations')}}"><i class="far fa-circle fa-xs"></i>
                            Translations</a></li>
                    @endok
                    @ok('admin_settings_general')
                    <li><a href="{{route('admin_settings_general')}}"><i class="far fa-circle fa-xs"></i> General</a>
                    </li>
                    @endok
                    @ok('admin_settings_store')
                    <li><a href="{{route('admin_settings_store')}}"><i class="far fa-circle fa-xs"></i>Store</a></li>
                    @endok
                    @ok('admin_settings_events')
                    <li><a href="{{route('admin_settings_events')}}"><i class="far fa-circle fa-xs"></i>Events</a></li>
                    @endok
                    @ok('admin_emails_notifications_emails')
                    <li><a href="{{route('admin_emails_notifications_emails')}}"><i class="far fa-circle fa-xs"></i>Emails</a>
                    </li>
                    @endok
                </ul>
            </li>
            @endHasAccess

            {{--            @hasAccess('manage_api')--}}
            {{--            <li class="treeview">--}}
            {{--                <a href="#">--}}
            {{--                    <i class="fa fa-handshake-o"></i>--}}
            {{--                    <span>Manage Api</span>--}}
            {{--                    <span class="pull-right-container">--}}
            {{--              <i class="fa fa-angle-left pull-right"></i>--}}
            {{--            </span>--}}
            {{--                </a>--}}
            {{--                <ul class="treeview-menu">--}}
            {{--                    @ok('admin_manage_api')<li><a href="{{route('admin_manage_api')}}"><i class="fa fa-circle-o"></i>Manage</a></li>@endok--}}
            {{--                    @ok('admin_manage_api_products')--}}
            {{--                    <li><a href="{{route('admin_manage_api_products')}}"><i class="fa fa-circle-o"></i>Products</a></li>--}}
            {{--                    @endok--}}
            {{--                    @ok('admin_manage_api_items')--}}
            {{--                    <li><a href="{{route('admin_manage_api_items')}}"><i class="fa fa-circle-o"></i>Items</a></li>--}}
            {{--                    @endok--}}
            {{--                </ul>--}}

            {{--            </li>--}}
            {{--            @endHasAccess--}}



            @hasAccess('reports')
            <li><a href="{{route('admin_reports')}}"><i class="fa fa-download" aria-hidden="true"></i>
                    <span>Reports</span></a></li>
            @endHasAccess

            @hasAccess('landings')
            <li><a href="{{route('admin_landings')}}"><i class="fa fa-download" aria-hidden="true"></i>
                    <span>Landings</span></a></li>
            @endHasAccess
            {{--            @hasAccess('admin_ebay')--}}
            {{--            <li class="treeview">--}}
            {{--                <a href="#">--}}
            {{--                    <i class="fa fa-handshake-o"></i>--}}
            {{--                    <span>eBay</span>--}}
            {{--                    <span class="pull-right-container">--}}
            {{--              <i class="fa fa-angle-left pull-right"></i>--}}
            {{--            </span>--}}
            {{--                </a>--}}
            {{--                <ul class="treeview-menu">--}}
            {{--                   <li><a href="{{route('admin_ebay')}}"><i class="fa fa-circle-o"></i>Settings</a></li>--}}
            {{--                    <li><a href="{{route('admin_ebay_listing')}}"><i class="fa fa-circle-o"></i>Listing</a></li>--}}
            {{--                    <li><a href="{{route('admin_ebay_orders')}}"><i class="fa fa-circle-o"></i>Orders</a></li>--}}
            {{--                </ul>--}}
            {{--            </li>--}}
            {{--            @endHasAccess--}}
            @ok('admin_app')
            <li class="treeview">
                <a href="#">
                    <i class="far fa-handshake"></i>
                    <span>App</span>
                    <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
                </a>
                <ul class="treeview-menu">
                    @ok('app_customer_discounts')
                    <li><a href="{{route('app_customer_discounts')}}"><i class="far fa-circle fa-xs"></i>Discounts</a>
                    </li>
                    @endok
                    @ok('app_staff')
                    <li><a href="{{route('app_staff')}}"><i class="far fa-circle fa-xs"></i>Staff</a></li>
                    @endok
                    @ok('app_products')
                    <li><a href="{{route('admin_app_products')}}"><i class="far fa-circle fa-xs"></i>Products</a></li>
                    @endok
                    @ok('admin_app_orders')
                    <li><a href="{{route('admin_app_orders')}}"><i class="far fa-circle fa-xs"></i>Orders</a></li>
                    @endok
                    @ok('admin_app_settings')
                    <li><a href="{{route('admin_app_settings')}}"><i class="far fa-circle fa-xs"></i>Settings</a></li>
                    @endok
                </ul>
            </li>
            @endok


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
            @hasAccess('admin_purchases')
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-handshake-o"></i>
                    <span>Purchases</span>
                    <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="{{route('admin_purchases')}}"><i class="fa fa-circle-o"></i>Purchases</a></li>
                </ul>

            </li>
            @endHasAccess
            @hasAccess('admin_passport')
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-handshake-o"></i>
                    <span>Passport</span>
                    <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="{{route('admin_passport')}}"><i class="fa fa-circle-o"></i>Requests</a></li>
                </ul>

            </li>
            @endHasAccess

        </ul>

    </section>
    <!-- /.sidebar -->
    <section>

    </section>
</aside>



