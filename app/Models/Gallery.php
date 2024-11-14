<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Gallery extends Model
{
    protected $table = 'gallery';
    protected $fillable = ['parent_id', 'file'];

    public function service()
    {
        return $this->belongsTo(Service::class,'parent_id');
    }

    public function job()
    {
        return $this->belongsTo(HfJob::class,'parent_id');
    }
}
