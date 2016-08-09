<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::any('memberRegistration','RegistrationController@index');
Route::any('Registration/store','RegistrationController@store');
Route::any('individualRegistration','RegistrationController@indvReg');
Route::any('individualRegistration/store','RegistrationController@storeIndvReg');
Route::any('logistiks/Buyersearch','LogistiksController@buyerSearch');

Route::any('/buyer/search' ,'BuyerSearchController@index');  
Route::any('/buyer/srchPost' ,'BuyerSearchController@buyerSearch');  
Route::any('/buyer/bookNow' ,'BuyerSearchController@bookNow');  
Route::any('/buyer/checkOut','BuyerSearchController@buyercheckOut');
Route::any('/form','SellerPostController@index');
Route::any('/check','SellerPostController@check');

//Seller Post Master

