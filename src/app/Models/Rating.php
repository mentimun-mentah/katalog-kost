<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rating extends Model
{
  use HasFactory;

  protected $fillable = [
    'rating', 'review', 'user_id', 'kost_id'
  ];

  public function user(){
      return $this->belongsTo('App\Models\User');
  }

  public function kost(){
      return $this->belongsTo('App\Models\Kost');
  }

}
