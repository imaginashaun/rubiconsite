<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Conversation extends Model
{
    protected $table = 'conversations';
    
    public function sender()
    {
       return $this->belongsTo('App\User', 'sender_id');
    }

    public function receiver()
    {
       return $this->belongsTo('App\User', 'receiver_id');
    }

    public function messages(){
    	   return $this->hasMany(Message::class, 'conversion_id');
    }
}
