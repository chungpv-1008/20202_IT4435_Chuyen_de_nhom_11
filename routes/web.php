<?php

use Illuminate\Support\Facades\Route;

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

Route::group(['middleware' => 'localization'], function () {
    Auth::routes();

    Route::get('/home', 'HomeController@index')->name('home');

    Route::post('/employer/register', 'RegisterEmployerController@register')->name('employer.register');

    Route::resource('companies', CompanyController::class);

    Route::resource('jobs', 'JobController');

    Route::patch('apply/{id}', 'ApplicationController@apply')->name('apply');

    Route::get('cancel-apply/{id}', 'ApplicationController@cancelApply')->name('cancel_apply');

    Route::get('show-apply-list', 'ApplicationController@showApplyList')->name('show_apply_list');

    Route::get('history','ApplicationController@showHistoryCreateJob')->name('history');

    Route::get('list-candidate/{id}','ApplicationController@showListCandidateApply')->name('list_candidate');

    Route::patch('accept-reject/{user_id}/{job_id}/{status}','ApplicationController@acceptOrReject')->name('accept_reject');

    Route::resource('users', UserController::class);

    Route::get('list-user', 'AdminController@viewListUser')->name('list_user');

    Route::get('list-job', 'AdminController@viewListJob')->name('list_job');

    Route::get('approve-job/{id}', 'AdminController@approveJob')->name('approve_job');

    Route::post('filter', 'SearchController@filter')->name('filter');

    Route::get('/search','SearchController@search')->name('search');

    Route::get('job-by-tag/{id}', 'SearchController@findJobByTag')->name('job_by_tag');

    Route::get('update-user/{id}/{status}', 'AdminController@updateUser')->name('update_user');
});

Route::get('change-language/{locale}', 'HomeController@changeLanguage')->name('change-language');
