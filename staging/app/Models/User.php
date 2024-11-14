<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

use App\Mail\ResetPassword;
use App\Mail\VerificationEmail;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password', 'role_id', 'fname', 'lname', 'phone_number', 'avatar', 'description', 'facebook_url', 'instagram_url', 'twitter_url', 'linkedin_url', 'country_id', 'city', 'zip_code', 'occupation', 'last_login', 'already_logged'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    /**
     * Send the password reset notification.
     *
     * @param  string  $token
     * @return void
     */
    public function sendPasswordResetNotification($token)
    {
        $this->notify(new ResetPassword($token));
    }
    public function sendEmailVerificationNotification()
    {
        $this->notify(new VerificationEmail());
    }

    public function role() 
    {
        return $this->belongsTo(Role::class, 'role_id');
    }

    public function country()
    {
        return $this->belongsTo(Country::class, 'country_id');
    }

    public function state() 
    {
        return $this->belongsTo(States::class, 'state_id');
    }

    /*public function skill()
    {
        return $this->belongsToMany(Skill::class);
    }

    public function ratings()
    {
        return $this->hasMany(UserRating::class, 'user_id');
    }

    public function avg_rating()
    {
        return $this->ratings()->avg('rating');
        /*$user_id = $this->getAttribute('id');
        if ($avatar && File::exists(public_path('uploads/' . $avatar))) {
            return asset('/uploads/' . $avatar);
        }
        return asset('/frontend/teacher/images/profile_user.png');*/
/*    }

    public function total_review()
    {
        return $this->hasMany(UserRating::class, 'user_id')->whereNotNull('review');
        // return $this->ratings()->whereNotNull('review')->count();
    }*/
}
