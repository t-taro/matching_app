<?php

use Illuminate\Support\Facades\Route;

Route::GET('/', 'ProjectController@index');

Auth::routes();

Route::GET('/home', 'HomeController@index')->name('home');

// 新規プロジェクト
Route::GET('/project/create', 'HomeController@showNewProjectPage');
Route::POST('/project/store', 'HomeController@storeNewProject');

// プロジェクトの修正
Route::PATCH('/project/update', 'HomeController@editProject');
Route::GET('/project/update/{id}', 'HomeController@showProjectUpdatePage');

// プロジェクトの削除
Route::DELETE('/project/delete', 'HomeController@deleteProject');

// カテゴリ毎のプロジェクト一覧
Route::GET('/myproject', 'HomeController@showMyProject');
Route::GET('/willJoinProject', 'HomeController@showWillJoinProject');
Route::GET('/mypast', 'HomeController@showMyPastProject');

// エントリー
Route::POST('/project/entry', 'HomeController@entryStore');

// 各プロジェクトの詳細
Route::GET('/project/{id}', 'HomeController@showProjectDetail');

// プロフィール
Route::GET('/profile', 'ProfileController@index');
