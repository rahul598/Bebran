<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Portfolio extends Model
{
    protected $table = 'portfolio';

    public function category() 
    {
        return $this->hasOne(PortfolioCategory::class, 'id', 'category_id');
    }

}
