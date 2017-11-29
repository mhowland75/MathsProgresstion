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

Route::get('/restrictedAccess', function () {
    return view('restrictedAccess');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/departments/view', 'DepartmentsController@view');

Route::get('/education/index', 'EducationController@index');
Route::get('/education/view/{id}', 'EducationController@view');

Route::get('/help/view', 'HelpController@view');
Route::post('/help/store', 'HelpController@store');

Route::group(['middleware'=>'AdminAccessLevel1'], function(){
  Route::get('/admin/{id}/delete/user', 'AdminController@delete');
  Route::get('/admin/edit/{id}', 'AdminController@edit');
  Route::post('/admin/update/user', 'AdminController@update');
  Route::get('/admin/register', 'AdminController@create');
  Route::post('/admin/store', 'AdminController@store');
  Route::get('/admin/manage', 'AdminController@manage');
  Route::get('/admin/manageAccess', 'AdminController@manageAdministration');
  Route::post('/admin/update', 'AdminController@updateAdministrator');
  Route::get('/admin/delete/{id}', 'AdminController@removeAdministrator');

});

Route::group(['middleware'=>'AdminAccessLevel2'], function(){
  Route::post('/register', 'Auth\RegisterController@register');
  Route::get('/help/index', 'HelpController@index');

  Route::get('/education/create', 'EducationController@create');
  Route::post('/education/store', 'EducationController@store');
  Route::get('/education/manage', 'EducationController@manage');
  Route::get('/education/{id}/edit', 'EducationController@edit');
  Route::post('/education/update', 'EducationController@update');
  Route::get('/education/{id}/delete', 'EducationController@delete');

  Route::get('/departments/index', 'DepartmentsController@index');
  Route::get('/departments/{id}/edit', 'DepartmentsController@edit');
  Route::get('/departments/{id}/delete', 'DepartmentsController@delete');
  Route::get('/departments/create', 'DepartmentsController@create');
  Route::post('/departments/update', 'DepartmentsController@update');
  Route::post('/departments/store', 'DepartmentsController@store');

  Route::get('/examples/{id}/create', 'ExamplesController@create');
  Route::post('/examples/store', 'ExamplesController@store');
  Route::get('/examples/{id}/manage', 'ExamplesController@manage');
  Route::get('/examples/{id}/delete', 'ExamplesController@delete');
  Route::get('/examples/{id}/edit', 'ExamplesController@edit');
  Route::post('/examples/update', 'ExamplesController@update');

  Route::get('/teachers/manage', 'TeachersController@manage');
  Route::get('/teachers/create', 'TeachersController@create');
  Route::post('/teachers/store', 'TeachersController@store');
  Route::get('/teachers/{id}/edit', 'TeachersController@edit');
  Route::get('/teachers/{id}/delete', 'TeachersController@delete');
  Route::post('/teachers/update', 'TeachersController@update');
});
