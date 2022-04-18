<?php

namespace App;

use App\Models\Subscription;
use Illuminate\Database\Eloquent\Model;

class JournalistWorkFile extends Model
{
	protected $table = 'journalist_work_files';

	public function user()
    {
    	return $this->belongsTo(User::class);
    }

    public function booking(){
        return $this->belongsTo(Booking::class,'story_id','id');
    }

    public function scopeActive()
    {
    	return $this->where('status', 1);
    }
}
