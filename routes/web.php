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

Route::get('/login', function () {
    return view('login');
});
Route::get('/forgot_password', function () {
    return view('forgot_password');
});
Route::get('/logout', 'LoginsController@logout');

Route::get('/', 'UsersController@index');

Route::post('/authenticate', 'LoginsController@authenticate');

Route::post('/forgot_password_post', 'UsersController@forgotPasswordPost');

Route::post('/create', 'UsersController@customerRegister');


Route::get('/admin/index', 'AdminsController@index');
Route::get('/admin/jobs', 'AdminsController@jobs');
Route::get('/admin/new_job', 'AdminsController@newJob');
Route::post('/admin/save_job', 'AdminsController@saveJob');

//mobile routes

Route::post('/mobile/authenticate', 'LoginsController@mobileAuthenticate');
Route::post('/mobile/register', 'UsersController@mobileRegister');

Route::get('/mobile/fields', 'CustomersController@fields');
Route::get('/mobile/states', 'CustomersController@states');
Route::get('/mobile/jobs/{initial}/{field_id}/{state_id}/{search}', 'CustomersController@jobs');

Route::get('/mobile/save_job/{job_id}/{customer_id}', 'CustomersController@mobileSaveJob');
Route::get('/mobile/get_saved_jobs/{initial}/{customer_id}', 'CustomersController@mobileGetSavedJobs');
Route::get('/mobile/get_subscribed_alerts/{customer_id}', 'CustomersController@mobileGetSubscribedAlerts');
Route::get('/mobile/subscribe/{field_id}/{customer_id}', 'CustomersController@mobileSubscribe');
Route::get('/mobile/unsubscribe/{field_id}/{customer_id}', 'CustomersController@mobileUnsubscribe');
Route::get('/mobile/send_push/{title}/{body}/{field_id}', 'AdminsController@sendPush');
Route::post('/mobile/reset', 'UsersController@mobileReset');

Route::get('/mobile/videos/{customer}/{length}/{search}', 'UsersController@mobileVideos');
Route::get('/mobile/save_history/{customer}/{video_id}', 'UsersController@saveHistory');