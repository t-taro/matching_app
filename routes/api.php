<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Message;
use App\User;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/messages', function (Request $request) {
    $projectId = $request->input('projectId'); //inputメソッドでクエリパラメータを取得

    $messages = Message::where('project_id', $projectId)->orderBy('created_at', 'desc')->get();
    foreach ($messages as $msg) {
        $msg['user_name'] = User::findOrFail($msg->user_id)->name;
    }
    return $messages;
});

Route::get('/currentUser', function () {
    $id = Auth::id();
    return response()->json(['current_user_id' => $id]);
});
