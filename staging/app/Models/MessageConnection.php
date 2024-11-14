<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MessageConnection extends Model
{

    protected $fillable = ['from_user_id', 'to_user_id', 'connection_code', 'message', 'status', 'updated_by'];

    public function jobproposals()
    {
        return $this->belongsTo(JobProposal::class, 'connection_code', 'code');
    }
}