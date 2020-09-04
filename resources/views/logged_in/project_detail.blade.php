@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row justify-content-center">

    <div class="col-7 text-center bg-white px-0 pb-3">
      @if($project->isMyProject)
        <p class="p-3 bg-success text-white">{{$project->organizer->name}}さんが主催しているプロジェクトです</p>
        @include('../parts/project_detail_part')
        <a class="btn btn-primary mb-3" href="{{ url('/project/update/'.$project->id) }}" role="button">内容を修正する</a>
      @elseif($project->isEntried)
        <p class="p-3 bg-primary text-white">エントリー済みです</p>
        @include('../parts/project_detail_part')
      @elseif($project->isLimit)
        <p class="p-3 bg-success text-white">募集人数に達しました</p>
        @include('../parts/project_detail_part')
      @else
        <p class="p-3 bg-info text-white">エントリー可能です</p>
        @include('../parts/project_detail_part')
        <button id="entryBtn" type="button" class="btn btn-outline-primary" data-id="{{$project->id}}">エントリーする</button>
      @endif

      <p id="entryStatus">エントリー状況: <span id="entryCount">{{$project->entryCount}}</span>/{{$project->min_member}}</p>

      @if(count($entryUsers))
      <p>エントリーしているメンバー</p>
      @endif
      
      <ul>
        @foreach($entryUsers as $user)
        <li>{{$user->name}}</li>
        @endforeach
      </ul>

      @if($project->isMyProject)
      <form action="/project/delete" method="POST">
        @method('DELETE')
        @csrf
        <input type="hidden" name="id" value="{{$project->id}}">
        <button type="submit" class="btn btn-danger">プロジェクトを削除する</button>
      </form>
      @endif
    </div>
    
    <!-- 自分のプロジェクトもしくはエントリー済みであればメッセージエリアを表示する -->
    @if($project->isMyProject || $project->isEntried)
      <div class="col-7 message_area">
        <!-- propsにプロジェクトIDを渡している -->
        <message-list :project="{{$project}}"></message-list>
      </div>
    @endif
  </div>
</div>
@push('project_detail')
  <script src="{{ asset('js/entry_btn.js') }}" defer></script>
@endpush
@endsection