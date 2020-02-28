<?php
/**
 * Created by PhpStorm.
 * User: sahak
 * Date: 31.12.2017
 * Time: 00:09
 */


/**
 * Created by PhpStorm.
 * User: sahak
 * Date: 31.12.2017
 * Time: 00:09
 */

use App\Services\EAN13render;

Route::get('/', 'Admin\AdminController@getDashboard')->name('admin_dashboard');
Route::get('/mail-templates/{template}', 'Admin\EmailsNotificationsController@templates');

Route::group(['prefix' => 'find'], function () {
    Route::get('/', 'Admin\FindController@getIndex')->name('admin_find');
    Route::post('/call-find', 'Admin\FindController@postCallFind')->name('admin_find_call');
    Route::post('/products-find', 'Admin\FindController@postProductResults')->name('find_product_results');
    Route::post('/items-find', 'Admin\FindController@postItemsResults')->name('find_items_results');
    Route::post('/orders-find', 'Admin\FindController@postOrdersResults')->name('find_orders_results');
    Route::post('/customers-find', 'Admin\FindController@postCustomersResults')->name('find_customers_results');
    Route::resource('customer', 'Find\CustomerController');
    Route::resource('order', 'Find\OrderController');
    Route::resource('products', 'Find\ProductController');
    Route::get('items', 'Find\ItemsController@index');
    Route::post('items/barcodes', 'Find\ItemsController@getBarcodes')->name('find_items_barcodes');
    Route::post('items/qrcodes', 'Find\ItemsController@getQrcodes')->name('find_items_qrcodes');
    Route::post('items/html', 'Admin\FindController@printHtmlBarcode')->name('find_items_barcode_html');
    Route::post('items/edit', 'Find\ItemsController@getEditForm');
    Route::post('items/save', 'Find\ItemsController@postSave');

});

Route::get('/profile', 'Admin\AdminController@getProfile')->name('admin_dashboard_profile');
Route::post('/profile', 'Admin\AdminController@postProfile')->name('admin_dashboard_profile_post');
Route::post('/profile-image', 'Admin\AdminController@postProfileImageUpload')->name('user_profile_image_upload');

Route::post('/quick-email', 'Admin\AdminController@quickEmail')->name('admin_quick_email');
Route::get('/test', 'Admin\AdminController@test')->name('admin_dashboard_test');
Route::post('/dashboard-save', 'Admin\AdminController@saveDashboardWidgets')->name('admin_dashboard_save_widgets');
Route::post('/dashboard-delete', 'Admin\AdminController@deleteDashboardWidget')->name('admin_dashboard_delete_widgets');

Route::get('/menu-manager', function () {
    return view('admin.menu_manager');
});
Route::get('/gmail-call-back', 'GmailController@callBack')->name('gmail_call_back');

Route::post('/search', 'Admin\SearchController@filter')->name('admin_search');

