<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GuestPost extends Model
{
    protected $table = 'guest_post';
    // protected $fillable = ['parent_id', 'file'];

    // public function service()
    // {
    //     return $this->belongsTo(Service::class,'parent_id');
    // }

    // public function job()
    // {
    //     return $this->belongsTo(HfJob::class,'parent_id');
    // }
}
