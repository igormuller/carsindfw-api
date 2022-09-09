<?php

use Illuminate\Support\Facades\Route;

/*
Route::get('check-vin/{vin_number}', 'AdvertisementController@vinCheck');
Route::post('new-company', 'CompanyController@start');
Route::get('all-makes', 'CarMakeController@index');

Route::post('model-by-make', 'CarModelController@getModelsByMake');
Route::get('search-trim', 'CarModelDescriptionController@searchTrim');
Route::get('years-by-model', 'CarModelDescriptionController@getYearsByModel');
Route::get('category-by-model', 'CarModelDescriptionController@getCategoriesByModel');
Route::get('last-cars', 'AdvertisementController@getLastCars');
Route::get('car-detail/{advertisement}', 'AdvertisementController@show');
Route::get('car-model-description/{id}', 'CarModelDescriptionController@getData');
Route::get('dealers-by-city', 'DealerController@getAllDealersByCity');
Route::get('cities/{state_id}', 'CityController@getCitiesByState');
Route::get('search', 'AdvertisementController@search');
Route::post('contact-us', 'ContactUsController@contact');
Route::get('cities-dealers', 'DealerController@citiesDealers');
Route::get('dealers-city/{city_id}', 'DealerController@dealersByCity');
Route::get('dealer/{dealer_id}', 'DealerController@dealerDetail');
Route::get('search-zipcode/{number}', 'ZipcodeController@search');
Route::get('lat-lng-maps', 'AddressController@getLatLngMapsGoogle');
Route::post('register-interest', 'InterestController@register');
Route::get('verify-token/{id}', 'UserController@checkVerifyToken');
Route::get('new-verify-token/{email}', 'UserController@newVerifyToken');
Route::get('list-plan-types', 'PlanTypeController@listPlanTypes');
Route::get('promotion-code/{promotion_code}', 'PaymentController@getPromotionCode');
//Route::post('process-cars', 'CarMakeController@processCars');

Route::middleware('access-broker')->prefix('broker')->group(function () {
    Route::get('teste', function () {
       dd("aqui");
    });
    Route::get('detail', 'BrokerController@detail');
});

Route::middleware(['auth:api','verified'])->group(function () {

    Route::get('users/info', 'UserController@info');

    Route::post('gallery-dealer/{dealer_id}', 'GalleryDealerController@store');
    Route::post('gallery-advertisement/{advertisement_id}', 'GalleryAdvertisementController@store');
    Route::put('gallery-advertisement/{id}/default', 'GalleryAdvertisementController@default');
    Route::get('gallery-advertisement/{advertisement_id}', 'GalleryAdvertisementController@getGallery');

    Route::get('payment-general-detail', 'PaymentController@detailGeneral');
    Route::get('payment-customer-detail', 'PaymentController@detailCustomer');
    Route::get('payment-method-detail', 'PaymentController@detailPaymentMethod');
    Route::get('payment-intent-detail', 'PaymentController@detailPaymentIntent');
    Route::get('payment-subscription-detail', 'PaymentController@detailSubscription');
    Route::get('payment-invoice-detail', 'PaymentController@detailInvoice');
    Route::get('cancel-subscription', 'PaymentController@cancelSubscription');
    Route::post('new-payment-method', 'PaymentController@newPaymentMethod');
    Route::put('default-payment-method', 'PaymentController@defaultPaymentMethod');
    Route::delete('delete-payment-method/{id}', 'PaymentController@deletePaymentMethod');
    Route::post('contract-new-plan', 'PaymentController@contractNewPlan');
    Route::post('new-subscription', 'PaymentController@newSubscription');
    Route::post('change-subscription', 'PaymentController@changeSubscription');

    Route::resources(
        [
            'addresses'      => 'AddressController',
            'advertisements' => 'AdvertisementController',
            'cities'         => 'CityController',
            'companies'      => 'CompanyController',
            'dealers'        => 'DealerController',
            'interests'      => 'InterestController',
            'people'         => 'PersonController',
            'states'         => 'StateController',
            'users'          => 'UserController',
        ]
    );
    
});
*/