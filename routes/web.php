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

Route::group(['prefix' => '/'], function () {

    Route::group(['middleware' => 'guest'], function () {
        Route::name('getLogin')->get('/', 'AuthController@index');
        Route::name('postLogin')->post('/login', 'AuthController@authenticate')->middleware("throttle:5,1");
    });

    Route::group(['middleware' => 'auth'], function () {
        Route::name('getLogout')->get('/logout', 'AuthController@unauthenticate');
        Route::name('getDashboard')->get('/dashboard', 'DashboardController@index');

        Route::group(['prefix' => 'roles/'], function () {
            Route::name('getRoles')->get('', 'RoleController@index')->middleware('permissions:view roles');
            Route::name('getEditRole')->get('edit/{roleID}', 'RoleController@edit')->middleware('permissions:edit roles');
            Route::name('postCreateRole')->post('create', 'RoleController@postCreate')->middleware('permissions:create roles');
            Route::group(['prefix' => 'api/'], function () {
                Route::name('postUpdateRole')->post('update', 'RoleController@postTogglePermissions')->middleware('permissions:edit roles');
            });
        });

        Route::group(['prefix' => 'users/'], function () {
            Route::name('getUsers')->get('', 'UserController@getUsers')->middleware('permissions:view users');
            Route::name('getEditUser')->get('edit/{id}', 'UserController@getEdit')->middleware('permissions:edit users');
            Route::name('postEditUser')->post('update', 'UserController@postUpdate')->middleware('permissions:edit users');
            Route::name('postCreateUser')->post('create', 'UserController@postCreate')->middleware('permissions:create users');
        });

        Route::group(['prefix' => 'students/'], function () {
            Route::name('getStudents')->get('', 'StudentController@index')->middleware('permissions:view students');
            Route::name('getEditStudent')->get('edit/{id}', 'StudentController@getEdit')->middleware('permissions:edit students');
            Route::name('postEditStudent')->post('update', 'StudentController@postUpdate')->middleware('permissions:edit students');
            Route::name('postCreateStudent')->post('create', 'StudentController@postCreate')->middleware('permissions:create students');
            Route::group(['prefix' => 'subjects/'], function () {
                Route::name('getAssignSubjects')->get('{id}', 'SubjectAssignController@index')->middleware('permissions:assign subjects');
                Route::name('postAssignSubject')->post('assign', 'SubjectAssignController@postAssignSubject')->middleware('permissions:assign subjects');
            });
        });

        Route::group(['prefix' => 'courses/'], function () {
            Route::name('getCourses')->get('', 'CourseController@index')->middleware('permissions:view courses');
            Route::name('getEditCourse')->get('edit/{id}', 'CourseController@getEdit')->middleware('permissions:edit courses');
            Route::name('postEditCourse')->post('update', 'CourseController@postUpdate')->middleware('permissions:edit courses');
            Route::name('postCreateCourse')->post('create', 'CourseController@postCreate')->middleware('permissions:create courses');
        });

        Route::group(['prefix' => 'subjects/'], function () {
            Route::name('getSubjects')->get('', 'SubjectController@index')->middleware('permissions:view courses');
            Route::name('getEditSubject')->get('edit/{id}', 'SubjectController@getEdit')->middleware('permissions:edit courses');
            Route::name('postEditSubject')->post('update', 'SubjectController@postUpdate')->middleware('permissions:edit courses');
            Route::name('postCreateSubject')->post('create', 'SubjectController@postCreate')->middleware('permissions:create courses');
        });

        Route::group(['prefix' => 'attendancesystem/', 'middleware' => ['permissions:use attendance', 'mustBeATeacher']], function () {
            Route::name('getAttendanceSystem')->get('', 'AttendanceSystemController@index');
        });


    });

});
