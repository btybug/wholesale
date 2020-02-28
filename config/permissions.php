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
                'admin_media',
            ],
            'description' => 'Able to see media',
            'children' => [
                'create' => [
                    'name' => 'Create media',
                    'routes' => [
                        'media_upload',
                        'media_create_folder',
                        'media_copy_item',
                    ],
                    'description' => '',
                ],
                'edit' => [
                    'name' => 'edit media',
                    'routes' => [
                        'admin_media_settinds',
                        'post_admin_media_settings',
                        'media_upload',
                        'media_rename_item',
                        'media_sort_folder',
                        'media_edit_folder',
                        'media_transfer_item',
                        'media_edit_folder_settings',
                        'media_get_uploader_settings',
                    ],
                    'description' => '',
                ],
                'delete' => [
                    'name' => 'Delete',
                    'routes' => ['media_remove_folder','media_remove_item','media_empty_trash'],
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
                    'routes' => ['admin_staff_edit','post_admin_staff_edit','datatable_user_activity','datatable_user_activity','change.password','post_admin_users_reset_pass'],
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
                    'routes' => [
                        'admin_users_edit',
                        'datatable_user_orders',
                        'admin_users_reject',
                        'admin_users_approve',
                        'post_admin_users_edit',
                    ],
                    'description' => 'Edit Customer details',
                ],
                'delete' => [
                    'name' => 'Delete Customer',
                    'routes' => [
                        'admin_users_delete'
                    ],
                    'description' => 'Delete Customer',
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
                    'routes' => ['admin_campaign_create', 'admin_campaign_create_post','datatable_all_channel_customers','admin_search'],
                    'description' => 'Create campaign details',
                ],
                'delete' => [
                    'name' => 'delete campaign ',
                    'routes' => ['admin_campaign_delete'],
                    'description' => 'delete campaign',
                ],
            ]
        ],
        'activity' => [
            'name' => 'User Activity',
            'routes' => ['admin_users_activity','admin_tools_logs','admin_tools_logs_backend'],
            'description' => 'Able to see all user activity logs',
            'children' => [

            ]
        ],
    ],
    'inventory' => [
        'items' => [
            'name' => 'Items ',
            'routes' => [
                'admin_items',
                'admin_items_archives',
                'datatable_all_items',
                'datatable_all_items_in_modal',
                'datatable_all_items_archive',
                'find_items_barcodes',
                'find_items_qrcodes',
            ],
            'description' => 'Able inventory items',
            'children' =>
                [

                    'create' => [
                        'name' => 'Create inventory item',
                        'routes' => [
                            'admin_items_new',
                            'post_admin_items_new',
                            'admin_items_purchase',
                        ],
                        'description' => 'Able to Create post',
                    ],
                    'edit' => [
                        'name' => 'Edit inventory item',
                        'routes' => [
                            'admin_items_edit',
                            'post_admin_items_edit_row_save',
                            'post_admin_items_edit_row_many_save',
                            'post_admin_items_edit_row_many',
                            'post_admin_items_edit_row',
                            'post_admin_suppliers_list',
                            'admin_items_download_code',
                            'admin_stock_specif_by_category',
                            'admin_items_get_specification_by_category',
                            'post_admin_items_new',
                            'admin_items_download_html'
                        ],
                        'description' => 'Able to Create post',
                    ],
                    'delete' => [
                        'name' => 'Create inventory item',
                        'routes' => ['admin_items_archive','post_admin_items_multi_delete'],
                        'description' => 'Able to archive item',
                    ],
                ],
        ],
        'warehouses' => [
            'name' => 'Warehouses',
            'routes' => ['admin_warehouses','datatable_all_warehouses'],
            'description' => 'Able inventory',
            'children' =>
                [
                    'create' => [
                        'name' => 'Create Warehouses',
                        'routes' => ['admin_warehouses_new', 'admin_warehouses_save'],
                        'description' => 'Able to Create Warehouses',
                    ],
                    'edit' => [
                        'name' => 'Edit Warehouses',
                        'routes' => [
                            'admin_warehouses_edit',
                            'admin_warehouses_manage',
                            'admin_warehouses_categories_form',
                            'admin_warehouses_save',
                            'admin_warehouses_categories_new_or_update',
                            'admin_warehouses_categories_update_parent',

                        ],
                        'description' => 'Able to edit Warehouses',
                    ],
                    'delete' => [
                        'name' => 'Delete Warehouses',
                        'routes' => ['admin_warehouses_delete','admin_warehouses_categories_delete'],
                        'description' => 'Able to delete Warehouses',
                    ],
                ],
        ],
        'purchase' => [
            'name' => 'Purchase',
            'routes' => ['admin_inventory_purchase','admin_items_purchase','datatable_all_purchases'],
            'description' => 'Able inventory',
            'children' => [
                'create' => [
                    'name' => 'Create Purchase',
                    'routes' => ['admin_inventory_purchase_new', 'admin_inventory_purchase_get_stock_by_sku', 'admin_inventory_purchase_save','admin_item_locations'],
                    'description' => 'Able to Create purchase',
                ],
                'edit' => [
                    'name' => 'Edit Purchase',
                    'routes' => [
                        'admin_inventory_purchase_edit',
                        'admin_inventory_purchase_get_stock_by_sku',
                        'admin_inventory_purchase_save',
                        'admin_item_locations'
                    ],
                    'description' => 'Able to edit purchase',
                ],
                'delete' => [
                    'name' => 'Delete Purchase',
                    'routes' => ['admin_inventory_purchase_delete'],
                    'description' => 'Able to delete purchase',
                ]
            ],
        ],
        'transfer' => [
            'name' => 'Transfer items',
            'routes' => ['admin_items_transfer','datatable_all_transfers'],
            'description' => 'Able to see transfers',
            'children' => [
                'create' => [
                    'name' => 'Able to make  transfer',
                    'routes' => ['admin_items_new_transfer', 'admin_transfer_post','admin_items_transfer_locations'],
                    'description' => 'Able to Create suppliers',
                ]
            ],
        ],
        'suppliers' => [
            'name' => 'Suppliers',
            'routes' => ['admin_suppliers','datatable_all_suppliers'],
            'description' => 'Able to see suppliers',
            'children' => [
                'create' => [
                    'name' => 'Create Suppliers',
                    'routes' => ['admin_suppliers_new', 'post_admin_suppliers', 'post_admin_suppliers_list', 'post_admin_suppliers_sync'],
                    'description' => 'Able to Create suppliers',
                ],
                'edit' => [
                    'name' => 'Edit Purchase',
                    'routes' => ['admin_suppliers_edit', 'post_admin_suppliers_list', 'post_admin_suppliers_sync','post_admin_suppliers'],
                    'description' => 'Able to edit suppliers',
                ],
                'delete' => [
                    'name' => 'Delete suppliers',
                    'routes' => ['post_admin_suppliers_item_delete'],
                    'description' => 'Able to delete suppliers',
                ]
            ],
        ],
        'other' => [
            'name' => 'other',
            'routes' => ['admin_inventory_other','datatable_all_others'],
            'description' => 'Able to see others',
            'children' => [
                'create' => [
                    'name' => 'Create other',
                    'routes' => ['post_admin_inventory_others_new', 'admin_inventory_others_new'],
                    'description' => 'Able to Create other',
                ],
                'edit' => [
                    'name' => 'Edit other',
                    'routes' => ['admin_inventory_others_edit', 'post_admin_inventory_others_new'],
                    'description' => 'Able to edit other',
                ]
            ],
        ],
        'barcodes' => [
            'name' => 'Barcodes',
            'routes' => ['admin_inventory_barcodes','datatable_all_barcodes','admin_inventory_barcode_view'],
            'description' => 'Able to see Barcodes',
            'children' => [
                'create' => [
                    'name' => 'Create barcode',
                    'routes' => ['admin_inventory_barcodes_new', 'post_admin_inventory_barcodes_new'],
                    'description' => 'Able to Create barcode',
                ],
                'edit' => [
                    'name' => 'Edit barcode',
                    'routes' => [
                        'admin_inventory_barcodes_settings',
                    ],
                    'description' => 'Able to edit barcode',
                ],
                'delete' => [
                    'name' => 'Delete barcode',
                    'routes' => ['admin_inventory_barcode_delete'],
                    'description' => 'Able to delete barcode',
                ]
            ],
        ],
    ],
    'store' => [
        'stock' => [
            'name' => 'Products',
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
                            'admin_stock_variation_edit',
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
                    'delete' => [
                        'name' => 'Delete Stock',
                        'routes' => ['admin_stock_delete'],
                        'description' => 'Able to delete Stock',
                    ]
                ],
        ],
        'offers' => [
            'name' => 'offers',
            'routes' => ['admin_stock_offers','datatable_all_stocks_offers'],
            'description' => 'Able to see offers',
            'children' => [
                'create' => [
                    'name' => 'Create offer',
                    'routes' => ['admin_stock_edit_offer'],
                    'description' => 'Able ',
                ],
                'edit' => [
                    'name' => 'Edit ',
                    'routes' => ['admin_stock_new_offer'],
                    'description' => 'Able to Edit status',
                ],

            ],

        ],
        'orders' => [
            'name' => 'All Orders',
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
                        'admin_orders_new_stripe',
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
                        'admin_orders_new_stripe'
                    ],
                    'description' => 'Edit order',
                ]
            ],
        ],
        'invoices' => [
            'name' => 'All Invoices',
            'routes' => ['admin_orders_invoice','datatable_all_orders_invoice'],
            'description' => 'Able to see  Orders',
            'children' =>
                [
                    'edit' => [
                        'name' => 'Edit ',
                        'routes' => [
                            'admin_stock_new_offer',
                            'admin_orders_invoice_edit_post',
                            'admin_orders_invoice_add_note',
                            'admin_orders_invoice_settings',
                            'admin_orders_invoice_settings_save',
                            'admin_orders_invoice_get_product',
                            'admin_orders_invoice_collecting',
                            'admin_orders_invoice_items_by_id',
                            'admin_orders_invoice_get_user',
                            'admin_orders_invoice_add_user',
                            'shop_add_to_cart_admin_orders_invoice',
                            'shop_update_cart_admin_orders_invoice',
                            'shop_remove_from_cart_admin_orders_invoice',
                            'admin_orders_invoice_apply_coupon',
                            'admin_orders_invoice_apply_customer_notes',
                            'admin_orders_invoice_new_cash',
                            'admin_orders_invoice_new_cash',
                        ],
                        'description' => 'Able to Edit status',
                    ],
                    'create' => [
                        'name' => 'Create invoice',
                        'routes' => ['admin_orders_invoice_new'],
                        'description' => 'Able ',
                    ],
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
        'promotions' => [
            'name' => 'Promotions',
            'routes' => ['admin_stock_promotions','datatable_all_promotions'],
            'description' => 'Able to see promotions',
            'children' => [

                'create' => [
                    'name' => 'Create  promotion',
                    'routes' => [
                        'admin_stock_promotions_new',
                        'admin_stock_sales_save',
                    ],
                    'description' => 'Able to Create promotion',
                ]
            ],
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

    ],

    'front_pages' => [
        'posts' => [
            'name' => 'Front Posts',
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
                    'routes' => ['admin_post_edit','admin_inventary_get_stocks'],
                    'description' => 'Edit any post',
                ],
                'delete' => [
                    'name' => 'Delete Post',
                    'routes' => ['admin_post_delete'],
                    'description' => 'Able to Delete post',
                ],
            ],

        ],
        'brands' => [
            'name' => 'Brands',
            'routes' => ['admin_blog_brands','datatable_all_brands'],
            'description' => 'Able to see Brands page',
            'children' => [
                'create' => [
                    'name' => 'Edit Post Comment',
                    'routes' => ['admin_blog_brands_create', 'admin_blog_brands_create_or_edit'],
                    'description' => 'Approve or cancel pending Comment ',
                ],
                'edit' => [
                    'name' => 'Edit brand',
                    'routes' => ['admin_blog_brands_edit', 'admin_blog_brands_create_or_edit','admin_blog_brands_fix'],
                    'description' => 'Edit brand',
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
                    'routes' => ['approve_comments','admin_blog_comments_settings','admin_blog_comments_settings_post','unapprove_comments', 'edit_comment', 'reply_comment', 'reply_comment_post', 'edit_comment_post'],
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
                        'admin_store_attributes_variations_table',
                        'admin_tools_stickers_all_post'
                    ],
                    'description' => 'View orders related to items',
                ],'delete' => [
                    'name' => 'View inventory item purchases',
                    'routes' => [
                        'admin_store_attributes_delete'
                    ],
                    'description' => 'delete',
                ]
            ],
        ],
        'stickers' => [
            'name' => 'Stickers',
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
        'reviews' => [
            'name' => 'Reviews',
            'routes' => ['admin_reviews','datatable_reviews'],
            'description' => 'Able to see Tickets',
            'children' => [
                'edit'=>[
                    'name' => 'Edit reviews',
                    'routes' => ['admin_users_approve_review', 'admin_users_disable_review','admin_users_allow_edit_review'],
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
    'reports' => [
        'reports' => [
            'name' => 'Reports',
            'routes' => [
                'admin_reports'
            ],
            'description' => 'Able to see reports',
            'children' => [
                'create' => [
                    'name' => 'Create reports',
                    'routes' => ['admin_reports_new'],
                    'description' => 'Able to Edit status',
                ],
            ],

        ]

    ],
    'landings' => [
        'landings' => [
            'name' => 'Landings',
            'routes' => [
                'admin_landings','datatable_all_landings'
            ],
            'description' => 'Able to see landings',
            'children' => [
                'create' => [
                    'name' => 'Create reports',
                    'routes' => ['admin_landings_create','admin_landings_new'],
                    'description' => 'Able to create landings',
                ],
                'edit' => [
                    'name' => 'Create reports',
                    'routes' => ['admin_landings_edit','admin_landings_edit_post'],
                    'description' => 'Able to Edit landings',
                ],
                'delete' => [
                    'name' => 'Create reports',
                    'routes' => ['admin_landings_delete'],
                    'description' => 'Able to delete landings',
                ],
            ],

        ]

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
];
