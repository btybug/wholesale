<?php


Route::group(['prefix' => 'discounts'], function () {
    Route::get('/', 'Customers\DiscountController@index')->name('app_customer_discounts');
    Route::get('/create', 'Customers\DiscountController@create')->name('app_customer_discounts_create');
    Route::get('/edit/{id}', 'Customers\DiscountController@edit')->name('app_customer_discounts_edit');
    Route::post('/create', 'Customers\DiscountController@postCreate')->name('app_customer_discounts_create_post');
    Route::post('/edit/{id}', 'Customers\DiscountController@postEdit')->name('app_customer_discounts_edit_post');

    Route::get('/offers', 'Customers\DiscountController@offers')->name('app_customer_offers');
    Route::get('/offers/create', 'Customers\DiscountController@offersCreate')->name('app_customer_offers_create');
    Route::get('/offers/edit/{id}', 'Customers\DiscountController@offersEdit')->name('app_customer_offers_edit');
    Route::post('/offers/create', 'Customers\DiscountController@postOffersCreate')->name('app_customer_offers_create_post');
    Route::post('/offers/edit/{id}', 'Customers\DiscountController@postOffersEdit')->name('app_customer_offers_edit_post');

    Route::post('/on-off', 'Customers\DiscountController@postOnOff')->name('app_customer_discount_on_off');
    Route::post('/offers/on-off', 'Customers\DiscountController@postOffersOnOff')->name('app_customer_offers_discount_on_off');
});
Route::group(['prefix' => 'staff'], function () {
    Route::get('/{id?}', 'Customers\StaffController@getStaff')->name('app_staff');
    Route::post('/manage-staff', 'Customers\StaffController@postCreateStaffMember')->name('app_staff_add');
    Route::get('/view-staff-member/{id}', 'Customers\StaffController@getViewStaffMember')->name('app_staff_view');
    Route::get('/roles', 'Customers\StaffController@getRoles')->name('app_staff_roles');
    Route::get('/manage-role/{id?}', 'Customers\StaffController@getCreateRole')->name('app_staff_roles_create');
    Route::post('/manage-role/{id?}', 'Customers\StaffController@postCreateOrEditRole')->name('app_staff_roles_create');

    Route::get('/add-permission/{id}/{w_id}', 'Customers\StaffController@getStaffPermission')->name('app_staff_add_permission');
    Route::post('/add-permission/{id}/{w_id}', 'Customers\StaffController@postStaffPermission');
    Route::get('/permissions', 'Customers\StaffController@getAppPermissions')->name('app_permissions');

    Route::get('/badge/{id}/{warehouse_id}', 'Customers\StaffController@getAppBadge')->name('app_staff_badge');

});

    Route::group(['prefix' => 'products'], function () {
        Route::get('/{id?}', 'AppController@products')->name('admin_app_products');
        Route::post('/add-product', 'AppController@addProduct')->name('admin_app_add_product');
        Route::post('/import-shop', 'AppController@importShop')->name('admin_app_import_shop');
        Route::post('/activate/{id}', 'AppController@activateProduct')->name('admin_app_activate_product');
        Route::post('/draft/{id}', 'AppController@draftProduct')->name('admin_app_draft_product');

        Route::get('/activate-shop/{id}', 'AppController@activateShop')->name('admin_app_activate_shop');
        Route::get('/draft-shop/{id}', 'AppController@draftShop')->name('admin_app_draft_shop');
        Route::get('/drop-shop/{id}', 'AppController@removeShop')->name('admin_app_drop_shop');
        Route::post('/multi-edit-price', 'AppController@multiEditPrice')->name('admin_app_multi_edit_price');

    });
    Route::group(['prefix' => 'settings'], function () {
        Route::get('/{id?}', 'AppController@getSettings')->name('admin_app_settings');
        Route::post('/save', 'AppController@saveSettings')->name('admin_app_settings_save');

    });
    Route::group(['prefix' => 'orders'], function () {
        Route::get('/{id?}', 'AppController@orders')->name('admin_app_orders');
        Route::get('/view/{id}', 'AppController@orderViev')->name('admin_app_order_view');
    });
    Route::post('/warehouse-not-selected-items/{id}', 'AppController@notSelectedProducts')->name('admin_app_not_selected_products');
    Route::post('/warehouse-not-selected-items/{id}', 'AppController@notSelectedProducts')->name('admin_app_not_selected_products');
