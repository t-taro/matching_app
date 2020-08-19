@extends('layouts.app')

@section('content')
<div class="container">
<h1>現在、募集中のプロジェクト</h1>
@include('common.project_list')
</div>
@endsection