Route::group(['prefix' => 'settings'], function () {
    Route::group(['prefix' => 'general'], function () {
        Route::get('/', 'Admin\SettingsController@getGeneral')->name('admin_settings_general');
        Route::post('/', 'Admin\SettingsController@saveGeneral')->name('post_admin_settings_save_general');

        Route::get('/accounts', 'Admin\SettingsController@getAccounts')->name('admin_settings_accounts');
        Route::post('/accounts', 'Admin\SettingsController@postAccounts')->name('post_admin_settings_accounts');

        Route::get('/main-pages', 'Admin\SettingsController@getMainPages')->name('admin_settings_main_pages');
        Route::post('/main-pages', 'Admin\SettingsController@postMainPages')->name('post_admin_settings_main_pages');


        Route::get('/home-page', 'Admin\SettingsController@getHomePage')->name('admin_settings_home_page');
        Route::post('/home-page', 'Admin\SettingsController@postHomePage')->name('post_admin_settings_home_page');

        Route::get('/regions', 'Admin\SettingsController@getRegions')->name('admin_settings_regions');
        Route::post('/regions', 'Admin\SettingsController@postRegions')->name('post_admin_settings_regions');

        Route::get('/footer', 'Admin\SettingsController@getFooter')->name('admin_settings_footer');
        Route::post('/footer', 'Admin\SettingsController@postFooter')->name('post_admin_settings_footer');

        Route::get('/tc', 'Admin\SettingsController@getTC')->name('admin_settings_tc');
        Route::post('/tc', 'Admin\SettingsController@postTC')->name('post_admin_settings_tc');

        Route::get('/about-us', 'Admin\SettingsController@getAboutUs')->name('admin_settings_about_us');
        Route::post('/about-us', 'Admin\SettingsController@postAboutUs')->name('post_admin_settings_about_us');

        Route::get('/connections', 'Admin\SettingsController@getConnections')->name('admin_settings_connections');
        Route::post('/connections', 'Admin\SettingsController@postConnections')->name('post_admin_settings_connections');
    });
    Route::group(['prefix' => 'defaults'], function () {
        Route::get('/', 'Admin\SettingsController@getDefaults')->name('admin_settings_defaults');
        Route::post('/', 'Admin\SettingsController@saveDefaults')->name('post_admin_settings_save_defaults');
    });
    Route::group(['prefix' => 'events'], function () {
        Route::get('/', 'Admin\EventsController@getIndex')->name('admin_settings_events');
    });
    Route::group(['prefix' => 'store'], function () {
        Route::get('/payment-gateways', 'Admin\SettingsController@getStorePaymentsGateways')->name('admin_settings_payment_gateways');
        Route::get('/payment-gateways/stripe', 'Admin\SettingsController@getStorePaymentsGatewaysSettings')->name('admin_payment_gateways_stripe');
        Route::post('/payment-gateways/stripe', 'Admin\SettingsController@postStorePaymentsGatewaysSettings')->name('post_admin_payment_gateways_stripe');

        Route::get('/payment-gateways/cash', 'Admin\SettingsController@getStorePaymentsGatewaysCash')->name('admin_payment_gateways_cash');
        Route::post('/payment-gateways/cash', 'Admin\SettingsController@postStorePaymentsGatewaysCash')->name('post_admin_payment_gateways_cash');

        Route::get('/printing', 'Admin\SettingsController@getStorePrinting')->name('admin_settings_printing');
        Route::post('/printing', 'Admin\SettingsController@postStorePrinting')->name('admin_settings_printing_post');

        Route::group(['prefix' => 'shipping'], function () {
            Route::get('/', 'Admin\SettingsController@getGeoZones')->name('admin_settings_shipping');
            Route::get('/new/{id?}', 'Admin\SettingsController@geoZoneForm')->name('admin_settings_geo_zones_new');
            Route::post('/save-geo-zone/{id?}', 'Admin\SettingsController@saveGeoZone')->name('admin_settings_geo_zone_save');
            Route::post('/search-payment-options', 'Admin\SettingsController@searchPaymentOptions')->name('admin_settings_search-payment-options');
            Route::post('/search-find-region', 'Admin\SettingsController@findRegion')->name('admin_settings_search-find-region');
            Route::post('/find-region', 'Admin\SettingsController@findRegion')->name('admin_store_shipping_zone_region_find');
        });
        Route::group(['prefix' => 'general'], function () {
            Route::get('/', 'Admin\SettingsController@getStore')->name('admin_settings_store');
            Route::post('/', 'Admin\SettingsController@postStore')->name('post_admin_settings_store');
            Route::post('/currency-data', 'Admin\SettingsController@currencyData')->name('post_admin_settings_store_currency_data');
            Route::post('/currency-get-live', 'Admin\SettingsController@currencyGetLive')->name('post_admin_settings_store_currency_get_live');

        });
        Route::group(['prefix' => 'tax-rates'], function () {
            Route::get('/', 'Admin\SettingsController@getTaxRates')->name('admin_settings_tax_rates');
            Route::get('/create-or-update/{id?}', 'Admin\SettingsController@getCreateRate')->name('get_admin_settings_tax_create_or_update');
            Route::post('/create-or-update/{id?}', 'Admin\SettingsController@postCreateOrUpdateTaxRate')->name('post_admin_settings_tax_create_or_update');
            Route::post('/enable', 'Admin\SettingsController@postTaxRatesEnable')->name('post_admin_tax_rate_enable');

        });
        Route::post('/payment-gateways/enable', 'Admin\SettingsController@postStorePaymentsGatewaysEnable')->name('post_admin_payment_gateways_enable');
        Route::group(['prefix' => 'couriers'], function () {
            Route::get('/', 'Admin\SettingsController@getCouriers')->name('admin_settings_couriers');
            Route::get('/edit/{id}', 'Admin\SettingsController@getCouriersEdit')->name('admin_settings_courier_edit');
            Route::get('/create', 'Admin\SettingsController@getCreateCouriers')->name('admin_settings_courier_create');
            Route::post('/save/{id?}', 'Admin\SettingsController@getCouriersSave')->name('admin_settings_courier_save');

            Route::post('/enable', 'Admin\SettingsController@postCouriersEnable')->name('post_admin_couriers_enable');
        });
        Route::get('/delivery-cost', 'Admin\SettingsController@getDeliveryCost')->name('admin_settings_delivery');

        Route::group(['prefix' => 'gifts'], function () {
            Route::get('/', 'Admin\SettingsController@getGifts')->name('admin_settings_store_gifts');
            Route::get('/create-or-update/{id?}', 'Admin\SettingsController@getGiftsManage')->name('admin_settings_store_gifts_manage');
            Route::post('/create-or-update/{id?}', 'Admin\SettingsController@postGiftsManage')->name('post_admin_settings_store_gifts_manage');

        });

    });
    Route::group(['prefix' => 'languages'], function () {
        Route::get('/', 'Admin\SettingsController@getLanguages')->name('admin_settings_languages');
        Route::get('/manager', 'Admin\SettingsController@getLanguageManager')->name('admin_settings_language_manager');
        Route::post('/manager', 'Admin\SettingsController@postLanguageManager')->name('admin_settings_language_manager_post');

        Route::post('/', 'Admin\SettingsController@setLanguageDefault')->name('admin_settings_set_language_default');

        Route::get('/new', 'Admin\SettingsController@getLanguagesNew')->name('admin_settings_languages_new');
        Route::post('/new-or-update', 'Admin\SettingsController@postLanguages')->name('admin_settings_languages_new_post');
        Route::get('/delete/{id}', 'Admin\SettingsController@getLanguagesDelete')->name('admin_settings_languages_delete');
        Route::group(['prefix' => 'edit'], function () {
            Route::get('/{id}', 'Admin\SettingsController@getLanguagesEdit')->name('admin_settings_languages_edit');
        });

        Route::post('/get-languages', 'Admin\SettingsController@postLanguageGetWithCode')->name('post_admin_settings_get_languages');
    });


    Route::group(['prefix' => 'translations'], function () {
        Route::get('/', 'Admin\TranslationsController@getIndex')->name('admin_settings_translations');
        Route::post('/', 'Admin\TranslationsController@postIndex')->name('admin_settings_translations_post');

        Route::get('/items', 'Admin\TranslationsController@getItems')->name('admin_settings_translations_items');
        Route::post('/items', 'Admin\TranslationsController@postItems')->name('admin_settings_translations_items_post');

        Route::get('/attributes', 'Admin\TranslationsController@getAttrs')->name('admin_settings_translations_attrs');
        Route::post('/attributes', 'Admin\TranslationsController@postAttrs')->name('admin_settings_translations_attrs_post');
    });

});
Route::group(['prefix' => 'emails-notifications'], function () {
    Route::get('/send-email', 'Admin\EmailsNotificationsController@sendEmail')->name('admin_emails_notifications_send_email');
    Route::get('/settings', 'Admin\EmailsNotificationsController@settings')->name('admin_emails_notifications_settings');
    Route::get('/send-email/create', 'Admin\EmailsNotificationsController@sendEmailCreate')->name('create_admin_emails_notifications_send_email');
    Route::post('/send-email/create', 'Admin\EmailsNotificationsController@postSendEmailCreate')->name('post_create_admin_emails_notifications_send_email');
    Route::post('/send-email/create-send', 'Admin\EmailsNotificationsController@postSendEmailCreateSend')->name('post_create_send_admin_emails_notifications_send_email');
    Route::post('/send-email/check-category', 'Admin\EmailsNotificationsController@postSendEmailCheckCategroy')->name('post_create_send_admin_check_category');
    Route::get('/send-email/edit/{id}', 'Admin\EmailsNotificationsController@sendEmailCreate')->name('edit_admin_emails_notifications_send_email');
    Route::get('/send-email/view/{id}', 'Admin\EmailsNotificationsController@sendEmailView')->name('view_admin_emails_notifications_send_email');
    Route::post('/send-now', 'Admin\EmailsNotificationsController@sendEmailSendNow')->name('admin_emails_notifications_send_now');
    Route::post('/copy', 'Admin\EmailsNotificationsController@sendEmailCopy')->name('admin_emails_notifications_copy');

    Route::get('/emails', 'Admin\EmailsNotificationsController@emails')->name('admin_emails_notifications_emails');
    Route::get('/edit-template/{id?}', 'Admin\EmailsNotificationsController@getCreateMailTemplates')->name('admin_mail_create_templates');
    Route::post('/edit-template/{id?}', 'Admin\EmailsNotificationsController@postCreateOrUpdate')->name('post_admin_mail_create_templates');

    Route::get('/newsletters', 'Admin\EmailsNotificationsController@getNewsletters')->name('admin_emails_newsletters');
    Route::post('/add-subscriber', 'Admin\EmailsNotificationsController@postAddSubscriber')->name('admin_emails_newsletters_add_subscribe');
    Route::post('/delete-newsletter', 'Admin\EmailsNotificationsController@postDeleteNewsletter')->name('admin_emails_newsletter_delete');
});

