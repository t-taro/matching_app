@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-6 text-center">
      @include('common.project_form', ['target' => 'store'])
    </div>
  </div>
</div>
@endsection