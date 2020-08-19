<div class="d-flex justify-content-center justify-content-md-around flex-wrap">
  @foreach($projects as $project)
  @if($project->isMyProject)
  <div class="card text-center border-success mb-3" style="width: 18rem;">
    <h5 class="card-header">{{$project->place}}</h5>
    <div class="card-body text-success">
  @elseif($project->isEntried)
  <div class="card text-center border-primary mb-3" style="width: 18rem;">
    <h5 class="card-header">{{$project->place}}</h5>
    <div class="card-body text-primary">
  @else
  <div class="card text-center border-dark mb-3" style="width: 18rem;">
    <h5 class="card-header">{{$project->place}}</h5>
    <div class="card-body text-dark">
  @endif
      <p class="card-text">{{$project->open_at->format('Y年m月d日 H:i')}}</p>
      <p class="card-text">募集人数 {{$project->min_member}}人</p>

      @switch($project->level)
      @case(1)
      <p>レベル 初心者歓迎！</p>
      @break
      @case(2)
      <p>レベル バド歴1年</p>
      @break
      @case(3)
      <p>レベル バド歴3年</p>
      @break
      @case(4)
      <p>レベル バド歴5年以上</p>
      @break
      @endswitch


      @if($project->remaining == 0)
      <p class="card-text"><mark>応募人数に達しました</mark></p>
      @else
      <p class="card-text">残り{{$project->remaining}}人！</p>
      @endif


      @auth
      <a href="{{ url('/project/'.$project->id) }}" class="btn btn-primary">詳細をみる</a>
      @endauth
    </div>
  </div>
  @endforeach
</div>