Route::group(['prefix' => 'users'], function () {
    Route::get('/', 'Admin\UserController@index')->name('admin_customers');
    Route::get('/new', 'Admin\UserController@getNew')->name('admin_customers_new');
    Route::post('/new', 'Admin\UserController@postNew')->name('admin_customers_new_post');

    Route::get('/staff', 'Admin\UserController@showStaff')->name('admin_staff');
    Route::get('/staff/new', 'Admin\UserController@newStaff')->name('admin_staff_new');
    Route::post('/staff/new', 'Admin\UserController@postStaff')->name('admin_staff_new_post');
    Route::get('/edit/{id}', 'Admin\UserController@edit')->name('admin_users_edit');
    Route::get('/edit-staff/{id}', 'Admin\UserController@editStaff')->name('admin_staff_edit');
    Route::post('/edit-staff/{id}', 'Admin\UserController@postEditStaff')->name('post_admin_staff_edit');
    Route::post('change-password', 'Admin\UserController@changePassword')->name('change.password');

    Route::post('/delete', 'Admin\UserController@delete')->name('admin_users_delete');
    Route::post('/delete-staff', 'Admin\UserController@deleteStaff')->name('admin_staff_delete');

    Route::post('/address-book-form', 'Admin\UserController@postAddressBookForm')->name('admin_users_address_book_form');
    Route::post('/save-address-book', 'Admin\UserController@postAddressBookSave')->name('admin_users_address_book_save');
    Route::post('/address', 'Admin\UserController@postAddress')->name('admin_users_address');

    Route::post('/reject-verify', 'Admin\UserController@postRejectVerified')->name('admin_users_reject');
    Route::post('/verify', 'Admin\UserController@postVerify')->name('admin_users_approve');

    Route::post('/reject-approve', 'Admin\UserController@postRejectApproved')->name('admin_users_wholesaler_reject');
    Route::post('/approve', 'Admin\UserController@postApprove')->name('admin_users_wholesaler_approve');


    Route::post('/edit/{id}', 'Admin\UserController@postEdit')->name('post_admin_users_edit');
    Route::post('/send-reset-password-email', 'Admin\UserController@sendResetLinkEmail')->name('post_admin_users_reset_pass');
    Route::get('/activity/{id}', 'Admin\UserController@getUserActivity')->name('admin_users_activity');
    Route::get('/verify/{id}', 'Admin\UserController@getUserVerify')->name('admin_users_verify');

    Route::get('/approve-review/{id}', 'Admin\UserController@getApproveReview')->name('admin_users_approve_review');
    Route::get('/disable-review/{id}', 'Admin\UserController@getDisableReview')->name('admin_users_disable_review');
    Route::get('/allow-edit-review/{id}', 'Admin\UserController@getAllowEditReview')->name('admin_users_allow_edit_review');

    Route::group(['prefix' => 'roles-mebership', 'middleware' => 'superadmin'], function () {
        Route::get('/', 'Admin\RolesController@index')->name('admin_role_membership');
        Route::get('/create', 'Admin\RolesController@create')->name('admin_create_role');
        Route::post('/create', 'Admin\RolesController@postCreate')->name('post_admin_create_role');
        Route::get('/edit/{id}', 'Admin\RolesController@edit')->name('admin_edit_role');
        Route::post('/edit/{id}', 'Admin\RolesController@postEdit')->name('post_admin_edit_role');
    });

    Route::group(['prefix' => 'campaign'], function () {
        Route::get('/', 'Admin\CampaignController@index')->name('admin_campaign');
        Route::get('/create', 'Admin\CampaignController@create')->name('admin_campaign_create');
        Route::post('/create', 'Admin\CampaignController@postCreate')->name('admin_campaign_create_post');
        Route::get('/edit/{id}', 'Admin\CampaignController@edit')->name('admin_campaign_edit');
        Route::post('/edit/{id}', 'Admin\CampaignController@postEdit')->name('admin_campaign_edit_post');
        Route::post('/delete', 'Admin\CampaignController@postDelete')->name('admin_campaign_delete');
    });

    Route::group(['prefix' => 'notes'], function () {
        Route::post('/get-form', 'Admin\UserController@postNoteForm')->name('admin_notes_form_post');
        Route::post('/save', 'Admin\UserController@postSaveNote')->name('admin_notes_form_save');
        Route::post('/delete', 'Admin\UserController@postDeleteNote')->name('admin_notes_delete');
    });
});
Route::group(['prefix' => 'store'], function () {

    Route::group(['prefix' => 'transactions'], function () {
        Route::get('/', 'Admin\TransactionsController@getIndex')->name('admin_store_transactions');
        Route::get('/view/{id}', 'Admin\TransactionsController@getView')->name('admin_store_transactions_view');
    });

    Route::group(['prefix' => 'promotions'], function () {
        Route::get('/', 'Admin\PromotionController@getIndex')->name('admin_stock_promotions');
        Route::get('/new', 'Admin\PromotionController@getNew')->name('admin_stock_promotions_new');

        Route::post('/get-promotion', 'Admin\PromotionController@getPromotion')->name('admin_stock_get_promotion');
        Route::post('/promotion-save', 'Admin\PromotionController@savePromotion')->name('admin_stock_sales_save');
        Route::post('/cancel-promotion', 'Admin\PromotionController@cancelSale')->name('admin_stock_cancel_delete');
    });

    Route::group(['prefix' => 'coupons'], function () {
        Route::get('/', 'Admin\StoreController@getCoupons')->name('admin_store_coupons');
        Route::get('/new', 'Admin\StoreController@getCouponsNew')->name('admin_store_coupons_new');
        Route::get('/delete/{id}', 'Admin\StoreController@Delete')->name('admin_store_coupons_delete');
        Route::get('/edit/{id}', 'Admin\StoreController@Edit')->name('admin_store_coupons_edit');
        Route::post('/coupons-save', 'Admin\StoreController@CouponsSave')->name('admin_store_coupons_save');
        Route::post('/cancel-coupon', 'Admin\StoreController@cancelCoupon')->name('admin_store_coupons_cancel');
        Route::post('/get-theme', 'Admin\StoreController@postCouponTheme')->name('admin_store_coupons_theme');
    });

    Route::group(['prefix' => 'settings'], function () {
        Route::get('/', 'Admin\StoreController@getSettings')->name('admin_store_settings');
    });


});


