<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Contact_us extends Model
{
    protected $table = 'contact_us';

    protected $fillable = [
        'id', // Add 'id' to the fillable property
        'page_id',
        'first_name',
        'last_name',
        'email',
        'phone',
        'location',
        'service_name',
        'budget',
        'website',
        'skype',
        'whatsapp',
        'message',
        'created_at',
        // Add more columns as necessary
    ];

    // protected $fillable = ['last_name'];

    // public function setNameAttribute($last_name)
    // {
    //     $this->attributes['last_name'] = $this->nullIfBlank($last_name);
    // }
}
