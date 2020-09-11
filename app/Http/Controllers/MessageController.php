<?php

namespace App\Http\Controllers;

use App\Events\MessageAdded;
use App\Events\UpdateNotice;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Message;
use App\User;
use App\Project;

class MessageController extends Controller
{
  public function getCurrentUser(){    
    $id = Auth::id();
    
    return response()->json(['current_user_id' => $id]);
  }
  
  public function store(Request $request){
    $data = ['project_id' => $request->project_id,
              'message' => $request->message,
              'user_id' => Auth::id()
            ];
    $message = Message::create($data);
    $userName = User::findOrFail($message->user_id)->name;
    $project = Project::findOrFail($request->project_id);

    event((new MessageAdded($message, $userName))->dontBroadcastToCurrentUser());
    broadcast(new UpdateNotice($message, $userName, $project))->toOthers();
    $message->user_name = $userName;
    return $message;
  }
}
