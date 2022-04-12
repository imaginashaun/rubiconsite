<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class JournalistWorkFile extends Model
{
	protected $table = 'journalist_work_files';

	public function user()
    {
    	return $this->belongsTo(User::class);
    }

    public function scopeActive()
    {
    	return $this->where('status', 1);
    }
}
