<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{

    protected $fillable = ['connection_id', 'from_user_id', 'to_user_id', 'message_type', 'message', 'file_name', 'is_read', 'contract_id'];

    public function from()
    {
        return $this->belongsTo(User::class, 'from_user_id');
    }

    public function to()
    {
        return $this->belongsTo(User::class, 'to_user_id');
    }

    public function connection()
    {
        return $this->belongsTo(MessageConnection::class, 'connection_id');
    }

    public function contract()
    {
        return $this->belongsTo(JobContract::class, 'contract_id');
    }
}