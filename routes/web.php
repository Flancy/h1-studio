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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

//Заявки
Route::resource('orders', 'Orders\OrdersController')->middleware('admin');

//Новости
Route::resource('articles', 'Articles\ArticlesController');

//Услуги
Route::resource('services', 'Services\ServicesController');
Route::resource('services-storage', 'Services\ServicesStorageController');

//Клиенты
Route::resource('users', 'Users\UsersController');
Route::get('user_list', 'Users\UsersController@getAllUsers')->name('user_list');

//Проекты
Route::resource('projects', 'Projects\ProjectsController');
Route::get('project/{id}', 'Projects\ProjectsController@getAllProjects')->name('project');
Route::get('project_checklist/{id}', 'Checklist\ChecklistController@getAllChecklist')->name('project_checklist');

//Чеклисты
Route::resource('checklist', 'Checklist\ChecklistController');

//Сообщения
Route::group(['prefix' => 'messages'], function () {
    Route::get('/', ['as' => 'messages', 'uses' => 'MessagesController@index']);
    Route::get('create', ['as' => 'messages.create', 'uses' => 'MessagesController@create']);
    Route::post('/', ['as' => 'messages.store', 'uses' => 'MessagesController@store']);
    Route::get('{id}', ['as' => 'messages.show', 'uses' => 'MessagesController@show']);
    Route::put('{id}', ['as' => 'messages.update', 'uses' => 'MessagesController@update']);
});