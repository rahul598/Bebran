<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CategoryPage extends Model
{
    protected $table = 'category_page';

    public function blog() 
    {
        return $this->belongsToMany(Page::class);
    }
}
