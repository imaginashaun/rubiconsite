<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = 'categories';

    protected $guarded = ['id'];

    public function scopeActive()
    {
        return $this->where('status', 1);
    }
}
