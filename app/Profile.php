<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
  protected $fillable = [
    'user_id',
    'description'
  ];
  
  public static function registerId($user_id){

    return Self::create(['user_id' => $user_id ]);
  
  }
  
}