Route::group(['prefix' => 'blog'], function () {
    Route::get('/', 'Admin\PostController@index')->name('admin_blog');
    Route::get('create', 'Admin\PostController@create')->name('admin_blog_create');
    Route::get('settings', 'Admin\PostController@settings')->name('admin_blog_settings');
    Route::post('delete', 'Admin\PostController@getDelete')->name('admin_post_delete');
    Route::get('edit/{id}', 'Admin\PostController@edit')->name('admin_post_edit');
    Route::post('create-new', 'Admin\PostController@newPost')->name('admin_new_post');
    Route::group(['prefix' => 'contact-us'], function () {
        Route::get('/', 'Admin\ContactUsController@index')->name('admin_blog_contact_us');
        Route::get('/view/{id}', 'Admin\ContactUsController@getView')->name('admin_blog_contact_us_view');
        Route::post('/replay/{id}', 'Admin\ContactUsController@postReplay')->name('admin_post_blog_contact_us_replay');
    });

    Route::group(['prefix' => 'brands'], function () {
        Route::get('/', 'Admin\BrandsController@index')->name('admin_blog_brands');
        Route::get('/create', 'Admin\BrandsController@create')->name('admin_blog_brands_create');
        Route::get('/edit/{id}', 'Admin\BrandsController@edit')->name('admin_blog_brands_edit');
        Route::post('/create-or-edit', 'Admin\BrandsController@postCreateOrUpdateBrand')->name('admin_blog_brands_create_or_edit');
        Route::get('/fix', 'Admin\BrandsController@fixBrands')->name('admin_blog_brands_fix');
    });

    Route::group(['prefix' => '/tickets'], function () {
        Route::get('/', 'Admin\TicketsController@index')->name('admin_tickets');
        Route::get('/new', 'Admin\TicketsController@getNew')->name('admin_tickets_new');
        Route::get('/edit/{id}', 'Admin\TicketsController@getEdit')->name('admin_tickets_edit');
        Route::post('/edit/{id}', 'Admin\TicketsController@postEdit')->name('admin_tickets_edit_post');
        Route::post('/new', 'Admin\TicketsController@postNew')->name('admin_tickets_new_save');
        Route::post('/reply', 'Admin\TicketsController@reply')->name('admin_tickets_reply');
        Route::get('/settings', 'Admin\TicketsController@getSettings')->name('admin_tickets_settings');
        Route::get('/statuses/{type}', 'Admin\TicketsController@statuses')->name('admin_tickets_statuses');
        Route::post('/settings', 'Admin\TicketsController@postSettings')->name('admin_tickets_settings_save');
        Route::get('/close/{id}', 'Admin\TicketsController@getClose')->name('admin_tickets_close');

    });

    Route::group(['prefix' => '/reviews'], function () {
        Route::get('/', 'Admin\ReviewsController@index')->name('admin_reviews');
    });

//    Route::group(['prefix' => 'comments'], function () {
//        Route::get('/', 'Admin\PostController@getComments')->name('admin_blog_comments');
//        Route::get('/settings', 'Admin\PostController@getCommentSettings')->name('admin_blog_comments_settings');
//        Route::get('/delete/{id}', 'Admin\PostController@getCommentsDelete')->name('admin_post_comment_delete');
//        Route::get('edit/{id}', 'Admin\PostController@getCommentsEdit')->name('admin_post_comment_edit');
//
//    });

});

Route::group(['prefix' => 'faq'], function () {
    Route::get('/', 'Admin\FaqController@index')->name('admin_faq');
    Route::get('create', 'Admin\FaqController@create')->name('admin_faq_create');
    Route::get('settings', 'Admin\FaqController@settings')->name('admin_faq_settings');
    Route::post('delete', 'Admin\FaqController@getDelete')->name('admin_faq_delete');
    Route::get('edit/{id}', 'Admin\FaqController@edit')->name('admin_faq_edit');
    Route::post('create-new', 'Admin\FaqController@newPost')->name('admin_faq_new');
});

Route::group(['prefix' => 'landings'], function () {
    Route::get('/', 'Admin\LandingController@index')->name('admin_landings');
    Route::get('create', 'Admin\LandingController@create')->name('admin_landings_create');
    Route::post('delete', 'Admin\LandingController@getDelete')->name('admin_landings_delete');
    Route::get('edit/{id}', 'Admin\LandingController@edit')->name('admin_landings_edit');
    Route::post('edit/{id}', 'Admin\LandingController@postEdit')->name('admin_landings_edit_post');
    Route::post('create', 'Admin\LandingController@postCreate')->name('admin_landings_new');
});

Route::group(['prefix' => 'manage-api'], function () {
    Route::get('/', 'Admin\ManageApiController@index')->name('admin_manage_api');
    Route::post('/', 'Admin\ManageApiController@postManage')->name('post_admin_manage_api');
    Route::post('/settings', 'Admin\ManageApiController@postSettings')->name('post_admin_manage_api_settings');

    Route::get('/products', 'Admin\ManageApiController@getProducts')->name('admin_manage_api_products');
    Route::get('/get-all-stocks', 'Admin\ManageApiController@getAllProducts')->name('admin_manage_api_all_products');
    Route::get('/items', 'Admin\ManageApiController@getItems')->name('admin_manage_api_items');
    Route::get('/get-all-items', 'Admin\ManageApiController@getAllItems')->name('admin_manage_api_all_items');
    Route::get('/export-user', 'Admin\ManageApiController@exportCustomers');
});

Route::group(['prefix' => 'orders'], function () {
    Route::get('/', 'Admin\OrdersController@index')->name('admin_orders');
    Route::get('/manage/{id}', 'Admin\OrdersController@getManage')->name('admin_orders_manage');
    Route::get('/edit/{id}', 'Admin\OrdersController@getEdit')->name('admin_orders_edit');
    Route::post('/edit/{id}', 'Admin\OrdersController@postEdit')->name('admin_orders_edit_post');
    Route::get('/new', 'Admin\OrdersController@getNew')->name('admin_orders_new');
    Route::post('/add-note', 'Admin\OrdersController@addNote')->name('orders_add_note');
    Route::get('/settings', 'Admin\OrdersController@tickets')->name('admin_orders_settings');
    Route::post('/settings', 'Admin\OrdersController@postSettings')->name('admin_orders_settings_save');
    Route::post('/get-item', 'Admin\OrdersController@getItem')->name('orders_get_product');

    Route::post('/collecting/{id}', 'Admin\OrdersController@postCollecting')->name('admin_orders_collecting');
    Route::post('/get-item-by-id', 'Admin\OrdersController@ItemById')->name('admin_orders_items_by_id');


    Route::post('/get-user', 'Admin\OrdersController@postGetUser')->name('admin_orders_get_user');
    Route::post('/add-user', 'Admin\OrdersController@postAddUser')->name('admin_orders_add_user');

    Route::post('/add-to-cart', 'Admin\OrdersController@postAddToCart')->name('shop_add_to_cart_orders');
    Route::post('/update-cart', 'Admin\OrdersController@postUpdateQty')->name('shop_update_cart_orders');
    Route::post('/remove-from-cart', 'Admin\OrdersController@postRemoveFromCart')->name('shop_remove_from_cart_orders');
    Route::post('/apply-coupon', 'Admin\OrdersController@postApplyCoupon')->name('admin_orders_apply_coupon');
    Route::post('/order-new-customer-notes', 'Admin\OrdersController@postApplyCustomerNotes')->name('admin_orders_apply_customer_notes');

    Route::post('/cash-payment', 'Admin\OrdersController@orderCash')->name('admin_orders_new_cash');
    Route::post('/stripe-charge', 'Admin\OrdersController@stripeCharge')->name('admin_orders_new_stripe');

    Route::group(['prefix' => 'invoices'], function () {
        Route::get('/', 'Admin\InvoiceOrdersController@index')->name('admin_orders_invoice');
        Route::get('/manage/{id}', 'Admin\InvoiceOrdersController@getManage')->name('admin_orders_invoice_manage');
        Route::get('/edit/{id}', 'Admin\InvoiceOrdersController@getEdit')->name('admin_orders_invoice_edit');
        Route::post('/edit/{id}', 'Admin\InvoiceOrdersController@postEdit')->name('admin_orders_invoice_edit_post');
        Route::get('/new', 'Admin\InvoiceOrdersController@getNew')->name('admin_orders_invoice_new');
        Route::post('/add-note', 'Admin\InvoiceOrdersController@addNote')->name('admin_orders_invoice_add_note');
        Route::get('/settings', 'Admin\InvoiceOrdersController@getSettings')->name('admin_orders_invoice_settings');
        Route::post('/settings', 'Admin\InvoiceOrdersController@postSettings')->name('admin_orders_invoice_settings_save');
        Route::post('/get-item', 'Admin\InvoiceOrdersController@getItem')->name('admin_orders_invoice_get_product');

        Route::post('/collecting/{id}', 'Admin\InvoiceOrdersController@postCollecting')->name('admin_orders_invoice_collecting');
        Route::post('/get-item-by-id', 'Admin\InvoiceOrdersController@ItemById')->name('admin_orders_invoice_items_by_id');


        Route::post('/get-user', 'Admin\InvoiceOrdersController@postGetUser')->name('admin_orders_invoice_get_user');
        Route::post('/add-user', 'Admin\InvoiceOrdersController@postAddUser')->name('admin_orders_invoice_add_user');

        Route::post('/add-to-cart', 'Admin\InvoiceOrdersController@postAddToCart')->name('shop_add_to_cart_admin_orders_invoice');
        Route::post('/update-cart', 'Admin\InvoiceOrdersController@postUpdateQty')->name('shop_update_cart_admin_orders_invoice');
        Route::post('/remove-from-cart', 'Admin\InvoiceOrdersController@postRemoveFromCart')->name('shop_remove_from_cart_admin_orders_invoice');
        Route::post('/apply-coupon', 'Admin\InvoiceOrdersController@postApplyCoupon')->name('admin_orders_invoice_apply_coupon');
        Route::post('/order-new-customer-notes', 'Admin\InvoiceOrdersController@postApplyCustomerNotes')->name('admin_orders_invoice_apply_customer_notes');

        Route::post('/cash-payment', 'Admin\InvoiceOrdersController@orderCash')->name('admin_orders_invoice_new_cash');
        Route::post('/stripe-charge', 'Admin\InvoiceOrdersController@stripeCharge')->name('admin_orders_invoice_new_cash');
    });
});

