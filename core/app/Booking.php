<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
   
    protected $guarded = ['id'];
    protected $table = 'bookings';

    public function member()
    {
        return $this->belongsTo("App\User", 'member_id', 'id');
    }

    public function journalist()
    {
        return $this->belongsTo("App\User", 'user_id');
    }

    public function service()
    {
        return $this->belongsTo("App\Service", 'service_id');
    }

    public function workDelivery()
    {
        return $this->hasMany("App\WorkDelivery", 'booking_id');
    }


}
