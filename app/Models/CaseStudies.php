<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CaseStudies extends Model
{
    protected $table = 'case_studies';

    public function category() 
    {
        return $this->hasOne(CaseStudiesCategory::class, 'id', 'category_id');
    }

}
