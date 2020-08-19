<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Project;

class ProjectController extends Controller
{
  
  public function index()
  {
    if(!Auth::check())
    {
      $projects = Project::where('open_at', '>=', date('Y-m-d H:i:s'))->get();
      
      foreach($projects as $project){
        // 既にエントリーしている人数
        $entryUsers = Project::find($project->id)->users()->get();
        $entryCount = count($entryUsers);
        $remaining = $project->min_member - $entryCount;
        $project['remaining'] = $remaining;
      }
      
      return view('welcome', compact('projects'));
      
    }elseif(Auth::check()){
      return redirect('/home');
    }
  }
}
