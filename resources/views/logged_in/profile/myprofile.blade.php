@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-7 text-center bg-white px-0">
      
      @if($user->image)
      <div id="profile_img" style="background-image: url('{{asset($user->image)}}')"></div>
      @else
      <div id="profile_img" style="background-image: url('{{asset("/storage/images/user_images/default.png")}}')"></div>
      @endif
      <p>名前</p>
      <p>{{$user->name}}</p>
      @if($user->id == Auth::id())
      <p>メールアドレス</p>
      <p>{{$user->email}}</p>
      @endif
      @if($user->desc)
      <p>自己紹介メッセージ</p>
      <p>{{$user->desc}}</p>
      @endif
    </div>
    @if($user->id == Auth::id())
    <div class="col-7 text-center bg-white px-0">
      <a class="btn btn-primary mb-3" href="{{ url('/profile/update/'.$user->id) }}" role="button">プロフィール編集</a>
    </div>
    @endif
  </div>
</div>
@endsection