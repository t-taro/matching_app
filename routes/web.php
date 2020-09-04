<?php

use Illuminate\Support\Facades\Route;
use App\Events\MessageAdded;

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
Route::PATCH('/profile/update', 'ProfileController@editProfile');
Route::GET('/profile/update/{id}', 'ProfileController@showProfileUpdatePage');
Route::GET('/profile/{id}', 'ProfileController@index');

// メッセージ登録
Route::POST('/message/store', 'MessageController@store');

// メッセージエリア用　ログイン中のユーザー情報を取得
Route::GET('/message/getCurrentUser', 'MessageController@getCurrentUser');

// テスト用
Route::GET('/messages', function(){
  return view('test');
});

