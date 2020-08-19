@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-7 text-center bg-white px-0">
      <p>{{$user->name}}</p>
      <p>{{$user->email}}</p>
    </div>
  </div>
</div>
@endsection