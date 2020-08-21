<h1>{{$project->place}}</h1>
<p>{{$project->open_at->format('Y年m月d日 H:i')}}</p>
<p>主催者 <a href="{{ url('/profile/'.$project->organizer->id)}}">{{$project->organizer->name}}</a></p>
<p>募集人数 {{$project->min_member}}</p>

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
