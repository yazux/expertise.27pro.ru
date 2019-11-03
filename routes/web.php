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

Artisan::call('view:clear');

Route::group(['prefix' => 'admin'], function () {
    Voyager::routes();
});

Route::prefix('/ajax')->group(function () {
    Route::get('/regions', 'AjaxController@getRegions')->name('ajaxGetRegions');
    Route::get('/vendors', 'AjaxController@getVendors')->name('ajaxGetVendors');
    Route::get('/projects', 'AjaxController@getProjects')->name('ajaxGetProjects');
    Route::get('/news', 'AjaxController@getNews')->name('ajaxGetNews');
    Route::post('/access', 'AjaxController@access')->name('ajaxAccess');
});

Route::get('/', 'PageController@index')->name('home');

Route::get('/regions', 'PageController@regions')->name('regions');
Route::get('/regions/{id}', 'PageController@region')->name('region');
Route::get('/regions/{id}/projects', 'PageController@regionProjects')->name('regionProjects');

Route::get('/vendors', 'PageController@vendors')->name('vendors');
Route::get('/vendors/{id}', 'PageController@vendor')->name('vendor');

Route::get('/projects', 'PageController@projects')->name('projects');
Route::get('/projects/{id}', 'PageController@project')->name('project');

Route::get('/static/{slug}', 'PageController@static')->name('static');