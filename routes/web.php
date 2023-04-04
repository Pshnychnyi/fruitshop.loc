<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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

Route::group(['prefix' => 'admin', 'namespace' => 'Admin', 'middleware' => 'auth'], function() {
    Route::get('', 'IndexController@index')->name('admin.index');
    Route::resource('category', 'CategoryController');
    Route::resource('tag', 'TagController');
    Route::resource('team', 'TeamController');
    Route::resource('product', 'ProductController');
    Route::resource('user', 'UserController');
    Route::resource('news', 'NewsController');
    Route::resource('comment', 'CommentController');
    Route::resource('permission', 'PermissionController');
    Route::resource('slider', 'SliderController');
    Route::resource('review', 'ReviewController');
    Route::resource('discount', 'DiscountController');

});

Route::group(['namespace' => 'Login'], function() {
    Route::match(['GET', 'POST'], '/login', 'LoginController')->name('login');
    Route::get('/registration', 'RegisterController@index');
    Route::post('/registration', 'RegisterController@createUser')->name('register');
    Route::get('/logout', function() {
        Auth::logout();
        return redirect()->route('login');
    });
});

Route::group(['namespace' => 'Main'], function() {
    Route::get('', 'IndexController@index')->name('main.index');
    Route::get('about', 'AboutController@index')->name('main.about');
    Route::get('contact', 'ContactController@index')->name('main.contact');
    Route::post('contact', 'ContactController@send')->name('main.contact.send');
    Route::get('shop', 'ShopController@index')->name('main.shop');
    Route::get('shop/{shop}', 'ShopController@show')->name('main.shop.show');
    Route::get('news', 'NewsController@index')->name('main.news');
    Route::get('news/{news}', 'NewsController@show')->name('main.news.show');
    Route::post('comment', 'CommentController@store')->name('main.comment');
    Route::get('search', 'SearchController@index')->name('main.search');



    Route::group(['prefix' => 'cart'], function() {
        Route::get('', 'CartController@cart')->name('main.cart');
        Route::get('checkout', 'CartController@checkout')->name('cart.checkout');
        Route::post('storeOrder', 'CartController@storeOrder')->name('cart.storeOrder');
        Route::get('updateCart', 'CartController@UpdateCart')->name('cart.updateCart');
        Route::post('add/{id}', 'CartController@add')->name('cart.add');
        Route::post('remove/{id}', 'CartController@remove')->name('cart.remove');
        Route::post('changeCount/{id}', 'CartController@changeCount')->name('cart.changeCount');
    });
});



