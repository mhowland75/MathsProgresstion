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
Route::group(['middleware'=>'Student'], function(){
  Route::post('/studentsResults/store', 'StudentsResultsController@store');
  Route::get('/studentsResults/view/{id}', 'StudentsResultsController@view');
  Route::get('/studentsResults/index/{subject}', 'StudentsResultsController@index');
  Route::get('/departments/view', 'DepartmentsController@view');

  Route::get('/education/index/{subject}', 'EducationController@index');
  Route::get('/education/view/{id}', 'EducationController@view');


  Route::post('/help/store', 'HelpController@store');
  Route::get('/help/view', 'HelpController@view');

  Route::get('/test/index/{subject}', 'TestController@index');
  Route::get('/test/{test}/view', 'TestController@view');


});
Route::group(['middleware'=>'ChangePassword'], function(){
  Route::get('/student/logout', 'StudentLoginController@logout');
  Route::get('/student/password_reset', 'StudentLoginController@password_reset_view');
  Route::post('/student/password_reset', 'StudentLoginController@password_reset');
});

Route::get('/student/login', 'StudentLoginController@loginView');
Route::post('/student/login', 'StudentLoginController@login');

Route::group(['middleware'=>'ip_address'], function(){
  Route::get('/', function () {
      return view('welcome');
  });

  Route::get('/restrictedAccess', function () {
      return view('restrictedAccess');
  });
});

Auth::routes();

Route::group(['middleware'=>'AdminAccessLevel1'], function(){

  Route::get('/student_login/create', 'StudentLoginController@create');
  Route::post('/student_login/create', 'StudentLoginController@store');
  Route::get('/student_login/view/{id}', 'StudentLoginController@view');
  Route::get('/unit/manage', 'UnitsController@manage');
  Route::get('/unit/{unit_id}/results', 'UnitsController@results');
  Route::post('/unit/create', 'UnitsController@store');
  Route::get('/test/{unit_id}/manage', 'TestController@manage');
  Route::get('/test/create', 'TestController@create');
  Route::post('/test/create', 'TestController@store');
  Route::get('/test/{id}/questions', 'TestController@manageQuestions');
  Route::get('/test/{id}/delete', 'TestController@delete');
  Route::get('/questions/{id}/answers', 'QuestionsController@manage');
  Route::get('/questions/{id}/delete', 'QuestionsController@delete');
  Route::get('/question/create', 'QuestionsController@create');
  Route::post('/question/create', 'QuestionsController@store');
  Route::get('/answers/create', 'AnswersController@create');
  Route::post('/answers/create', 'AnswersController@store');
  Route::get('/answer/{id}/correct', 'AnswersController@correct_answer');
  Route::get('/answer/{id}/delete', 'AnswersController@delete');
  Route::get('/answer/{id}/visibility', 'AnswersController@visiblity');
    Route::get('/question/{id}/visibility', 'QuestionsController@visiblity');
      Route::get('/test/{id}/visibility', 'TestController@visiblity');
  Route::get('/admin/activity', 'ip_addressController@activity');

  Route::get('/admin/{id}/delete/user', 'AdminController@delete');
  Route::get('/admin/edit/{id}', 'AdminController@edit');
  Route::post('/admin/update/user', 'AdminController@update');
  Route::get('/admin/register', 'AdminController@create');
  Route::post('/admin/store', 'AdminController@store');
  Route::get('/admin/manage', 'AdminController@manage');
  Route::get('/admin/manageAccess', 'AdminController@manageAdministration');
  Route::post('/admin/update', 'AdminController@updateAdministrator');
  Route::get('/admin/delete/{id}', 'AdminController@removeAdministrator');
  Route::get('/results/index', 'ResultsController@index');
  Route::get('/results/create', 'ResultsController@create');
  Route::get('/results/departments', 'ResultsController@deptView');
  Route::post('/results/store', 'ResultsController@store');
    Route::get('/results/{id}/studentdetails', 'ResultsController@studentDetails');
      Route::get('/results/overallStats', 'ResultsController@overallStatsView');
  Route::get('/results/{department}/course', 'ResultsController@courseView');
  Route::get('/results/{course}/student', 'ResultsController@studentView');
  Route::get('/results/overall', 'ResultsController@overallStats');
  Route::get('/results/passMark', 'ResultsController@passMarkView');
  Route::post('/results/storePassMark', 'ResultsController@storePassMark');

  Route::get('/student/index', 'StudentController@index');
  Route::get('/student/create', 'StudentController@create');
  Route::post('/student/store', 'StudentController@store');
});

Route::group(['middleware'=>'AdminAccessLevel2'], function(){
  Route::get('/home', 'HomeController@index')->name('home');

  Route::post('/register', 'Auth\RegisterController@register');
  Route::get('/help/index', 'HelpController@index');
  Route::get('/help/Ajax/{id}', 'HelpController@helpAjax');
  Route::get('/education/create', 'EducationController@create');
  Route::post('/education/store', 'EducationController@store');
  Route::get('/education/manage', 'EducationController@manage');
  Route::get('/education/manage/visibility/{id}', 'EducationController@visibility');
  Route::get('/education/{id}/edit', 'EducationController@edit');
  Route::post('/education/update', 'EducationController@update');
  Route::get('/education/{id}/delete', 'EducationController@delete');
  Route::get('/education/popularity', 'EducationController@popularityView');

  Route::get('/departments/index', 'DepartmentsController@index');
  Route::get('/departments/{id}/edit', 'DepartmentsController@edit');
  Route::get('/departments/{id}/delete', 'DepartmentsController@delete');
  Route::get('/departments/create', 'DepartmentsController@create');
  Route::post('/departments/update', 'DepartmentsController@update');
  Route::post('/departments/store', 'DepartmentsController@store');

  Route::get('/examples/{id}/create', 'ExamplesController@create');
  Route::post('/examples/store', 'ExamplesController@store');
  Route::get('/examples/{id}/manage', 'ExamplesController@manage');
  Route::get('/examples/manage/visibility/{id}', 'ExamplesController@visibility');
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
