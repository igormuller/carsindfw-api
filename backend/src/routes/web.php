<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\SiteController;

Route::get('/', [HomeController::class, 'index'])->name('index');
Route::get('/home', [HomeController::class, 'home'])->name('home');

Route::get('/benefits', [SiteController::class, 'benefits'])->name('benefits');
Route::get('/terms-of-service', [SiteController::class, 'termsOfService'])->name('terms-of-service');
Route::get('/about', [SiteController::class, 'about'])->name('about');
Route::get('/dallas-history', [SiteController::class, 'dallasHistory'])->name('dallas-history');
Route::get('/privacy-police', [SiteController::class, 'privacyPolice'])->name('privacy-police');
Route::get('/fraud-awareness', [SiteController::class, 'fraudAwareness'])->name('fraud-awareness');
Route::get('/find-car', [SiteController::class, 'findCar'])->name('find-car');
Route::get('/find-dealer/{city?}', [SiteController::class, 'findDealer'])->name('find-dealer');

Route::get('/car-list', [SiteController::class, 'carList'])->name('car-list');
//Route::get('/car-detail', [SiteController::class, 'carDetail'])->name('car-detail1');
Route::get('/car-detail/{car}', [SiteController::class, 'carDetail'])->name('car-detail');
//Route::get('/dealer-detail', [SiteController::class, 'dealerDetail'])->name('dealer-detail1');
Route::get('/dealer-detail/{dealer}', [SiteController::class, 'dealerDetail'])->name('dealer-detail');
Route::get('/dealer-plan', [SiteController::class, 'dealerPlan'])->name('dealer-plan');
Route::get('/person-plan', [SiteController::class, 'personPlan'])->name('person-plan');
Route::get('/contact', [SiteController::class, 'contact'])->name('contact');
Route::post('contact-us', 'ContactUsController@contact')->name('contact-post');
Route::post('new-company', 'CompanyController@start')->name('new-company');

Route::post('search-makes', [SiteController::class, 'searchMakes'])->name('search-makes');
Route::post('search-models', [SiteController::class, 'searchModels'])->name('search-models');
Route::post('search-params', [SiteController::class, 'searchParams'])->name('search-params');
Route::post('search-fuels', [SiteController::class, 'searchFuels'])->name('search-fuels');
Route::post('search-years', [SiteController::class, 'searchYears'])->name('search-years');
Route::post('search-drives', [SiteController::class, 'searchDrives'])->name('search-drives');
Route::post('search-transmissions', [SiteController::class, 'searchTransmissions'])->name('search-transmissions');
Route::post('search-bodies', [SiteController::class, 'searchBodies'])->name('search-bodies');

Route::post('search-cars', [SiteController::class, 'searchCars'])->name('search-cars');