Route::group(['prefix' => 'inventory'], function () {
    Route::group(['prefix' => 'warehouses'], function () {
        Route::get('/', 'Admin\WarehouseController@index')->name('admin_warehouses');
        Route::get('/new', 'Admin\WarehouseController@getNew')->name('admin_warehouses_new');
        Route::post('/save', 'Admin\WarehouseController@postSave')->name('admin_warehouses_save');

        Route::post('/delete', 'Admin\WarehouseController@delete')->name('admin_warehouses_delete');
        Route::get('/edit/{id}', 'Admin\WarehouseController@edit')->name('admin_warehouses_edit');
        Route::get('/manage/{id}', 'Admin\WarehouseController@getManage')->name('admin_warehouses_manage');

        Route::post('/get-form/{id}', 'Admin\WarehouseController@postCategoryForm')->name('admin_warehouses_categories_form');
        Route::post('/update-parent/{id}', 'Admin\WarehouseController@postCategoryUpdateParent')->name('admin_warehouses_categories_update_parent');
        Route::post('/create-or-update/{id}', 'Admin\WarehouseController@postCreateOrUpdateCategory')->name('admin_warehouses_categories_new_or_update');
        Route::post('/delete/{id}', 'Admin\WarehouseController@postDeleteCategory')->name('admin_warehouses_categories_delete');

        Route::post('/get-racks-by-warehouse', 'Admin\WarehouseController@postGetRacksByWarehouse')->name('admin_warehouses_rack_by_warehouse');
        Route::post('/get-shelves-by-rack', 'Admin\WarehouseController@postGetShelvesByRack')->name('admin_warehouses_shelve_by_rack');
    });
    Route::group(['prefix' => 'purchase'], function () {
        Route::get('/', 'Admin\StoreController@getPurchase')->name('admin_inventory_purchase');
        Route::get('/new', 'Admin\StoreController@getPurchaseNew')->name('admin_inventory_purchase_new');
        Route::post('/new-or-update', 'Admin\StoreController@postSaveOrUpdate')->name('admin_inventory_purchase_save');
        Route::get('/delete/{id}', 'Admin\StoreController@DeletePurchase')->name('admin_inventory_purchase_delete');
        Route::get('/edit/{id}', 'Admin\StoreController@EditPurchase')->name('admin_inventory_purchase_edit');
        Route::post('/get-stock-by-sku', 'Admin\StoreController@getStockBySku')->name('admin_inventory_purchase_get_stock_by_sku');
        Route::post('/get-item-locations', 'Admin\StoreController@postItemLocations')->name('admin_item_locations');

    });
    Route::group(['prefix' => 'suppliers'], function () {
        Route::get('/', 'Admin\ItemsController@getSuppliers')->name('admin_suppliers');
        Route::get('/new', 'Admin\ItemsController@getSuppliersNew')->name('admin_suppliers_new');
        Route::get('/edit/{id}', 'Admin\ItemsController@getSuppliersEdit')->name('admin_suppliers_edit');
        Route::post('/new', 'Admin\ItemsController@postSuppliers')->name('post_admin_suppliers');
        Route::post('/select-suppliers', 'Admin\ItemsController@getList')->name('post_admin_suppliers_list');
        Route::post('/sync-suppliers', 'Admin\ItemsController@syncSupplier')->name('post_admin_suppliers_sync');
        Route::post('/delete-item-suppliers', 'Admin\ItemsController@deleteSupplier')->name('post_admin_suppliers_item_delete');
        Route::post('/get-list', 'Admin\ItemsController@postSuppliersList')->name('post_admin_suppliers_list');

    });

    Route::group(['prefix' => 'other'], function () {
        Route::get('/', 'Admin\OtherController@getIndex')->name('admin_inventory_other');
        Route::get('/manage', 'Admin\OtherController@getNew')->name('admin_inventory_others_new');
        Route::get('/edtit/{id}', 'Admin\OtherController@getNew')->name('admin_inventory_others_edit');
        Route::post('/new', 'Admin\OtherController@postOthers')->name('post_admin_inventory_others_new');
    });

    Route::group(['prefix' => 'transfer'], function () {
        Route::get('/', 'Admin\ItemsController@transfer')->name('admin_items_transfer');
        Route::get('/new', 'Admin\ItemsController@newTransfer')->name('admin_items_new_transfer');
        Route::post('/new', 'Admin\ItemsController@PostTransfer')->name('admin_transfer_post');
        Route::post('/get-item-locations', 'Admin\ItemsController@postItemLocations')->name('admin_items_transfer_locations');
    });

    Route::group(['prefix' => 'items'], function () {
        Route::get('/', 'Admin\ItemsController@index')->name('admin_items');
        Route::get('/archives', 'Admin\ItemsController@archives')->name('admin_items_archives');
        Route::get('/new', 'Admin\ItemsController@getNew')->name('admin_items_new');
        Route::post('/new', 'Admin\ItemsController@postNew')->name('post_admin_items_new');
        Route::post('/edit-row', 'Admin\ItemsController@postItemRowEdit')->name('post_admin_items_edit_row');
        Route::post('/multi-delete', 'Admin\ItemsController@postItemMultiDelete')->name('post_admin_items_multi_delete');
        Route::get('/edit-rows/{ids}', 'Admin\ItemsController@postItemRowsEdit')->name('post_admin_items_edit_row_many');
        Route::post('/edit-rows', 'Admin\ItemsController@postItemRowsEditSave')->name('post_admin_items_edit_row_many_save');
        Route::post('/edit-row-save', 'Admin\ItemsController@postItemRowEditSave')->name('post_admin_items_edit_row_save');
        Route::get('/edit/{id}', 'Admin\ItemsController@getEdit')->name('admin_items_edit');
        Route::get('/purchase/{item_id}', 'Admin\ItemsController@getPurchase')->name('admin_items_purchase');
        Route::get('/archive/{item_id}', 'Admin\ItemsController@putArchive')->name('admin_items_archive');
        Route::post('/add-package', 'Admin\ItemsController@addPackage')->name('admin_items_package_add');
        Route::post('/add-location', 'Admin\ItemsController@addLocation')->name('admin_items_location_add');
        Route::post('/get-specifications', 'Admin\ItemsController@getSpecification')->name('admin_items_get_specification');
        Route::post('/get-specifications-by-category', 'Admin\ItemsController@getSpecificationByCategory')->name('admin_items_get_specification_by_category');
        Route::post('/render-barcode', 'Admin\ItemsController@renderBarcode')->name('admin_items_render_barcode');
        Route::post('/get-download-html', 'Admin\ItemsController@getDownloadHtml')->name('admin_items_download_html');
        Route::get('/download-code/{code}/{type?}/{item_id?}', 'Admin\ItemsController@downloadCode')->name('admin_items_download_code');
        Route::get('/datatable-selections', 'Admin\ItemsController@datatableSelections')->name('admin_items_datatable_selections');


    });
    Route::group(['prefix' => 'barcode'], function () {
        Route::get('/', 'Admin\BarcodesController@getIndex')->name('admin_inventory_barcodes');
        Route::post('/settings', 'Admin\BarcodesController@postSettings')->name('admin_inventory_barcodes_settings');
        Route::get('/new', 'Admin\BarcodesController@getNew')->name('admin_inventory_barcodes_new');
        Route::post('/new', 'Admin\BarcodesController@postNew')->name('post_admin_inventory_barcodes_new');
        Route::get('/view/{id}', 'Admin\BarcodesController@getBarcodeView')->name('admin_inventory_barcode_view');
        Route::post('/delete', 'Admin\BarcodesController@deteleBarcode')->name('admin_inventory_barcode_delete');
    });
});

