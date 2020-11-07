<?php

use Illuminate\Support\Facades\Route;

Route::post('new-company', 'CompanyController@start');
Route::get('all-makes', 'CarMakeController@index');
Route::get('search-makes', 'CarMakeController@searchMakes');
Route::get('model-by-make', 'CarModelController@getModelsByMake');
Route::get('search-trim', 'CarModelDescriptionController@searchTrim');
Route::get('years-by-model', 'CarModelDescriptionController@getYearsByModel');
Route::get('category-by-model', 'CarModelDescriptionController@getCategoriesByModel');
Route::get('last-cars', 'AdvertisementController@getLastCars');
Route::get('car-detail/{advertisement}', 'AdvertisementController@show');
Route::get('car-model-description/{id}', 'CarModelDescriptionController@getData');
Route::get('dealers-by-city', 'DealerController@getAllDealersByCity');
Route::get('search', 'AdvertisementController@search');
Route::post('contact-us', 'ContactUsController@contact');
Route::get('cities-dealers', 'DealerController@citiesDealers');
Route::get('dealers-city/{city_id}', 'DealerController@dealersByCity');
Route::get('dealer/{dealer_id}', 'DealerController@dealerDetail');
Route::get('search-zipcode/{number}', 'ZipcodeController@search');
Route::get('lat-lng-maps', 'AddressController@getLatLngMapsGoogle');

Route::middleware('auth:api')->group(function () {

    Route::get('users/info', 'UserController@info');
    Route::resources(
        [
            'addresses'      => 'AddressController',
            'advertisements' => 'AdvertisementController',
            'companies'      => 'CompanyController',
            'dealers'        => 'DealerController',
            'gallery'        => 'GalleryController',
            'people'         => 'PersonController',
            'users'          => 'UserController',
        ]
    );
});
