<?php
namespace App\Mail;

use App\Models\Emailtemplate;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class WelcomeMail extends Mailable
{
    use Queueable, SerializesModels;


    public $user;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($user)
    {
        $this->user = $user;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $emailtemplate = Emailtemplate::where('id', '1')->first();
        $registration_email_content = $emailtemplate->registration_email;

        $site_title = config('site.title');

        //$fullname = $this->user['fname'].' '.$this->user['lname'];

        $name = $this->user['name'];
        $first_name = $this->user['fname'];

        $body_content = $registration_email_content;
        $body_content = str_replace('{#Fullname#}', $name, $body_content);
        $body_content = str_replace('{#Firstname#}', $first_name, $body_content);
        $body_content = str_replace('{#Email#}', $this->user['email'], $body_content);
        //$body_content = str_replace('{#UserName#}', $this->user['username'], $body_content);
        $body_content = str_replace('{#Password#}', $this->user['password'], $body_content);
        $body_content = str_replace('{#Sitename#}', $site_title, $body_content);
        $body_content = str_replace('{#Loginurl#}', url('login'), $body_content);


        return $this->view('layouts.email', compact('body_content'));
    }
}