Route::group(['prefix' => 'stock'], function () {
    Route::get('/', 'Admin\StockController@stock')->name('admin_stock');
    Route::get('/new', 'Admin\StockController@stockNew')->name('admin_stock_new');
    Route::get('/edit/{id}', 'Admin\StockController@getStockEdit')->name('admin_stock_edit');
    Route::post('/delete', 'Admin\StockController@delete')->name('admin_stock_delete');

    Route::post('/edit-row', 'Admin\StockController@postItemRowEdit')->name('post_admin_stock_edit_row');
    Route::post('/multi-delete', 'Admin\StockController@postMultyDelete')->name('post_admin_stock_multi_delete');
    Route::get('/edit-rows/{ids}', 'Admin\StockController@postItemRowsEdit')->name('post_admin_stock_edit_row_many');
    Route::post('/edit-rows', 'Admin\StockController@postItemRowsEditSave')->name('post_admin_stock_edit_row_many_save');
    Route::post('/edit-row-save', 'Admin\StockController@postItemRowEditSave')->name('post_admin_stock_edit_row_save');

    Route::group(['prefix' => 'offers'], function () {
        Route::get('/', 'Admin\StockController@stockOffers')->name('admin_stock_offers');
        Route::get('/new', 'Admin\StockController@offerNew')->name('admin_stock_new_offer');
        Route::get('/edit/{id}', 'Admin\StockController@getOfferEdit')->name('admin_stock_edit_offer');
    });

    Route::group(['prefix' => 'settings'], function () {
        Route::get('/', 'Admin\StockController@stockSettings')->name('admin_stock_settings');
        Route::get('/categories/{type}', 'Admin\StockController@stockCategories')->name('admin_stock_categories');
    });


    Route::post('/save-stock', 'Admin\StockController@postStock')->name('admin_stock_save');
    Route::post('/copy-stock', 'Admin\StockController@postStockCopy')->name('admin_stock_copy');
    Route::post('/link-all', 'Admin\StockController@linkAll')->name('admin_stock_link_all');
    Route::post('/variation-form', 'Admin\StockController@variationForm')->name('admin_stock_variation_form');
    Route::post('/add-variation', 'Admin\StockController@addVariation')->name('admin_stock_variation_add');
    Route::post('/duplicate-package-options', 'Admin\StockController@duplicatePackageOptions')->name('admin_stock_package_section_duplicate');
    Route::post('/duplicate-v-options', 'Admin\StockController@duplicateVOptions')->name('admin_stock_variations_section_duplicate');
    Route::post('/add-package-variation', 'Admin\StockController@addPackageVariation')->name('admin_stock_package_variation_add');
    Route::post('/select-items', 'Admin\StockController@postSelectItems')->name('admin_stock_package_variation_items');
    Route::post('/search-items', 'Admin\StockController@postSearchItems')->name('admin_stock_search_items');
    Route::post('/get-filter-items', 'Admin\StockController@postFilterItems')->name('admin_stock_filter_items');
    Route::post('/variation-option-view', 'Admin\StockController@postVariationOptionsView')->name('admin_stock_variation_type_view');

    Route::post('/edit-variation', 'Admin\StockController@editVariation')->name('admin_stock_variation_edit');
    Route::post('/get-option-by-id', 'Admin\StockController@getOptionById')->name('admin_stock_variation_get_option');
    Route::post('/get-specifications', 'Admin\StockController@getSpecification')->name('admin_stock_variation_get_specification');
    Route::post('/get-specifications-by-category', 'Admin\StockController@postSpecificationByCategory')->name('admin_stock_specif_by_category');


    Route::post('/render-variation-new-options', 'Admin\StockController@postRenderVariationNewOptions')->name('admin_stock_variation_render_new_option');
    Route::post('/get-by-id', 'Admin\StockController@getById')->name('admin_stock_get_by_id');
    Route::post('/get-variations-by-id', 'Admin\StockController@getVariationsById')->name('admin_stock_get_variations_by_id');
    Route::post('/get-item-by-id', 'Admin\StockController@postItemByID')->name('admin_stock_variations_get_item_by_id');

    //extra
    Route::post('/add-extra-option', 'Admin\StockController@addExtraOption')->name('admin_stock_extra_option');
    Route::post('/get-extra-option-variations', 'Admin\StockController@getPromotionVariations')->name('admin_stock_extra_option_variations');
    Route::post('/save-extra-option', 'Admin\StockController@saveExtraOptions')->name('admin_stock_extra_option_save');

    Route::post('/apply-discount', 'Admin\StockController@applyDiscount')->name('admin_stock_apply_discount');
    Route::post('/main-item', 'Admin\StockController@mainItem')->name('admin_stock_main_item');
});

Route::get('/forum', 'Admin\ForumController@index')->name('admin_forum');

