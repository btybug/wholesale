<?php
/**
 * Created by PhpStorm.
 * User: sahak
 * Date: 31.12.2017
 * Time: 00:09
 */

Route::group(['prefix'=>'datatables'],function(){
    Route::get('/users/get-all','Admin\DatatableController@getAllUsers')->name('datatable_all_users');
    Route::get('/users/staff','Admin\DatatableController@getAllStaff')->name('datatable_all_staff');
    Route::get('/users/campaign','Admin\DatatableController@getCampaigns')->name('datatable_all_campigns');
    Route::get('/store/categories/get-all','Admin\DatatableController@getAllCategories')->name('datatable_all_categories');
    Route::get('/store/products/get-all','Admin\DatatableController@getAllProducts')->name('datatable_all_products');
    Route::get('/store/attributes/get-all','Admin\DatatableController@getAllAttributes')->name('datatable_all_attributes');
    Route::get('/roles/get-all','Admin\DatatableController@getAllRoles')->name('datatable_all_roles');
    Route::get('/mail-templates/get-all','Admin\DatatableController@getAllMailTemplates')->name('datatable_all_mail_templates');
    Route::get('/email/get-all','Admin\DatatableController@getAllEmails')->name('datatable_all_emails');
    Route::get('/newsletters-all','Admin\DatatableController@getAllNewsletters')->name('datatable_all_newsletters');
    Route::get('/blog/get-all','Admin\DatatableController@getAllPosts')->name('datatable_all_posts');
    Route::get('/blog/get-all-brands','Admin\DatatableController@getAllBrands')->name('datatable_all_brands');
    Route::get('/blog/get-contact-us','Admin\DatatableController@getAllContactUs')->name('datatable_all_contact_us');
    Route::get('/coupons/get-all/{is_archive}','Admin\DatatableController@getAllCoupons')->name('datatable_all_coupons');
    Route::get('/blog/comments/get-all','Admin\DatatableController@getAllPostComments')->name('datatable_all_post_comments');
    Route::get('/blog/reviews/get-all','Admin\DatatableController@getAllReviews')->name('datatable_reviews');
    Route::get('/stock/get-all','Admin\DatatableController@getAllStocks')->name('datatable_all_stocks');
    Route::get('/stock/get-all-offer','Admin\DatatableController@getAllStockOffers')->name('datatable_all_stocks_offers');
    Route::get('/settings/get-all-geo-zones','Admin\DatatableController@getAllGeoZones')->name('datatable_all_geo_zones');
    Route::get('/settings/get-user-activity/{id}','Admin\DatatableController@getUserActivity')->name('datatable_user_activity');
    Route::get('/settings/get-post-user-activity/{id}','Admin\DatatableController@getUserPostActivity')->name('datatable_user_post_activity');
    Route::get('/settings/get-frontend-activity','Admin\DatatableController@getFrontendActivity')->name('datatable_frontend_activity');
    Route::get('/settings/get-backend-activity','Admin\DatatableController@getBackendActivity')->name('datatable_backend_activity');

    Route::get('/settings/get-all-orders','Admin\DatatableController@getAllOrders')->name('datatable_all_orders');
    Route::get('/settings/get-all-orders-invoice','Admin\DatatableController@getAllOrdersInvoice')->name('datatable_all_orders_invoice');
    Route::get('/settings/get-user-orders/{user_id}','Admin\DatatableController@getUserOrders')->name('datatable_user_orders');
    Route::get('/settings/get-all-statuses','Admin\DatatableController@getAllStatuses')->name('datatable_all_statuses');
    Route::get('/settings/get-bulk-posts','Admin\DatatableController@getBulkPosts')->name('datatable_bulk_posts');
    Route::get('/settings/get-bulk-brands','Admin\DatatableController@getBulkBrands')->name('datatable_bulk_brands');
    Route::get('/settings/get-bulk-stock','Admin\DatatableController@getBulkStock')->name('datatable_bulk_stocks');
    Route::get('/tickets/get-all','Admin\DatatableController@getTickets')->name('datatable_tickets');
    Route::get('/faq/get-all','Admin\DatatableController@getFaq')->name('datatable_all_faq');
    Route::get('/store/get-purchases','Admin\DatatableController@getPurchases')->name('datatable_all_purchases');
    Route::get('/items/purchases/{item_id}','Admin\DatatableController@getItemPurchases')->name('datatable_item_purchases');
    Route::get('/items/others/{item_id}','Admin\DatatableController@getItemOthers')->name('datatable_item_others');
    Route::get('/items/sales/{item_id}','Admin\DatatableController@getItemSales')->name('datatable_item_sales');

    Route::get('/store/get-items','Admin\DatatableController@getAllItems')->name('datatable_all_items');
    Route::get('/store/get-app-items/{id}','Admin\DatatableController@getAllAppItems')->name('datatable_all_app_items');
    Route::post('/store/get-items-in-modal','Admin\DatatableController@getAllItemsInModal')->name('datatable_all_items_in_modal');
    Route::get('/store/get-items-archived','Admin\DatatableController@getAllItemsArchived')->name('datatable_all_items_archive');
    Route::get('/inventory/get-all-suppliers','Admin\DatatableController@getAllSuppliers')->name('datatable_all_suppliers');
    Route::get('/inventory/get-all-others/{id?}','Admin\DatatableController@getAllOthers')->name('datatable_all_others');
    Route::get('/inventory/get-all-channels','Admin\DatatableController@getAllChannels')->name('datatable_all_channels');

    Route::get('/emails-notifications/get-all-custom-emails','Admin\DatatableController@getAllCustomEmails')->name('datatable_all_custom_emails');
    Route::get('/inventory/get-all-channel-customers/{id?}','Admin\DatatableController@getAllChannelCustomers')->name('datatable_all_channel_customers');
    Route::get('/settings/get-all-transactions','Admin\DatatableController@getAllTransactions')->name('datatable_all_transactions');
    Route::get('/inventory/get-all-barcodes','Admin\DatatableController@getAllBarcodes')->name('datatable_all_barcodes');
    Route::get('/inventory/get-all-filters','Admin\DatatableController@getAllFilters')->name('datatable_all_filters');

    Route::get('/inventory/get-all-warehouses','Admin\DatatableController@getAllWarehouses')->name('datatable_all_warehouses');
    Route::get('/inventory/get-all-transfers','Admin\DatatableController@getAllTransfers')->name('datatable_all_transfers');

    Route::get('/stock/get-promotions','Admin\DatatableController@getAllPromotions')->name('datatable_all_promotions');

    Route::get('/get-landings','Admin\DatatableController@getAllLandings')->name('datatable_all_landings');
    Route::get('/get-app-staff','Admin\DatatableController@getAllAppStaff')->name('datatable_all_app_staff');
    Route::get('/get-app-orders','Admin\DatatableController@getAllAppOrders')->name('datatable_all_app_orders');

});


