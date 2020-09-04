<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
  protected $fillable = ['organizer_id', 'place', 'min_member', 'level', 'open_at'];
  
  // $datesプロパティをセットすることにより、データ属性を追加できます。
  // created_atの様にビューでobjectで扱える様になるので、ビュー側でformat()が可能になる。
  protected $dates = [
    'open_at',
  ];
  
  public function users()
  {
    return $this->belongsToMany('App\User');
  }
  
  public function messages()
  {
    return $this->hasMany('App\Message');
  }
}