Route::group(['prefix' => '/tools'], function () {
    Route::get('/', 'Admin\ToolsController@index')->name('admin_tools');
    Route::group(['prefix' => 'filters'], function () {
        Route::get('/', 'Admin\FiltersController@index')->name('admin_tools_filters');
        Route::get('/create-or-edit/{id?}', 'Admin\FiltersController@getCreateOrEdit')->name('admin_tools_filters_manage');
        Route::post('/', 'Admin\FiltersController@postCreateOrUpdateCategory')->name('post_admin_tools_filters');
        Route::post('/add-child/{id}', 'Admin\FiltersController@postCategoryUpdateChild')->name('post_admin_tools_filters_add_child');
        Route::post('/update-parent', 'Admin\FiltersController@postCategoryUpdateChild')->name('admin_store_filters_update_parent');
        Route::post('/new-category', 'Admin\FiltersController@postCreateParentCategory')->name('admin_store_filters_new_category');
        Route::post('/get-form', 'Admin\FiltersController@postFilterForm')->name('admin_tools_filters_form');
        Route::post('/get-next', 'Admin\FiltersController@postGetNext')->name('admin_tools_filters_next');
        Route::post('/get-items', 'Admin\FiltersController@getItems')->name('admin_tools_filters_get_items');
        Route::post('/delete', 'Admin\FiltersController@postDelete')->name('post_admin_tools_filters_delete');
        Route::post('/detach/{id}', 'Admin\FiltersController@postDetachItem')->name('post_admin_tools_filters_detach_item');
        Route::post('/edit-category/{id}', 'Admin\FiltersController@postEditCategory')->name('post_admin_tools_filters_edit_category');

    });
    Route::group(['prefix' => 'categories'], function () {
        Route::post('/get-form/{type}', 'Admin\CategoriesController@postCategoryForm')->name('admin_store_categories_form');
        Route::post('/update-parent/{type}', 'Admin\CategoriesController@postCategoryUpdateParent')->name('admin_store_categories_update_parent');
        Route::post('/create-or-update/{type}', 'Admin\CategoriesController@postCreateOrUpdateCategory')->name('admin_store_categories_new_or_update');
        Route::post('/delete/{type}', 'Admin\CategoriesController@postDeleteCategory')->name('admin_store_categories_delete');
    });
    Route::group(['prefix' => 'logs'], function () {
        Route::get('/', 'Admin\LogsController@getFrontend')->name('admin_tools_logs');
        Route::get('/backend', 'Admin\LogsController@getBackend')->name('admin_tools_logs_backend');
    });

    Route::group(['prefix' => 'statuses'], function () {
        Route::post('/manage/{id?}', 'Admin\StatusController@postStatusesManage')->name('post_admin_stock_statuses_manage');
        Route::post('/delete', 'Admin\StatusController@postStatusesDelete')->name('post_admin_stock_statuses_delete');
        Route::post('get-manage-form', 'Admin\StatusController@postGetManageStatusForm')->name('post_admin_stock_statuses_manage_form');
    });


    Route::group(['prefix' => 'attributes'], function () {
        Route::get('/', 'Admin\AttributesController@getAttributes')->name('admin_store_attributes');
        Route::get('/new', 'Admin\AttributesController@getAttributesCreate')->name('admin_store_attributes_new');
        Route::post('/new', 'Admin\AttributesController@postAttributesCreate')->name('admin_store_attributes_new');
        Route::post('/options-show-form', 'Admin\AttributesController@postAttributesOptionsForm')->name('admin_store_attributes_options_form');
        Route::post('/options-delete', 'Admin\AttributesController@postAttributesOptionDelete')->name('admin_store_attributes_option_delete');
        Route::post('/options/{id}/save', 'Admin\AttributesController@postAttributesOptions')->name('admin_store_attributes_options');

        Route::get('/edit/{id}', 'Admin\AttributesController@getAttributesEdit')->name('admin_store_attributes_edit');
        Route::post('/edit/{id}', 'Admin\AttributesController@postAttributesEdit')->name('admin_store_attributes_post_edit');

        Route::post('/get-options-by-id', 'Admin\AttributesController@getOptions')->name('admin_store_attributes_options_by_id');
        Route::post('/get-options-by-id/{id}', 'Admin\AttributesController@getOptionsAutocomplate')->name('admin_store_attributes_options_by_id_autocomplate');
        Route::post('/get-attribute', 'Admin\AttributesController@getAttributeByID')->name('admin_store_attributes_by_id');
        Route::post('/get-all', 'Admin\AttributesController@postAllAttributes')->name('admin_store_attributes_all_post');
        Route::post('/delete', 'Admin\AttributesController@postAttributesDelete')->name('admin_store_attributes_delete');
        Route::post('/get-variations-table', 'Admin\AttributesController@getVariationsTable')->name('admin_store_attributes_variations_table');
    });

    Route::group(['prefix' => 'stickers'], function () {
        Route::get('/', 'Admin\ToolsController@stickers')->name('admin_tools_stickers');
        Route::post('/manage/{id?}', 'Admin\ToolsController@postStickersManage')->name('admin_tools_stickers_manage');
        Route::post('get-manage-form', 'Admin\ToolsController@postStickersManageForm')->name('admin_tools_stickers_manage_form');
        Route::post('get-new-form', 'Admin\ToolsController@postStickersNewForm')->name('admin_tools_stickers_new_form');
        Route::post('/get-all', 'Admin\ToolsController@postAll')->name('admin_tools_stickers_all_post');
        Route::post('/delete', 'Admin\ToolsController@postDelete')->name('admin_tools_stickers_delete');
    });
});

Route::group(['prefix' => 'comments'], function () {
    Route::get('/', 'Admin\CommentsController@index')->name('show_comments');
    Route::get('/settings', 'Admin\CommentsController@getSettings')->name('admin_blog_comments_settings');
    Route::post('/settings', 'Admin\CommentsController@postSettings')->name('admin_blog_comments_settings_post');
    Route::get('/approve/{id}', 'Admin\CommentsController@approve')->name('approve_comments');
    Route::get('/unapprove/{id}', 'Admin\CommentsController@unapprove')->name('unapprove_comments');
    Route::post('/delete', 'Admin\CommentsController@delete')->name('delete_comments');
    Route::get('/edit/{id}', 'Admin\CommentsController@edit')->name('edit_comment');
    Route::post('/edit/{id}', 'Admin\CommentsController@postEdit')->name('edit_comment_post');
    Route::get('/reply/{id}', 'Admin\CommentsController@reply')->name('reply_comment');
    Route::post('/reply/{id}', 'Admin\CommentsController@postReply')->name('reply_comment_post');
});

//Route::get('{locale}', function($locale) {
//    app()->setLocale($locale);
//
//    $article = Article::first();
//
//    return view('admin.blog.index')->with(compact('article'));
//});


//MEDIA


