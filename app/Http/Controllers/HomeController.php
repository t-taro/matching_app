<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Project;
use App\User;
use App\Message;

class HomeController extends Controller
{
  /**
   * Create a new controller instance.
   *
   * @return void
   */
  public function __construct()
  {
    $this->middleware('auth');
  }

  /**
   * Show the application dashboard.
   *
   * @return \Illuminate\Contracts\Support\Renderable
   */
  public function index()
  {
    $user_id = Auth::id();
    
    // 未来開催のプロジェクトのみを取得
    $projects = Project::where('open_at', '>=', date('Y-m-d H:i:s'))->get();
    
    foreach($projects as $project){
      
      // 既にエントリーしている人数
      $entryUsers = Project::find($project->id)->users()->get();
      $entryCount = count($entryUsers);
      $remaining = $project->min_member - $entryCount;
      $project['remaining'] = $remaining;
      
      // 募集人数に達しているかどうかチェック
      if($entryCount >= $project->min_member){
        $project['isLimit'] = true;
      }
      
      // 主催しているプロジェクトかどうかチェック
      if($project->organizer_id == Auth::id()){
        $project['isMyProject'] = true;
      }

      // エントリー済みかどうかをチェック
      foreach ($project->users as $user) {
        if ($user->id == Auth::id()) {
          $project['isEntried'] = true;
        }
      }
      
    }
    
    // 主催しているプロジェクト数
    $myProjectCount = count(Project::where('organizer_id', $user_id)->where('open_at', '>=', date('Y-m-d H:i:s'))->get());
    
    // エントリー中のプロジェクト数
    $user = User::find($user_id);
    $joinProjectCount = count($user->projects()->where('open_at', '>=', date('Y-m-d H:i:s'))->get());
    
    // 主催した過去のプロジェクト数
    $myPastProjectCount = count(Project::where('organizer_id', $user_id)->where('open_at', '<', date('Y-m-d H:i:s'))->get());
    
    
    return view('logged_in/home', compact('projects', 'joinProjectCount', 'myProjectCount', 'myPastProjectCount'));
  }

  public function showMyProject()
  {
    $user = Auth::id();
    $projects = Project::where('organizer_id', $user)->where('open_at', '>=', date('Y-m-d H:i:s'))->get();
    
    // 残り枠数
    foreach($projects as $project){
      $entryUsers = Project::find($project->id)->users()->get();
      $entryCount = count($entryUsers);
      $remaining = $project->min_member - $entryCount;
      $project['remaining'] = $remaining;
    }
    return view('logged_in/myproject_list', compact('projects'));
  }

  public function showWillJoinProject()
  {
    $user_id = Auth::id();
    $projects = User::find($user_id)->projects()->where('open_at', '>=', date('Y-m-d H:i:s'))->get();
    // 残り枠数
    foreach($projects as $project){
      $entryUsers = Project::find($project->id)->users()->get();
      $entryCount = count($entryUsers);
      $remaining = $project->min_member - $entryCount;
      $project['remaining'] = $remaining;
    }
    return view('logged_in/will_join_list', compact('projects'));
  }
  
  // TODO:メソッドを作成しただけの状態
  public function showMyPastProject()
  {
    $user = Auth::id();
    $projects = Project::where('organizer_id', $user)->where('open_at', '<', date('Y-m-d H:i:s'))->get();
    
    // 残り枠数
    foreach($projects as $project){
      $entryUsers = Project::find($project->id)->users()->get();
      $entryCount = count($entryUsers);
      $remaining = $project->min_member - $entryCount;
      $project['remaining'] = $remaining;
    }
    return view('logged_in/mypast_list', compact('projects'));
  }

  public function showProjectDetail($id)
  {
    $project = Project::findOrFail($id);
    
    // エントリーしているメンバー情報
    $entryUsers = Project::find($id)->users()->get();
    
    // 既にエントリーしている人数
    $entryCount = count($entryUsers);
    if($entryCount){
      $project['entryCount'] = $entryCount;
    }else{
      $project['entryCount'] = 0;
    }
    
    // 主催者ユーザーの情報
    $project['organizer'] = User::findOrFail($project->organizer_id);
    
    // 募集人数に達しているかどうかチェック
    if($entryCount >= $project->min_member){
      $project['isLimit'] = true;
    }
    
    // 主催しているプロジェクトかどうかチェック
    if($project->organizer_id == Auth::id()){
      $project['isMyProject'] = true;
    }

    // エントリー済みかどうかをチェック
    foreach ($project->users as $user) {
      if ($user->id == Auth::id()) {
        $project['isEntried'] = true;
      }
    }
    
    
    $messages = $project->messages;
    foreach($messages as $msg){
      $msg['user_name'] = User::findOrFail($msg->user_id)->name;
    }
    
    return view('logged_in/project_detail', compact('project', 'entryUsers', 'messages'));
  }
  
  public function showNewProjectPage()
  {
    $project = new Project();
    $message = "";
    return view('logged_in/project_create', compact('project', 'message'));
  }
  
  // FIXME:過去日は防げるが過去時間は登録できてしまう
  public function storeNewProject(Request $request)
  {
    if($request->open_at >= date('Y-m-d H:i:s')){
      $project = new Project();
      $project->organizer_id = Auth::id();
      $project->fill($request->all())->save();
      return redirect("/home");
    }else{
      $project = new Project();
      $project->place = $request->place;
      $project->min_member = $request->min_member;
      $project->level = $request->level;
      $message = "過去の日時は指定できません";
      return view('logged_in/project_create', compact('project', 'message'));
    }
  }
  
  public function showProjectUpdatePage($id)
  {
    $project = Project::findOrFail($id);
    $message = "";
    return view('logged_in/project_update', compact('project', 'message'));
  }
  
  // FIXME:過去日は防げるが過去時間は登録できてしまう
  public function editProject(Request $request)
  {
    $project = Project::findOrFail($request->id);
    
    if($request->open_at >= date('Y-m-d H:i:s')){
      // 既にエントリーしている人数
      $entryUsers = Project::find($request->id)->users()->get();
      $entryCount = count($entryUsers);
      
      if($entryCount > $request->min_member){
        $message = "募集人数がエントリーされている人数を下回っています";
        return view('logged_in/project_update', compact('project', 'message'));
      }else{
        $project->fill($request->all())->save();
        return redirect('project/'.$request->id);
      }
    }else{
      $message = "過去の日時は指定できません";
      return view('logged_in/project_update', compact('project', 'message'));
    }
  }
  
  public function deleteProject(Request $request){
    
    // 中間テーブルでプロジェクトに紐づくユーザーをdetachする
    $project = Project::find($request->id);
    $project->users()->detach();
    
    // プロジェクトを削除
    Project::findOrFail($request->id)->delete();
    
    // プロジェクトに紐づくメッセージも削除
    Message::where('project_id', $request->id)->delete();
    
    return redirect("/home");
  }

  public function entryStore(Request $request)
  {
    $user_id = Auth::id();
    $user = User::find($user_id);
    $user->projects()->attach(['project_id' => $request->id]);

    return response()->json(['entry' => 'complete']);
  }
}
