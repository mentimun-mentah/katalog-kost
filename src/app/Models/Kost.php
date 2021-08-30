<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kost extends Model
{
  use HasFactory;

  protected $fillable = [
    'image', 'name','slug',
    'category','total_rooms',
    'price_day', 'price_month', 'price_year',
    'facilities','lat','lng',
    'address', 'desc', 'user_id'
  ];

  public function user(){
      return $this->belongsTo('App\Models\User');
  }

  public function ratings(){
      return $this->hasMany('App\Models\Rating');
  }

}
