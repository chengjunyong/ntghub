<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Hash;

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

Route::get('/', function () {
    return view('auth.login');
});

Auth::routes(['register' => false]);

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/RegisterCustomer','HomeController@getRegisterCustomer')->name('getRegisterCustomer');
Route::post('/RegisterCustomer','HomeController@postRegisterCustomer')->name('postRegisterCustomer');
Route::get('/Verification','HomeController@getVerification')->name('getVerification');
Route::post('/Verification','HomeController@postVerification')->name('postVerification');
Route::post('/getCustomerDetails','HomeController@getCustomerDetails')->name('getCustomerDetails');
Route::get('/CustomerList','HomeController@getCustomerList')->name('getCustomerList');
Route::get('/CustomerDetails/{id}','HomeController@getCustomerInfo')->name('getCustomerInfo');

Route::post('ModifyCustomer','HomeController@ajaxModifyCustomer')->name('ajaxModifyCustomer');

//Email
Route::get('/testmail','HomeController@testmail')->name('testmail');

//Marketing
Route::get('/UploadTemplate','HomeController@getUploadTemplate')->name('getUploadTemplate');
Route::post('/UploadTemplate','HomeController@postUploadTemplate')->name('postUploadTemplate');
Route::get('/TestEmail','HomeController@getTestEmail')->name('getTestEmail');
