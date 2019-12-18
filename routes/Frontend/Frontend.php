<?php

/**
 * Frontend Controllers
 * All route names are prefixed with 'frontend.'.
 */
Route::get('/', 'FrontendController@index')->name('index');
/*Route::get('/', function(){
    return redirect()->route('admin.dashboard');
})->name('index');*/
Route::get('macros', 'FrontendController@macros')->name('macros');
Route::get('contact', 'ContactController@index')->name('contact');
Route::post('contact/send', 'ContactController@send')->name('contact.send');
Route::get('login', 'ContactController@loginPage')->name('login');
Route::get('auth/login', 'ContactController@loginPage')->name('auth.login');

Route::get('about-us', 'PageController@aboutUs')->name('page.about-us');
Route::get('press', 'PageController@press')->name('page.press');
Route::get('store', 'PageController@store')->name('page.store');
Route::get('contact-us', 'PageController@contactUs')->name('page.contact-us');

Route::get('history', 'PageController@history')->name('page.history');
Route::get('awards-certifications', 'PageController@awardsCertifications')->name('page.awards-certifications');
Route::get('terms-conditions', 'PageController@termsConditions')->name('page.terms-conditions');
Route::get('privacy-policy', 'PageController@privacyPolicy')->name('page.privacy-policy');
Route::get('return-policy', 'PageController@returnPolicy')->name('page.return-policy');
Route::get('show-room', 'PageController@showRoom')->name('page.show-room');
Route::get('cleaning-restoration', 'PageController@cleaningRestoration')->name('page.cleaning-restoration');
Route::get('rug-school', 'PageController@rugSchool')->name('page.rug-school');
Route::get('hospitality', 'PageController@hospitality')->name('page.hospitality');
Route::get('become-dealer', 'PageController@becomeDealer')->name('page.become-dealer');
Route::get('careers', 'PageController@careers')->name('page.careers');
Route::get('site-map', 'PageController@siteMap')->name('page.site-map');
Route::get('faq', 'PageController@faq')->name('page.faq');
Route::get('padding', 'PageController@padding')->name('page.padding');
Route::post('contact-submit', 'PageController@contactSubmit')->name('page.contact-submit');
Route::post('dealer-submit', 'PageController@dealerSubmit')->name('page.dealer-submit');
Route::get('return-policy', 'PageController@termsConditions')->name('page.return-policy');
Route::get('get-estimate', 'ContactController@getEstimate')->name('contact.get-estimate');
Route::post('get-estimate/send', 'ContactController@sendEstimate')->name('contact.get-estimate.send');

/*
 * These frontend controllers require the user to be logged in
 * All route names are prefixed with 'frontend.'
 */
Route::group(['middleware' => 'auth'], function () {
    Route::group(['namespace' => 'User', 'as' => 'user.'], function () {
        /*
         * User Dashboard Specific
         */
        Route::get('dashboard', 'DashboardController@index')->name('dashboard');

        /*
         * User Account Specific
         */
        Route::get('account', 'AccountController@index')->name('account');

        /*
         * User Profile Specific
         */
        Route::patch('profile/update', 'ProfileController@update')->name('profile.update');
    });
});

Route::group(['namespace' => 'Product', 'as' => 'product.'], function () {
    Route::get('/products/{category_id}', 'ProductController@index')->name('index');
    Route::get('/product/{product_id}', 'ProductController@show')->name('show');
    Route::get('/product/rate/{product_id}/{size_id}', 'ProductController@rate')->name('rate');
    Route::get('/product/getQuantity/{product_id}/{size_id}', 'ProductController@getQuantity')->name('getQuantity');
    Route::get('/new-arrival', 'ProductController@newArrival')->name('new-arrival');
    Route::get('/products', 'ProductController@index')->name('product-by-type');
    Route::get('/add-favourites', 'ProductController@addFavourites')->name('add-favourites');
    Route::get('/favourites', 'ProductController@favourites')->name('favourites');
    Route::get('advance-search', 'ProductController@advanceSearch')->name('advance-search');
    Route::get('get-suggestion', 'ProductController@getSuggestion')->name('');
    Route::post('write-review', 'ProductController@writeReview')->name('write-review');
    Route::post('add-to-cart', 'ProductController@addToCart')->name('add-to-cart');
    Route::post('makean-offer', 'ProductController@makeanOffer')->name('makean-offer');
    Route::post('makean-offer-user', 'ProductController@makeAnOfferUser')->name('makean-offer-user');


});

Route::group(['namespace' => 'Checkout', 'as' => 'checkout.', 'prefix' => 'checkout'], function () {
    Route::get('cart', 'CheckoutController@cart')->name('cart');
    Route::post('cart-update', 'CheckoutController@cartUpdate')->name('cart-update');
    Route::get('cart/remove-item/{id}', 'CheckoutController@removeItemFromCart')->name('cart.remove-item');
    Route::get('checkout', 'CheckoutController@checkout')->name('checkout');
    Route::get('guestCheckout', 'CheckoutController@guestCheckout')->name('guestCheckout');
    Route::post('add_user_address', 'CheckoutController@AddUserAddress')->name('add_user_address');
    Route::post('add_guest_address', 'CheckoutController@AddGuestAddress')->name('add_guest_address');
    Route::post('apply-promo', 'CheckoutController@applyPromo')->name('apply-promo');
    Route::get('remove-promo', 'CheckoutController@removePromo')->name('remove-promo');
    Route::get('before-payment', 'CheckoutController@beforePaypalPayment')->name('before-payment');
    Route::get('payment/success', 'CheckoutController@afterPayment')->name('after-payment');
    Route::get('payment/status', 'CheckoutController@getPaymentStatus')->name('after-payment-status');
    Route::get('overview', 'CheckoutController@overview')->name('overview');
    //Route::get('addmoney/stripe', array('as' => 'addmoney.paystripe','uses' => 'CheckoutController@PaymentStripe'));
    Route::post('stripe', array('as' => 'stripe','uses' => 'CheckoutController@postPaymentStripe'));
});

Route::post('email-subscription', 'FrontendController@emailSubscription')->name('email-subscription');
Route::post('mailing-submit', 'PageController@mailingSubmit')->name('page.mailing-submit');
Route::get('coupons', 'PageController@coupons')->name('page.coupons');

/*Route::group(['namespace' => 'Wishlist', 'as' => 'wishlist.', 'prefix' => 'wishlist'], function () {
    Route::get('add/{product_id}', 'WishlistController@addToWishlist')->name('add');
});*/
Route::group(['middleware' => 'auth', 'namespace' => 'Account', 'as' => 'account.', 'prefix' => 'account'], function () {
    Route::get('my-account', 'AccountController@myAccount')->name('my-account');
});

