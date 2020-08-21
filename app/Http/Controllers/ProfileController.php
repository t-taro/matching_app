<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Profile;
use App\User;
use Ramsey\Uuid\Provider\Time\FixedTimeProvider;

class ProfileController extends Controller
{
  public function __construct()
  {
    $this->middleware('auth');
  }
  
  public function index($id)
  {
    $user = User::find($id);
    $profile = User::find($id)->profiles;
    $user->desc = $profile->description;
    
    
    $user->image = str_replace('public/', 'storage/', $profile->image); 
    
    return view('logged_in/profile/myprofile', compact('user'));
  }
  
  public function showProfileUpdatePage($id)
  {
    $user = User::find(Auth::id());
    $profile = User::find(Auth::id())->profiles;
    $user->desc = $profile->description;
    
    return view('logged_in/profile/profile_update', compact('user'));
  }
  
  public function editProfile(Request $request)
  {
    // コレクションで直接更新する方法
    // $profile = Profile::where('user_id', $request->id)->update(['description' => $request->description]);
    
    $profile = User::find($request->id)->profiles;
    $profile->description = $request->description;
    
    if ($request->file('image')){
      $path = $request->file('image')->store('public/images/user_images');
      $profile->image = $path;
    }
    
    $profile->save();
    
    $user = User::findOrFail($request->id);
    $user->name = $request->name;
    $user->email = $request->email;
    $user->save();
    
    return redirect('/profile/'.$request->id);
  }
}
