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
Route::get('/results/index', 'studentsResultsController@index');


  Route::get('/test/test', 'testingController@testin');
  Route::get('/help/view', 'HelpController@view');

  Route::get('/admin/create', 'AdminController@adminCreate');
Route::group(['middleware'=>'Student'], function(){
  Route::post('/studentsResults/store', 'StudentsResultsController@store');
  Route::get('/studentsResults/view/{id}', 'StudentsResultsController@view');
  Route::get('/studentsResults/index/{subject}', 'StudentsResultsController@index');
  Route::get('/results/view', 'studentsResultsController@resultsView');

  Route::get('/departments/view', 'DepartmentsController@view');

  Route::get('/education/index/{subject_id}', 'EducationController@index');
  Route::get('/education/view/{id}', 'EducationController@view');

  Route::post('/help/store', 'HelpController@store');


  Route::get('/test/index/{subject_id}', 'TestController@index');
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

  Route::get('/studentsResults/csv', 'StudentsResultsController@resultCsv');

  Route::get('/students/results/{year}/overall/{subject}', 'StudentsResultsController@overall');

  Route::get('/student_year/create', 'StudentYearController@manage');
  Route::post('/student_year/create', 'StudentYearController@store');
  Route::get('/student_year/{year}/delete', 'StudentYearController@delete');
  Route::get('/student_year/{year}/edit', 'StudentYearController@edit');
  Route::post('/student_year/{year}/edit', 'StudentYearController@update');
  Route::get('/student_year/{year}/activate', 'StudentYearController@activateStudentLogins');
  Route::get('/student_year/{year}/results_rest', 'StudentYearController@studentResultsReset');

    Route::get('/student/{year}/deleteAll', 'StudentController@deleteAllByStudentYear');
    Route::get('/student/{id}/delete', 'StudentController@delete');
    Route::post('/student/create', 'StudentController@store');
    Route::post('/student/create/student', 'StudentController@storeStudent');
    Route::get('/student/{student}/edit', 'StudentController@edit');
    Route::post('/student/update', 'StudentController@update');
    Route::get('/student/{studentId}/activate', 'StudentController@activate');

    Route::get('/subject/view', 'SubjectController@view');
    Route::get('/subject/{subject_id}/delete', 'SubjectController@delete');
    Route::get('/subject/create', 'SubjectController@create');
    Route::post('/subject/create', 'SubjectController@store');
    Route::get('/subject/manage', 'SubjectController@manage');
    Route::get('/subject/edit/{subject_id}', 'SubjectController@edit');
    Route::post('/subject/edit', 'SubjectController@update');

  Route::get('/student_login/view/{id}', 'StudentLoginController@view');
  Route::get('/unit/manage', 'UnitsController@manage');
  Route::get('/unit/{unit_id}/results', 'UnitsController@results');
  Route::get('/unit/{unit_id}/delete', 'UnitsController@delete');
  Route::post('/unit/create', 'UnitsController@store');
  Route::get('/test/{unit_id}/manage', 'TestController@manage');
  Route::post('/test/create/test', 'TestController@store');
  Route::get('/test/{id}/questions', 'TestController@manageQuestions');
  Route::get('/test/{test}/delete', 'TestController@delete');
  Route::get('/test/{test}/edit', 'TestController@edit');
  Route::post('/test/{id}/update', 'TestController@update');

  Route::get('/questions/{id}/answers', 'QuestionsController@manage');
  Route::get('/question/{question}/edit', 'QuestionsController@edit');
  Route::get('/questions/{question}/delete', 'QuestionsController@delete');
  Route::get('/question/{question}/visibility', 'QuestionsController@visibility');
  Route::post('/question/create', 'QuestionsController@store');
  Route::post('/question/edit', 'QuestionsController@update');

  Route::get('/answers/create', 'AnswersController@create');
  Route::post('/answers/create', 'AnswersController@store');
  Route::get('/answer/{answer}/correct', 'AnswersController@correct_answer');
  Route::get('/answer/{answer}/delete', 'AnswersController@delete');
  Route::get('/answer/{answer}/visibility', 'AnswersController@visiblity');
  Route::get('/answer/{answer}/edit', 'AnswersController@edit');
  Route::post('/answer/edit', 'AnswersController@update');

    Route::get('/question/{id}/visibility', 'QuestionsController@visiblity');
      Route::get('/test/{test}/visibility', 'TestController@visiblity');
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

  


  Route::get('/results/department/{yearId}', 'studentsResultsController@departmentResults');
  Route::get('/results/course/{yearId}/dept/{dept}', 'studentsResultsController@courseResults');
  Route::get('/results/course/{yearId}/course/{course}', 'studentsResultsController@studentsResults');
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
