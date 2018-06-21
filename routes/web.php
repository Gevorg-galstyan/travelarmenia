<?php

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
Route::group(
    [
        'prefix' => LaravelLocalization::setLocale(),
        'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath', 'session']
    ],
    function () {
        Route::get('', 'HomeController@index')->name('home');

//        tours route
        Route::get('/tours/{country}', 'TourController@index')->name('tours');
        Route::get('/tour/{slug}', 'TourController@show')->name('tour');
        Route::post('get_tour_book/{slug}', 'TourController@get_book')->name('get_tour_book');
        Route::post('get_tour_book_total/{slug}', 'TourController@get_book_total')->name('get_tour_book_total');
        Route::post('get_tour_order/{slug}', 'TourController@get_tour_order')->name('get_tour_order');


//        hotels route
        Route::get('hotels/{country}/{city?}', 'HotelController@index')->name('hotels');
        Route::get('hotel/{slug}', 'HotelController@show')->name('hotel');
        Route::post('get_hotel_book/{slug}/{room_id?}', 'HotelController@get_book')->name('get_hotel_book');
        Route::post('get_hotel_book_total/{slug}', 'HotelController@get_hotel_book_total')->name('get_hotel_book_total');


//        transports route
        Route::get('transports', 'TransportController@index')->name('transports');
        Route::get('transport/{slug}', 'TransportController@show')->name('transport');
        Route::post('get_transport_book/{slug}', 'TransportController@get_book')->name('get_transport_book');
        Route::post('get_transport_book_total/{slug}', 'TransportController@get_book_total')
            ->name('get_transport_book_total');
//        Apartments route
        Route::get('apartments', 'ApartmentController@index')->name('apartments');
        Route::get('apartment/{slug}', 'ApartmentController@show')->name('apartment');
        Route::post('apartment-search', 'ApartmentController@search')->name('apartment_search');
        Route::post('get_apartment_book/{slug}', 'ApartmentController@get_book')->name('get_apartment_book');
        Route::post('get_apartment_book_total/{slug}', 'ApartmentController@get_book_total')
            ->name('get_apartment_book_total');


//      Excursion route
        Route::get('excursions/{slug?}', 'ExcursionController@index')->name('excursions');
        Route::post('excursions-search', 'ExcursionController@search')->name('excursions_search');
//        Route::get('transport/{slug}', 'TransportController@show')->name('transport');
        Route::post('get_excursion_book/{slug}', 'ExcursionController@get_book')->name('get_excursion_book');
        Route::post('get_excursion_book_total/{slug}', 'ExcursionController@get_book_total')
            ->name('get_excursion_book_total');
        Route::post('excursion_book/{slug}', 'ExcursionController@book')->name('excursion_book');


//        about route
        Route::get('about-{country_slug}/{city_slug?}', 'HomeController@about')->name('about');


//        blog route
        Route::get('blog/{category?}/{tag?}', 'PostController@index')->name('blog');
        Route::get('single/blog/{slug}', 'PostController@show')->name('blog_detail');

//        contact route
        Route::match(['get', 'post'],'contact', 'HomeController@contact')->name('contact');
//        reviews route
//        Route::get('reviews', 'HomeController@reviews')->name('reviews');
        Route::post('save-reviews/{tour_slug?}', 'CommentController@store')->name('save_comment');
        Route::get('reviews/{tour_slug?}', 'CommentController@index')->name('reviews');
//        faq route
        Route::match(['get', 'post'],'faq', 'HomeController@faq')->name('faq');
//        faq route
        Route::get('change_currency', 'HomeController@change_currency')->name('change_currency');
//        subscriber route
        Route::post('subscriber', 'HomeController@subscriber')->name('subscriber');


//        change currency
        Route::match(['get', 'post'], 'change-currency', 'HomeController@change_currency')->name('change_currency');
    });

Route::group(['prefix' => 'admin'], function () {
    Voyager::routes();
    Route::post('change-tour-price', 'Admin\TourController@price_table')->name('price_table');
    Route::post('send-subscribers', 'Admin\AdminController@subscribers')->name('send_subscribers');
});