//Route::get('/media', 'Admin\Media\IndexController@index')->name('admin_media');
Route::group(['prefix' => 'media'], function () {
    Route::get('/clean-media', 'Admin\Media\IndexController@cleanMedia');
    Route::get('/fix-db', 'Admin\Media\IndexController@fixDb');
    Route::get('/fix-db-again', 'Admin\Media\IndexController@fixDbAgain');
    Route::get('/fix-files', 'Admin\Media\IndexController@fixfiles');
    Route::get('/settings', 'Admin\Media\IndexController@getSettings')->name('admin_media_settinds');
    Route::post('/settings', 'Admin\Media\IndexController@postSettings')->name('post_admin_media_settings');
    Route::get('/{folder?}', 'Admin\Media\IndexController@index')->name('admin_media');

});
Route::group(['prefix' => 'seo'], function () {

    Route::get('/', 'Admin\SeoController@getPosts')->name('admin_seo');
    Route::post('/', 'Admin\SeoController@postPosts')->name('post_admin_seo');

    Route::get('/stocks', 'Admin\SeoController@getStocks')->name('admin_seo_stocks');
    Route::post('/stocks', 'Admin\SeoController@postStocks')->name('stocks_admin_seo_stocks');

    Route::get('/brands', 'Admin\SeoController@getBrands')->name('admin_seo_brands');
    Route::post('/brands', 'Admin\SeoController@postBrands')->name('post_admin_seo_brands');

    Route::get('/bulk', 'Admin\SeoController@getBulk')->name('admin_seo_bulk');


    Route::get('/bulk/edit-post-seo/{id}', 'Admin\SeoController@getBulkEditPost')->name('admin_seo_bulk_edit_post');
    Route::post('/bulk/edit-post-seo/{id}', 'Admin\SeoController@createOrUpdatePostSeo')->name('post_admin_seo_bulk_edit_post');

    Route::get('/bulk/edit-brands-seo/{id}', 'Admin\SeoController@getBulkEditBrands')->name('admin_seo_bulk_edit_post');
    Route::post('/bulk/edit-brands-seo/{id}', 'Admin\SeoController@createOrUpdateBrandsSeo')->name('post_admin_seo_bulk_edit_post');

    Route::get('/bulk/edit-stcok-seo/{id}', 'Admin\SeoController@getBulkEditProduct')->name('admin_seo_bulk_edit_stock');
    Route::post('/bulk/edit-stcok-seo/{id}', 'Admin\SeoController@createOrUpdateStockSeo')->name('post_admin_seo_bulk_edit_stock');
    Route::get('/bulk/products', 'Admin\SeoController@getBulkProducts')->name('admin_seo_bulk_products');
    Route::get('/bulk/pages', 'Admin\SeoController@getMainPages')->name('admin_seo_bulk_pages');
    Route::post('/main-pages/seo', 'Admin\SeoController@postMainPagesSeo')->name('post_admin_settings_main_pages_seo');
    Route::get('/bulk/brands', 'Admin\SeoController@getBulkBrands')->name('admin_seo_bulk_brands');

    Route::get('/bulk/products/edit-rows/{ids}', 'Admin\SeoController@postItemRowsEdit')->name('post_admin_seo_stock_edit_row_many');
    Route::post('/bulk/products/edit-rows/{ids}', 'Admin\SeoController@postItemRowsEditSave')->name('post_admin_seo_stock_edit_row_many_save');

    Route::get('/bulk/posts/edit-rows/{ids}', 'Admin\SeoController@postPostsRowsEdit')->name('post_admin_seo_post_edit_row_many');
    Route::post('/bulk/posts/edit-rows/{ids}', 'Admin\SeoController@postPostsRowsEditSave')->name('post_admin_seo_post_edit_row_many_save');

    Route::post('rich-properties', 'Admin\SeoController@getRichProperties')->name('gus');
});

Route::post('/get-categories', 'Admin\CategoriesController@getCategory')->name('admin_get_categories');
Route::post('/get-products', 'Admin\StoreController@getProducts')->name('admin_store_coupons_get_products');
Route::post('/get-stocks', 'Admin\StockController@getStocks')->name('admin_inventary_get_stocks');
Route::post('/get-special-offers', 'Admin\StockController@getSpecialOffers')->name('admin_inventary_get_special_offers');
Route::post('/add-special-offers', 'Admin\StockController@addSpecialOffers')->name('admin_inventary_add_special_offers');
Route::post('/save-tags', 'Admin\StoreController@saveTags')->name('admin_store_save_tags');


Route::group(['prefix' => 'gmail'], function () {
    Route::get('/', 'Admin\GmailController@index')->name('admin_gmail');
    Route::get('/settings', 'Admin\GmailController@settings')->name('admin_gmail_settings');
    Route::post('/settings', 'Admin\GmailController@postSettings')->name('post_admin_gmail_settings');

    Route::get('analytics-login', 'Admin\Google\GoogleController@getAuthorization')->name('analytics_login');
    Route::get('/oauth/callback', 'Admin\Google\GoogleController@getAnalyticCallBack');

    Route::get('/oauth/gmail/logout', function () {
        LaravelGmail::logout(); //It returns exception if fails
        return redirect()->route('admin_settings_connections');
    })->name('google_log_out');
});


Route::group(['prefix' => 'category'], function () {
    Route::get('/', 'Admin\CategoriesController@list')->name('admin_category');
});
Route::group(['prefix' => 'reports'], function () {
    Route::get('/', 'Admin\ReportsController@getList')->name('admin_reports');
    Route::get('/new', 'Admin\ReportsController@getIndex')->name('admin_reports_new');
});


Route::get('/print-pdf/{id}', 'Admin\OrdersController@printPdf')->name('pdf_download');
Route::get('/fix-barcodes', function () {
    $barcodes = \App\Models\Barcodes::all()->pluck('code');
    foreach ($barcodes as $code) {
        try {
            $path = EAN13render::get($code, public_path('barcodes' . DS . $code . '.png'));
        } catch (Exception $e) {
            echo $code . '<br>';
        }

    }
    dd('finish');
});
Route::get('/datatable-test', function () {
    return view('admin.test');
});

Route::group(['prefix' => 'ebay'], function () {
    Route::get('/', 'Admin\EbayController@settings')->name('admin_ebay');
    Route::get('/listing', 'Admin\EbayController@listing')->name('admin_ebay_listing');
    Route::get('/orders', 'Admin\EbayController@orders')->name('admin_ebay_orders');
    Route::get('/test', 'Admin\EbayController@test')->name('admin_ebay_test');
    Route::get('/app', 'Admin\EbayController@app');
    Route::get('/get-app-token', 'Admin\EbayController@getAppToken')->name('admin_ebay_get_app_token');
    Route::get('/get-user-token', 'Admin\EbayController@getUserToken')->name('admin_ebay_get_user_token');
    Route::get('/auth-accepted', 'Admin\EbayController@getUserTokenBack');
    Route::get('/get-account', 'Admin\EbayController@getAccount')->name('admin_ebay_get_account');

});


Route::group(['prefix' => 'import'], function () {

    Route::get('/', 'Admin\ImportController@index')->name('import_index');

    Route::post('/', 'Admin\ImportController@import')->name('import_import');

//    Route::get('/export', 'Admin\ImportController@export')->name('import_export');

    Route::post("/delete-file", 'Admin\ImportController@delete_file')->name('delete_file');

    Route::post("/add-file", 'Admin\ImportController@add_file')->name('add_file');

    Route::post("/view_file", 'Admin\ImportController@view_file')->name('view_file');
});

Route::group(['prefix' => 'wholesellers'], function () {
    Route::get('/', 'Admin\WholesallersController@index')->name('admin_wholesallers');
    Route::get('/view/{id}', 'Admin\WholesallersController@viewItems')->name('admin_wholesallers_view');
    Route::get('/manage/{id}', 'Admin\WholesallersController@manage')->name('admin_wholesallers_manage');
    Route::get('/synch', 'Admin\WholesallersController@synch')->name('admin_wholesallers_synch');
});
Route::group(['prefix' => 'passport'], function () {
    Route::get('/', 'Admin\PassportController@index')->name('admin_passport');
});


