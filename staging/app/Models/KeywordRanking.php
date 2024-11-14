<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KeywordRanking extends Model
{
    protected $table = 'keyword_ranking';
    protected $fillable = ['excel_id','keyword', 'previous_position','current_position'];

}
