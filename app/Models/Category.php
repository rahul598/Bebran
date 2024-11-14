<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = 'category';

    public function blog() 
    {
        return $this->belongsToMany(Page::class);
    }
}
