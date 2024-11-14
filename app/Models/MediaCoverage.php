<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MediaCoverage extends Model
{
    protected $table = 'media_coverage';

    public function category() 
    {
        return $this->hasOne(MediaCoverageCategory::class, 'id', 'category_id');
    }

}
