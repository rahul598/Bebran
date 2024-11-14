<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sample extends Model
{
    protected $table = 'sample';

    public function category() 
    {
        return $this->hasOne(SampleCategory::class, 'id', 'category_id');
    }

}
