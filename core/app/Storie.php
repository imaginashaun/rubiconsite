<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Storie extends Model
{
      protected $table = 'stories';

      protected $guarded = ['id'];


      public function journalist()
      {
          return $this->belongsTo("App\User", 'user_id');
      }

      public function category()
      {
          return $this->belongsTo("App\Category", 'category_id');
      }
}
