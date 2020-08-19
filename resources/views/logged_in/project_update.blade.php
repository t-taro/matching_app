@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-6 text-center">
      @include('common.project_form', ['target' => 'update'])
    </div>
  </div>
</div>
@endsection