@extends('layouts.app')

@section('content')
<div class="container">
  <a class="btn btn-primary mb-3" href="{{ url('/project/create') }}" role="button">プロジェクトを立ち上げる</a>
  <section class="d-flex justify-content-center justify-content-md-around flex-wrap">
    <div class="card text-white bg-dark mb-3 text-center" style="max-width: 18rem;">
      <div class="card-header">主催中のプロジェクト</div>
      <div class="card-body">
        <h2 class="card-title"><a href="{{ url('/myproject') }}" class="badge badge-success">{{$myProjectCount}}</a></h2>
        <p class="card-text">あなたが主催予定のプロジェクトです。</p>
      </div>
    </div>
    <div class="card text-white bg-dark mb-3 text-center" style="max-width: 18rem;">
      <div class="card-header">参加予定のプロジェクト</div>
      <div class="card-body">
        <h2 class="card-title"><a href="{{ url('/willJoinProject') }}" class="badge badge-primary">{{$joinProjectCount}}</a></h2>
        <p class="card-text">あなたが参加者となっているプロジェクトです。</p>
      </div>
    </div>
    <div class="card text-white bg-dark mb-3 text-center" style="max-width: 18rem;">
      <div class="card-header">過去に主催したプロジェクト</div>
      <div class="card-body">
        <h2 class="card-title"><a href="{{ url('/mypast') }}" class="badge badge-secondary">{{$myPastProjectCount}}</a></h2>
        <p class="card-text">以前、あなたが主催したプロジェクトです。</p>
      </div>
    </div>
  </section>
  <!-- プロジェクトリスト -->
  <h1>現在、募集中のプロジェクト</h1>
  @include('common.project_list')
</div>
@endsection