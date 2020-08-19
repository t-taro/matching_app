
<!-- TODO:storeとupdateを実装する -->
@if($target == 'store')
<form action="/project/store" method="post">
@elseif($target == 'update')
<form action="/project/update" method="post">
  @method('PATCH')
@endif
  @csrf
  <input type="hidden" name="id" value="{{$project->id}}">
  
  @if($message)
  <p class="text-danger">{{$message}}</p>
  @endif
  
  <label for="place" class="m-0">場所</label>
  <input type="text" name="place" id="place" class="form-control mb-3" value="{{$project->place}}">
  
  <label for="open_at" class="m-0">開始時間</label>
  <input id="open_at" class="form-control mb-3" type="datetime-local" name="open_at" step="900" 
    @if($target == 'update')
    value="{{str_replace(" ", "T", $project->open_at)}}"
    @endif
  >
  
  <div class="selectWrapper d-flex flex-column w-50 mx-auto">
    <label for="min_member">募集人数</label>
    <select name="min_member" id="min_member">
      @for($i = 1; $i < 10; $i++)
        @if($i == $project->min_member)
          <option value={{$i}} selected>{{$i}}</option>
        @else
          <option value={{$i}}>{{$i}}</option>
        @endif
      @endfor
    </select>
  </div>
  
  <div class="selectWrapper d-flex flex-column w-50 mx-auto">
    <label for="level">レベル</label>
    <select name="level" id="level">
      @for($i = 1; $i < 5; $i++)
        @if($i == $project->level)
          <option value={{$i}} selected>{{$i}}</option>
        @else
          <option value={{$i}}>{{$i}}</option>
        @endif
      @endfor
    </select>
  </div>
  
  <div class="text-center mt-5">
    <input type="submit" class="btn btn-warning px-3"
    @if($target == 'store')
      value="プロジェクトを主催する" 
    @elseif($target == 'update')
      value="変更する" 
    @endif
    > 
  </div>
</form>