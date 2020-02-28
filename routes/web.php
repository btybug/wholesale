<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Auth::routes();
Auth::routes(['verify' => true]);
//Route::get('/home', 'HomeController@index')->name('home');
Route::middleware('auth')->group(function () {
    Route::get('/', 'Frontend\ProductsController@index')->name('home');

    Route::group(['prefix' => 'news'], function () {
        Route::get('/', 'Frontend\BlogController@index')->name('blog');
        Route::get('/{post_id}', 'Frontend\BlogController@getSingle')->name('blog_post');
    });
    Route::group(['prefix' => 'brands'], function () {
        Route::get('/{type?}', 'Frontend\BrandsController@index')->name('brands');
    });
    Route::post('/get-brand', 'Frontend\BrandsController@postBrand')->name('post_brand');
    Route::post('/get-category-products', 'Frontend\BrandsController@postCategoryProducts')->name('post_category_products');
    Route::post('/get-brand-list', 'Frontend\BrandsController@postBrandProducts')->name('post_brand_list');

    Route::group(['prefix' => 'offers'], function () {
        Route::get('/{type?}', 'Frontend\OffersController@getIndex')->name('product_offers');
    });
    Route::post('/get-offer', 'Frontend\OffersController@postOffer')->name('post_offers');

    Route::group(['prefix' => 'stickers'], function () {
        Route::get('/{type?}', 'Frontend\StickersController@index')->name('stickers');
    });
    Route::post('/get-sticker', 'Frontend\StickersController@postSticker')->name('post_sticker');
    Route::post('/get-category-products-stickers', 'Frontend\StickersController@postCategoryProducts')->name('post_category_products_stickers');


    Route::post('/add-comment', 'Frontend\CommentController@addComment')->name('comment_create_post');
    Route::post('/delete-comment', 'Frontend\CommentController@deleteComment')->name('comment_delete_post');


    Route::group(['prefix' => 'products'], function () {
        Route::post('/get-price', 'Frontend\ProductsController@getPrice')->name('product_get_price');
        Route::post('/add-offer', 'Frontend\ProductsController@addOffer')->name('product_add_offer');
        Route::post('/get-package-type-limit', 'Frontend\ProductsController@getPackageTypeLimit')->name('product_get_package_type_limit');
        Route::post('/get-subtotal-price', 'Frontend\ProductsController@getSubtotalPrice')->name('product_get_subtotal_price');
        Route::post('/get-product-variations', 'Frontend\ProductsController@getVariations')->name('product_get_variations');
        Route::post('/get-variation-menu-raw', 'Frontend\ProductsController@getVariationMenuRaw')->name('product_get_variation_menu_raw');
        Route::post('/get-offer-menu-raw', 'Frontend\ProductsController@getOfferMenuRaw')->name('product_get_offer_menu_raw');
        Route::post('/get-offer-menu-raws', 'Frontend\ProductsController@getOfferMenuRaws')->name('product_get_offer_menu_raws');
        Route::post('/get-variation-menu-raws', 'Frontend\ProductsController@getVariationMenuRaws')->name('product_get_variation_menu_raws');
        Route::post('/add-to-favorites', 'Frontend\ProductsController@attachFavorite')->name('product_add_to_favorites');
        Route::post('/remove-from-favorites', 'Frontend\ProductsController@detachFavorite')->name('product_remove_from_favorites');
        Route::post('/select-items', 'Frontend\ProductsController@postSelectItems')->name('product_variation_items');
        Route::post('/search-items', 'Frontend\ProductsController@postSearchItems')->name('product_search_items');
        Route::post('/get-extra-content', 'Frontend\ProductsController@postExtraContent')->name('product_extra_content');
        Route::post('/get-extra-item', 'Frontend\ProductsController@postExtraItem')->name('product_extra_item');
        Route::post('/get-discount-price', 'Frontend\ProductsController@getDiscountPrice')->name('product_discount_price');
        Route::get('/{type?}', 'Frontend\ProductsController@index')->name('categories_front');
        Route::post('/{type?}', 'Frontend\ProductsController@index')->name('categories_front_post');
        Route::group(['prefix' => '{type}'], function () {
            Route::get('/{slug}', 'Frontend\ProductsController@getSingle')->name('product_single');
        });
    });

    Route::get('/forum', 'Frontend\CommonController@getForum')->name('forum');
    Route::post('/change-currency', 'Frontend\CommonController@changeCurrency')->name('change_currency');
    Route::group(['prefix' => '/support'], function () {
        Route::get('/', 'Frontend\CommonController@getSupport')->name('product_support');

        Route::get('/faq', 'GuestController@getFaq')->name('faq_page');
        Route::get('/faq/{slug}', 'GuestController@getFaqSingle')->name('faq_page_single');
        Route::post('/faq-by-category', 'GuestController@getFaqByCategory')->name('faq');

        Route::get('/terms-&-conditions', 'GuestController@getTermsConditions')->name('terms_conditions');
        Route::get('/delivery', 'GuestController@getDelivery')->name('delivery');
        Route::post('/get-cities', 'GuestController@getCities')->name('delivery_get_countries');

        if (\App\Models\Gmail::check()) {
            Route::get('/contact-us', 'GuestController@getContactUs')->name('support_contact_us');
            Route::post('/contact-us', 'GuestController@postContactUs')->name('post_contact_us');
        }
    });

    Route::get('/landings/{url}', 'GuestController@landings')->name('landings');

    Route::get('/about-us', 'Frontend\CommonController@getAboutUs')->name('about_us');
    Route::get('/privacy', 'Frontend\CommonController@getPrivacy')->name('privacy');
    Route::get('/cookies', 'Frontend\CommonController@getCookies')->name('cookies');
    Route::post('/get-regions-by-country', 'GuestController@getRegionsByCountry')->name('get_regions_by_country');
    Route::post('/get-regions-by-geozone', 'GuestController@getRegionsByGeoZone')->name('get_regions_by_geozone');
    Route::post('/subscribe-to-newsletter', 'Frontend\CommonController@postSubscribe')->name('subscribe_to_newsletter');


    Route::get('/forum', 'Frontend\ForumController@index')->name('forum');
    Route::get('/shop', 'Frontend\ShoppingCartController@index')->name('shop');
    Route::get('/my-cart', 'Frontend\ShoppingCartController@getCart')->name('shop_my_cart');
    Route::post('/my-cart-special-offer', 'Frontend\ShoppingCartController@postSpecialOfferModal')->name('shop_my_cart_special_offer_modal');
    Route::get('/check-out', 'Frontend\ShoppingCartController@getCheckOut')->name('shop_check_out');
    Route::get('/payment/{token}', 'Frontend\ShoppingCartController@getPayment')->name('shop_payment');
    Route::post('/add-to-cart', 'Frontend\ShoppingCartController@postAddToCart')->name('shop_add_to_cart');
    Route::post('/add-extra-to-cart', 'Frontend\ShoppingCartController@postAddExtraToCart')->name('shop_add_extra_to_cart');
    Route::post('/update-cart', 'Frontend\ShoppingCartController@postUpdateQty')->name('shop_update_cart');
    Route::post('/remove-from-cart', 'Frontend\ShoppingCartController@postRemoveFromCart')->name('shop_remove_from_cart');
    Route::post('/change-shipping-method', 'Frontend\ShoppingCartController@postChangeShippingMethod')->name('change_shipping_method');
    Route::post('/get-payment-options', 'Frontend\ShoppingCartController@postPaymentOptions')->name('get_payment_options');
    Route::post('/cash-order', 'Frontend\CashPaymentController@order')->name('cash_order');
    Route::get('/cash-order-success/{id}', 'Frontend\CashPaymentController@success')->name('cash_order_success');
    Route::post('/apply-coupon', 'Frontend\ShoppingCartController@postApplyCoupon')->name('apply_coupon');


    Route::group(['prefix' => 'my-account', 'middleware' => ['auth', 'verified']], function () {
        Route::get('/', 'Frontend\UserController@index')->name('my_account');
        Route::post('/', 'Frontend\UserController@saveMyAccount')->name('my_account_save_data');
        Route::post('/contact', 'Frontend\UserController@saveMyAccountContact')->name('my_account_save_contact_data');
        Route::post('/profile-image', 'Frontend\UserController@postProfileImageUpload')->name('profile_image_upload');
        Route::post('/delete-avatar', 'Frontend\UserController@postProfileImageDelete')->name('profile_image_delete');

        Route::get('/messages', 'Frontend\UserController@getNotifications')->name('messages');
        Route::post('/notifications', 'Frontend\UserController@getNotificationsContent')->name('notifications_content');
        Route::post('/delete-notifications', 'Frontend\UserController@postDeleteNotifications')->name('notifications_delete');
        Route::post('/mark-us-read-notifications', 'Frontend\UserController@postMarkReadNotifications')->name('notifications_mark_read');
        Route::post('/mark-us-unread-notifications', 'Frontend\UserController@postMarkUnreadNotifications')->name('notifications_mark_unread');
        Route::post('/save-email-settings', 'Frontend\UserController@postEmailSettings')->name('account_email_settings');

        Route::post('/changePassword', 'Frontend\UserController@changePassword')->name('my_account_change_password');
        Route::get('/logs', 'Frontend\UserController@getLogs')->name('my_account_logs');
        Route::get('/password', 'Frontend\UserController@getPassword')->name('my_account_password');
        Route::get('/favourites', 'Frontend\UserController@getFavourites')->name('my_account_favourites');

        Route::post('/add_favourites', 'Frontend\UserController@attachFavorite')->name('add_favourites');
        Route::post('/delete_favourites', 'Frontend\UserController@detachFavorite')->name('delete_favourites');

        Route::get('/address', 'Frontend\UserController@getAddress')->name('my_account_address');
        Route::post('/address', 'Frontend\UserController@postAddress')->name('post_my_account_address');
        Route::post('/address-book-form', 'Frontend\UserController@postAddressBookForm')->name('post_my_account_address_book_form');
        Route::post('/save-address-book', 'Frontend\UserController@postAddressBookSave')->name('post_my_account_address_book_save');
        Route::post('/select-address-book', 'Frontend\UserController@postAddressBookSelect')->name('post_my_account_address_book_select');
        Route::group(['prefix' => 'orders'], function () {
            Route::get('/', 'Frontend\UserController@getOrders')->name('my_account_orders');
            Route::get('/invoice/{id}', 'Frontend\UserController@getOrderInvoice')->name('my_account_order_invoice');
            Route::get('/reviews/{id}', 'Frontend\UserController@getOrderReviews')->name('my_account_order_reviews');
            Route::post('/reviews/{id}', 'Frontend\UserController@postOrderReviews')->name('my_account_order_reviews_post');
        });
        Route::group(['prefix' => 'tickets'], function () {
            Route::get('/', 'Frontend\UserController@getTickets')->name('my_account_tickets');
            Route::get('/new', 'Frontend\UserController@getTicketsNew')->name('my_account_tickets_new');
            Route::post('/new', 'Frontend\UserController@postTicketsNew')->name('my_account_tickets_new_post');
            Route::post('/category-select', 'Frontend\UserController@postTicketsCategory');
            Route::get('/view/{id}', 'Frontend\UserController@getTicketsView')->name('my_account_tickets_view');
            Route::post('/mark-complete/{id}', 'Frontend\UserController@ticketMarkCompleted')->name('my_account_tickets_mark_completed');
        });
        Route::group(['prefix' => 'referrals'], function () {
            Route::get('/', 'Frontend\ReferralsController@getIndex')->name('my_account_referrals');
            Route::post('/set-referred-by', 'Frontend\ReferralsController@postReferredBy')->name('post_my_account_referrals');
            Route::get('/claim-bonus/{id}', 'Frontend\ReferralsController@getClaimBonus')->name('my_account_referrals_claim_bonus');
        });
        Route::group(['prefix' => 'special-offers'], function () {
            Route::get('/', 'Frontend\SpecialOffersController@getIndex')->name('my_account_special_offers');
        });
        Route::get('/verification', 'Frontend\UserController@getVerification')->name('my_account_verification');
        Route::post('/verification', 'Frontend\UserController@postVerification')->name('post_my_account_verification');
        Route::get('/payments', 'Frontend\UserController@getPayments')->name('my_account_payment');
    });
    Route::group(['prefix' => 'filters'], function () {
        Route::post('/', 'Frontend\FilterApiControll@postGetNext');
        Route::post('/render-tabs', 'Frontend\FilterApiControll@postRenderTabs');
    });
    Route::group(['prefix' => 'search'], function () {
        Route::post('/', 'Frontend\SearchControll@postSearch')->name('frontend_search');
    });
});
Route::get('/redirect', 'Auth\OauthLoginController@gatCode')->name('redirect_login');
Route::get('/callback', 'Auth\OauthLoginController@Callback');
