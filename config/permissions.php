<?php
/**
 * Created by PhpStorm.
 * User: sahak
 * Date: 2/13/2019
 * Time: 10:34 AM
 */

return [
    'media' => [
        'media' => [
            'name' => 'Media',
            'routes' => [
                'admin_media'
            ],
            'description' => 'Able to see media',
            'children' => [
                'edit' => [
                    'name' => 'Create Post',
                    'routes' => ['admin_media_settinds', 'post_admin_media_settings'],
                    'description' => '',
                ],
            ],

        ],

    ],
    'user' => [
        'staff' => [
            'name' => 'staff',
            'routes' => ['admin_staff', 'datatable_all_staff'],
            'description' => 'Able to see all staff',
            'children' => [
                'create' => [
                    'name' => 'Create staff member',
                    'routes' => ['admin_staff_new', 'admin_staff_new_post'],
                    'description' => 'Able to Create new member in staff',
                ],
                'edit' => [
                    'name' => 'Edit staff member details',
                    'routes' => ['admin_staff_edit','datatable_user_activity'],
                    'description' => 'Edit staff member details',
                ]
            ]
        ],
        'customers' => [
            'name' => 'Customers',
            'routes' => ['admin_customers', 'datatable_all_users'],
            'description' => 'Able to see all staff',
            'children' => [
                'edit' => [
                    'name' => 'Edit Customer  details',
                    'routes' => ['admin_users_edit','datatable_user_orders'],
                    'description' => 'Edit Customer details',
                ],
            ]
        ],
        'roles_mebership' => [
            'name' => 'Roles/Mebership',
            'routes' => ['admin_role_membership', 'datatable_all_roles'],
            'description' => 'Able to see roles',
            'children' => [

                'create' => [
                    'name' => 'Create role',
                    'routes' => ['admin_create_role', 'post_admin_create_role'],
                    'description' => 'Create Role',
                ],
                'edit' => [
                    'name' => 'Edit roles',
                    'routes' => ['admin_edit_role', 'post_admin_edit_role'],
                    'description' => 'Edit roles',
                ],
            ]
        ],
        'campaign' => [
            'name' => 'User Campaign',
            'routes' => ['admin_campaign', 'datatable_all_campigns'],
            'description' => 'Able to see all staff',
            'children' => [
                'edit' => [
                    'name' => 'Edit campaign  details',
                    'routes' => ['admin_campaign_edit', 'admin_campaign_edit_post'],
                    'description' => 'Edit campaign details',
                ],
                'create' => [
                    'name' => 'Create campaign  details',
                    'routes' => ['admin_campaign_create', 'admin_campaign_create_post'],
                    'description' => 'Create campaign details',
                ],
            ]
        ],
    ],
    'inventory' => [
        'inventory' => [
            'name' => 'Inventory',
            'routes' => ['admin_inventory'],
            'description' => 'Able inventory',
            'children' =>
                [
                    'create' => [
                        'name' => 'Create inventory item',
                        'routes' => ['admin_items_new', 'post_admin_items_new'],
                        'description' => 'Able to Create post',
                    ]
                ],
        ],
        'items' => [
            'name' => 'Items ',
            'routes' => ['admin_items'],
            'description' => 'Able inventory items',
            'children' =>
                [
                    'create' => [
                        'name' => 'Create inventory item',
                        'routes' => ['admin_items_new', 'post_admin_items_new','datatable_all_items','admin_items_purchase','datatable_item_purchases'],
                        'description' => 'Able to Create post',
                    ]
                ],
        ],
        'warehouses' => [
            'name' => 'Warehouses',
            'routes' => ['admin_warehouses','datatable_all_others'],
            'description' => 'Able inventory',
            'children' =>
                [
                    'create' => [
                        'name' => 'Create Warehouses',
                        'routes' => ['admin_warehouses_new', 'admin_warehouses_new_post'],
                        'description' => 'Able to Create Warehouses',
                    ]
                ],
        ],
        'purchase' => [
            'name' => 'Purchase',
            'routes' => ['admin_inventory_purchase','datatable_all_purchases'],
            'description' => 'Able inventory',
            'children' => [
                'create' => [
                    'name' => 'Create Purchase',
                    'routes' => ['admin_inventory_purchase_new', 'admin_inventory_purchase_get_stock_by_sku', 'admin_inventory_purchase_save'],
                    'description' => 'Able to Create Warehouses',
                ],
                'edit' => [
                    'name' => 'Edit Purchase',
                    'routes' => ['admin_inventory_purchase_edit', 'admin_inventory_purchase_get_stock_by_sku', 'admin_inventory_purchase_save'],
                    'description' => 'Able to Create Warehouses',
                ],
                'delete' => [
                    'name' => 'Delete Purchase',
                    'routes' => ['admin_inventory_purchase_delete'],
                    'description' => 'Able to Create Warehouses',
                ]
            ],
        ],
        'suppliers' => [
            'name' => 'Suppliers',
            'routes' => ['admin_suppliers','datatable_all_suppliers'],
            'description' => 'Able inventory',
            'children' => [
                'create' => [
                    'name' => 'Create Suppliers',
                    'routes' => ['admin_suppliers_new', 'post_admin_suppliers', 'post_admin_suppliers_list', 'post_admin_suppliers_sync'],
                    'description' => 'Able to Create suppliers',
                ],
                'edit' => [
                    'name' => 'Edit Purchase',
                    'routes' => ['admin_suppliers_edit', 'post_admin_suppliers_list', 'post_admin_suppliers_sync'],
                    'description' => 'Able to Create Warehouses',
                ],
                'delete' => [
                    'name' => 'Delete suppliers',
                    'routes' => ['post_admin_suppliers_item_delete'],
                    'description' => 'Able to Create suppliers',
                ]
            ],
        ],
        'other' => [
            'name' => 'other',
            'routes' => ['admin_inventory_other'],
            'description' => 'Able to see others',
            'children' => [
                'create' => [
                    'name' => 'Create other',
                    'routes' => ['post_admin_inventory_others_new', 'admin_inventory_others_new'],
                    'description' => 'Able to Create suppliers',
                ],
                'edit' => [
                    'name' => 'Edit other',
                    'routes' => ['admin_inventory_others_new', 'post_admin_inventory_others_new'],
                    'description' => 'Able to Create Warehouses',
                ]
            ],
        ],
    ],
    'store' => [
        'stock' => [
            'name' => 'Stock',
            'routes' => ['admin_stock','datatable_all_stocks'],
            'description' => 'Able to see stock',
            'children' =>
                [
                    'create' => [
                        'name' => 'Create stock item',
                        'routes' => [
                            'admin_stock_new',
                            'admin_stock_save',
                            'admin_stock_link_all',
                            'admin_stock_promotion_edit',
                            'admin_stock_variation_form',
                            'admin_stock_variation_add',
                            'admin_stock_package_variation_add',
                            'admin_stock_variation_add',
                            'admin_stock_variation_get_option',
                            'admin_stock_variation_get_specification',
                            'admin_stock_variation_render_new_option',
                            'admin_stock_get_by_id',
                            'admin_stock_get_variations_by_id',
                            'admin_stock_extra_option',
                            'admin_stock_extra_option_variations',
                            'admin_stock_extra_option_save',
                        ],
                        'description' => 'Able to Create post',
                    ],
                    'edit' => [
                        'name' => 'Create stock item',
                        'routes' => [
                            'admin_stock_edit',
                            'admin_stock_save',
                            'admin_stock_link_all',
                            'admin_stock_promotion_edit',
                            'admin_stock_variation_form',
                            'admin_stock_variation_add',
                            'admin_stock_package_variation_add',
                            'admin_stock_variation_add',
                            'admin_stock_variation_get_option',
                            'admin_stock_variation_get_specification',
                            'admin_stock_variation_render_new_option',
                            'admin_stock_get_by_id',
                            'admin_stock_get_variations_by_id',
                            'admin_stock_extra_option',
                            'admin_stock_extra_option_variations',
                            'admin_stock_extra_option_save',
                        ],
                        'description' => 'Able to Create post',
                    ],
                ],
        ],
        'orders' => [
            'name' => 'Orders',
            'routes' => ['admin_orders','datatable_all_orders'],
            'description' => 'Able to see  Orders',
            'children' =>
                [
                'create' => [
                    'name' => 'Create  Order',
                    'routes' => [
                        'admin_orders_new',
                        'orders_add_note',
                        'orders_get_product',
                        'admin_orders_collecting',
                        'admin_orders_get_user',
                        'admin_orders_add_user',
                        'shop_add_to_cart_orders',
                        'shop_update_cart_orders',
                        'shop_remove_from_cart_orders',
                        'admin_orders_apply_coupon',
                        'admin_orders_apply_customer_notes',
                        'admin_orders_new_cash',
                        'admin_orders_new_cash'
                    ],
                    'description' => 'Able to Create Order',
                ],
                'edit' => [
                    'name' => 'Edit Order',
                    'routes' => [
                        'admin_orders_manage',
                        'orders_add_note',
                        'admin_orders_settings_save',
                        'admin_orders_settings',
                        'orders_get_product',
                        'admin_orders_collecting',
                        'admin_orders_get_user',
                        'admin_orders_add_user',
                        'shop_add_to_cart_orders',
                        'shop_update_cart_orders',
                        'shop_remove_from_cart_orders',
                        'admin_orders_apply_coupon',
                        'admin_orders_apply_customer_notes',
                        'admin_orders_new_cash',
                        'admin_orders_new_cash'
                    ],
                    'description' => 'Edit order',
                ]
            ],
        ],
        'transactions' => [
            'name' => 'Transactions',
            'routes' => ['admin_store_transactions', 'admin_store_transactions_view','datatable_all_transactions'],
            'description' => 'Able to see  Orders',
            'children' => [],
        ],
        'coupons' => [
            'name' => 'Coupons',
            'routes' => ['admin_store_coupons','datatable_all_coupons'],
            'description' => 'Able to see coupons',
            'children' => [

                'create' => [
                    'name' => 'Create  Order',
                    'routes' => [
                        'admin_store_coupons_new',
                        'admin_store_coupons_theme',
                        'admin_store_coupons_save',
                    ],
                    'description' => 'Able to Create Order',
                ],
                'edit' => [
                    'name' => 'Edit coupon',
                    'routes' => [
                        'admin_store_coupons_edit',
                        'admin_store_coupons_save',
                        'admin_store_coupons_theme',
                        'admin_store_coupons_cancel',
                    ],
                    'description' => 'Edit coupon',
                ],
                'delete' => [
                    'name' => 'Delete coupon',
                    'routes' => [
                        'admin_store_coupons_delete',
                    ],
                    'description' => 'Delete coupon',
                ]
            ],
        ],


    ],
    'blog' => [
        'posts' => [
            'name' => 'Posts',
            'routes' => ['admin_blog','datatable_all_posts'],
            'description' => 'Able to see blog page',
            'children' => [
                'create' => [
                    'name' => 'Create Post',
                    'routes' => ['admin_blog_create', 'admin_new_post'],
                    'description' => 'Able to Create post',
                ],
                'edit' => [
                    'name' => 'Edit Post',
                    'routes' => ['admin_post_edit'],
                    'description' => 'Edit any post',
                ],
                'delete' => [
                    'name' => 'Delete Post',
                    'routes' => ['admin_post_delete'],
                    'description' => 'Able to Delete post',
                ],
            ],

        ],
        'comments' => [
            'name' => 'Comments',
            'routes' => ['show_comments','datatable_all_post_comments'],
            'description' => 'Able to see all comments',
            'children' => [
                'edit' => [
                    'name' => 'Edit Post Comment',
                    'routes' => ['approve_comments', 'unapprove_comments', 'edit_comment', 'reply_comment', 'reply_comment_post', 'edit_comment_post'],
                    'description' => 'Approve or cancel pending Comment ',
                ],
                'delete' => [
                    'name' => 'Delete Post comment',
                    'routes' => ['delete_comments'],
                    'description' => 'Delete or edit comment',
                ],
            ],

        ],
        'faq' => [
            'name' => 'faq',
            'routes' => ['admin_faq','datatable_all_faq'],
            'description' => 'Able to see all FAQ',
            'children' => [
                'create' => [
                    'name' => 'Create FAQ',
                    'routes' => ['admin_faq_create', 'admin_faq_new'],
                    'description' => 'Create FAQ',
                ],
                'delete' => [
                    'name' => 'Delete FAQ',
                    'routes' => ['admin_faq_delete'],
                    'description' => 'Delete FAQ',
                ],
                'edit' => [
                    'name' => 'Edit FAQ',
                    'routes' => ['admin_faq_edit', 'admin_faq_new'],
                    'description' => 'Edit FAQ',
                ],
            ],

        ],
        'contact_us' => [
            'name' => 'Contact us',
            'routes' => ['admin_blog_contact_us','datatable_all_contact_us'],
            'description' => 'Able to communicate with guests',
            'children' => [
                'edit' => [
                    'name' => 'Contact us',
                    'routes' => ['admin_blog_contact_us_view','admin_gmail_settings','admin_post_blog_contact_us_replay'],
                    'description' => 'Able to communicate with guests',
                ],
            ],

        ],
        'tickets' => [
            'name' => 'Tickets',
            'routes' => ['admin_tickets','datatable_tickets'],
            'description' => 'Able to see Tickets',
            'children' => [
                'create' => [
                    'name' => 'Create Ticket',
                    'routes' => ['admin_tickets_new', 'admin_tickets_new_save', 'admin_tickets_settings_save', 'admin_tickets_settings'],
                    'description' => 'Able to communicate with guests',
                ],
                'edit' => [
                    'name' => 'Edit Ticket',
                    'routes' => ['admin_tickets_edit', 'admin_tickets_edit_post', 'admin_tickets_reply', 'admin_tickets_close', 'admin_tickets_settings_save', 'admin_tickets_settings'],
                    'description' => 'Able to edit Ticket',
                ],
            ],

        ],
    ],
    'seo' => [
        'general' => [
            'name' => 'General',
            'routes' => ['admin_seo', 'admin_seo_stocks', 'admin_seo_pages'],
            'description' => 'Able to see blog page',
            'children' => [
                'edit' => [
                    'name' => 'Create Post',
                    'routes' => ['post_admin_seo', 'stocks_admin_seo_stocks', 'post_admin_seo_pages'],
                    'description' => 'Able to Create SEO',
                ],
            ],

        ],
        'bulk' => [
            'name' => 'Bulk',
            'routes' => ['admin_seo_bulk', 'admin_seo_bulk_products','datatable_bulk_posts','datatable_bulk_stocks'],
            'description' => 'Able to see bulk',
            'children' => [
                'edit' => [
                    'name' => 'Create Post',
                    'routes' => ['admin_seo_bulk_edit_post', 'post_admin_seo_bulk_edit_post', 'admin_seo_bulk_edit_stock', 'post_admin_seo_bulk_edit_stock'],
                    'description' => 'Able to Create SEO',
                ],
            ],

        ],

    ],
    'tools' => [
        'tools' => [
            'name' => 'Tools',
            'routes' => ['admin_tools'],
            'description' => 'Able to see blog page',
            'children' => [],

        ],
        'categories' => [
            'name' => 'Categories',
            'routes' => ['admin_categories_list', 'admin_store_categories'],
            'description' => 'Able to categories',
            'children' => [
                'create' => [
                    'name' => 'Create category',
                    'routes' => ['admin_store_categories_form', 'admin_store_categories_update_parent', 'admin_store_categories_new_or_update'],
                    'description' => 'Able to Create SEO',
                ],
                'edit' => [
                    'name' => 'Edit category',
                    'routes' => ['admin_store_categories_form', 'admin_store_categories_update_parent', 'admin_store_categories_new_or_update'],
                    'description' => 'Able to Edit category',
                ],
                'delete' => [
                    'name' => 'Delete category',
                    'routes' => ['admin_store_categories_delete'],
                    'description' => 'Able category',
                ],
            ],

        ],
        'tags' => [
            'name' => 'Tags',
            'routes' => ['admin_stock_tags'],
            'description' => 'Able to see tag',
            'children' => [
                'create' => [
                    'name' => 'Create tag',
                    'routes' => ['admin_stock_tags_save'],
                    'description' => 'Able to Create Tag',
                ],
                'delete' => [
                    'name' => 'Delete tag',
                    'routes' => ['admin_stock_tags_delete'],
                    'description' => 'Able tag',
                ],
            ],

        ],
        'statuses' => [
            'name' => 'Statuses',
            'routes' => ['admin_stock_statuses'],
            'description' => 'Able to statuses',
            'children' => [
                'edit' => [
                    'name' => 'Edit Status',
                    'routes' => ['admin_stock_statuses_manage', 'post_admin_stock_statuses_manage', 'post_admin_stock_statuses_manage_form'],
                    'description' => 'Able to Edit status',
                ],
                'delete' => [
                    'name' => 'Delete status',
                    'routes' => ['post_admin_stock_statuses_delete'],
                    'description' => 'Able status',
                ],
            ],

        ],
        'attributes' => [
            'name' => 'Attributes',
            'routes' => ['admin_store_attributes','datatable_all_attributes'],
            'description' => 'Able to see  Attributes',
            'children' => [

                'create' => [
                    'name' => 'Create  Attribute',
                    'routes' => [
                        'admin_store_attributes_new',
                        'admin_store_attributes_options_form',
                        'admin_store_attributes_option_delete',
                        'admin_store_attributes_options',
                        'admin_store_attributes_options_by_id',
                        'admin_store_attributes_options_by_id_autocomplate',
                        'admin_store_attributes_by_id',
                        'admin_store_attributes_all_post',
                        'admin_store_attributes_delete',
                        'admin_store_attributes_variations_table',
                    ],
                    'description' => 'Able to Create Attribute',
                ],
                'edit' => [
                    'name' => 'View inventory item purchases',
                    'routes' => [
                        'admin_store_attributes_edit',
                        'admin_store_attributes_post_edit',
                        'admin_store_attributes_options_form',
                        'admin_store_attributes_option_delete',
                        'admin_store_attributes_options',
                        'admin_store_attributes_options_by_id',
                        'admin_store_attributes_options_by_id_autocomplate',
                        'admin_store_attributes_by_id',
                        'admin_store_attributes_all_post',
                        'admin_store_attributes_delete',
                        'admin_store_attributes_variations_table',
                    ],
                    'description' => 'View orders related to items',
                ]
            ],
        ],
        'stickers' =>
            [
                'name' => 'Statuses',
                'routes' => ['admin_tools_stickers','admin_tools_stickers_manage_form', 'admin_tools_stickers_all_post'],
                'description' => 'Able to see/edit stickers',
                'children' => [
                    'create' => [
                        'name' => 'Create  sticker',
                        'routes' => [
                            'admin_tools_stickers_new_form',
                        ],
                        'description' => 'Able to Create stickers',
                    ],
                    'edit' => [
                        'name' => 'Edit  sticker',
                        'routes' => [
                            'admin_tools_stickers_manage_form',
                            'admin_tools_stickers_manage',
                        ],
                        'description' => 'Able to Edit stickers',
                    ],
                ],

            ],

    ],
    'emails_notifications' => [
        'emails' => [
            'name' => 'Email Templates',
            'routes' => ['admin_emails_notifications_emails','datatable_all_emails'],
            'description' => 'Able to see blog page',
            'children' => [
                'edit' => [
                    'name' => 'Edit Email Template',
                    'routes' => ['admin_mail_create_templates', 'post_admin_mail_create_templates'],
                    'description' => 'Able to Edit status',
                ],
            ],

        ],
        'newsletters' => [
            'name' => 'Newsletters',
            'routes' => ['admin_emails_newsletters','datatable_all_newsletters'],
            'description' => 'Able to see blog page',
            'children' => [
                'delete' => [
                    'name' => 'Delete newsletters',
                    'routes' => ['admin_emails_newsletter_delete'],
                    'description' => 'Delete newsletters',
                ],
            ],

        ],
        'notification' => [
            'name' => 'Notification',
            'routes' => ['admin_emails_notifications_send_email','datatable_all_custom_emails'],
            'description' => 'Notification',
            'children' => [
                'create' => [
                    'name' => 'Create notification',
                    'routes' => [
                        'create_admin_emails_notifications_send_email',
                        'post_create_admin_emails_notifications_send_email',
                        'post_create_send_admin_emails_notifications_send_email',
                        'post_create_send_admin_check_category',
                        'view_admin_emails_notifications_send_email',
                        'admin_emails_notifications_send_now',
                    ],
                    'description' => 'Delete notification',
                ],
                'edit' => [
                    'name' => 'Edit notification',
                    'routes' => [
                        'edit_admin_emails_notifications_send_email',
                        'post_create_admin_emails_notifications_send_email',
                        'post_create_send_admin_emails_notifications_send_email',
                        'post_create_send_admin_check_category',
                        'view_admin_emails_notifications_send_email',
                        'admin_emails_notifications_send_now',
                    ],
                    'description' => 'Delete notification',
                ],
                'delete' => [
                    'name' => 'Delete notification',
                    'routes' => [],
                    'description' => 'Delete notification',
                ],
            ],

        ],

    ],
    'settings' => [
        'general' => [
            'name' => 'Email Templates',
            'routes' => [
                'admin_settings_general',
                'admin_settings_accounts',
                'admin_settings_regions',
                'post_admin_settings_regions',
                'admin_settings_footer',
                'admin_settings_tc',
                'admin_settings_about_us',
            ],
            'description' => 'Able to see blog page',
            'children' => [
                'edit' => [
                    'name' => 'Edit Email Template',
                    'routes' => [
                        'post_admin_settings_save_general',
                        'post_admin_settings_accounts',
                        'post_admin_settings_footer',
                        'post_admin_settings_tc',
                        'post_admin_settings_about_us',
                    ],
                    'description' => 'Able to Edit status',
                ],
            ],

        ],
        'connections' => [
            'name' => 'connections',
            'routes' => [
                'admin_settings_connections',
            ],
            'description' => 'Able to see blog page',
            'children' => [
                'edit' => [
                    'name' => 'Edit Email Template',
                    'routes' => [
                        'post_admin_settings_connections',
                    ],
                    'description' => 'Able edit connections',
                ],
            ],

        ],
        'languages' => [
            'name' => 'Languages',
            'routes' => [
                'admin_settings_languages',
            ],
            'description' => 'Able to see Languages',
            'children' => [
                'edit' => [
                    'name' => 'Edit Language',
                    'routes' => [
                        'admin_settings_language_manager',
                        'admin_settings_language_manager_post',
                        'admin_settings_set_language_default',
                        'admin_settings_languages_edit',
                        'post_admin_settings_get_languages',
                    ],
                    'description' => 'Able edit Languages',
                ], 'create' => [
                    'name' => 'Edit Language',
                    'routes' => [
                        'admin_settings_languages_new',
                        'admin_settings_languages_new_post',
                    ],
                    'description' => 'Able edit Languages',
                ],
            ],

        ],
        'store' => [
            'name' => 'Shipping',
            'routes' => [
                'admin_settings_store',
                'admin_settings_shipping',
                'datatable_all_geo_zones',
                'admin_settings_couriers',
                'admin_settings_store_gifts',
                'admin_settings_tax_rates',
                'admin_settings_payment_gateways',


            ],
            'description' => 'Able to see Languages',
            'children' => [
                'edit' => [
                    'name' => 'Edit Language',
                    'routes' => [
                        'post_admin_settings_store',
                        'post_admin_settings_store_currency_data',
                        'admin_settings_search-find-region',
                        'admin_settings_geo_zones_new',
                        'admin_store_shipping_zone_region_find',
                        'admin_settings_search-payment-options',
                        'admin_settings_geo_zone_save',
                        'admin_settings_courier_edit',
                        'admin_settings_courier_save',
                        'post_admin_couriers_enable',
                        'admin_settings_store_gifts_manage',
                        'post_admin_settings_store_gifts_manage',
                        'admin_settings_delivery',
                        'get_admin_settings_tax_create_or_update',
                        'post_admin_settings_tax_create_or_update',
                        'post_admin_payment_gateways_enable',
                        'admin_payment_gateways_stripe',
                        'post_admin_payment_gateways_stripe',
                        'admin_payment_gateways_cash',
                        'post_admin_payment_gateways_cash',

                    ],
                    'description' => 'Able edit Languages',
                ],
            ],

        ],
        'events' => [
            'name' => 'Events',
            'routes' => [
                'admin_settings_events',
            ],
            'description' => 'Able to see Events',
            'children' => [],

        ],

    ],
    'manage_api' => [
        'manage_api' => [
            'name' => 'Manage Api',
            'routes' => [
                'admin_manage_api'
            ],
            'description' => 'Able to see media',
            'children' => [
                'edit' => [
                    'name' => 'Create Post',
                    'routes' => [
                        'post_admin_manage_api',
                        'post_admin_manage_api_settings',
                    ],
                    'description' => '',
                ],
            ],

        ],
        'products' => [
            'name' => 'Products Api',
            'routes' => [
                'admin_manage_api_all_products','admin_manage_api_products'
            ],
            'description' => 'Able to see media',
            'children' => [
            ],

        ],
        'items' => [
            'name' => 'items Api',
            'routes' => [
                'admin_manage_api_items',
                'admin_manage_api_all_items'
            ],
            'description' => 'Able to see media',
            'children' => [
            ],

        ],

    ],
    'import_index' => [
        'import_index' => [
            'name' => 'Import index',
            'routes' => [

            ],
            'description' => 'Able to see media',
            'children' => [],
        ],

    ],
];
