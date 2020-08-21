@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-6 text-center">
      <form action="/profile/update" method="post" enctype="multipart/form-data">
        @method('PATCH')
        @csrf
        <input type="hidden" name="id" value="{{$user->id}}">
        <label for="name">お名前</label>
        <input type="text" name="name" id="name" class="form-control mb-3" value="{{$user->name}}">
        <label for="email">メールアドレス</label>
        <input type="text" name="email" id="email" class="form-control mb-3" value="{{$user->email}}">
        <label for="desc">プロフィール紹介文</label>
        <textarea name="description" id="desc"class="form-control mb-3"  cols="30" rows="10">{{$user->desc}}</textarea>
        
        <input type="file" name="image" class="mb-2">
        
        <input type="submit" class="btn btn-warning px-3" value="プロフィールを更新する">
      </form>
    </div>
  </div>
</div>
@endsection