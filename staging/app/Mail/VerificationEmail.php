<?php

namespace App\Mail;
use App\Models\Emailtemplate;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Lang;
use Illuminate\Auth\Notifications\VerifyEmail as VerifyEmailBase;

class VerificationEmail extends VerifyEmailBase
{

    /**
     * Get the notification message.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\MessageBuilder
     */
    public function toMail($notifiable)
    {
        if (static::$toMailCallback) {
            return call_user_func(static::$toMailCallback, $notifiable);
        }

        $link = $this->verificationUrl($notifiable);

        $emailtemplate = Emailtemplate::where('id', '1')->first();
        $forgotpass_email_content = $emailtemplate->verify_email;
        //$forgotpass_email_content = '<p>Hello {#Firstname#}!</p><p>Please click the button below to verify your email address.</p><p style="text-align:center;"><a href="{#VerifyLink#}" class="es-button" target="_blank" style="mso-style-priority:100 !important;text-decoration:none;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-family:helvetica, \'helvetica neue\', arial, verdana, sans-serif;font-size:16px;color:#FFFFFF;border-style:solid;border-color:#056B4E;border-width:15px 30px;display:inline-block;background:#056B4E;border-radius:4px;font-weight:normal;font-style:normal;line-height:19px;width:auto;text-align:center">Verify Email Address</a></p><p>If you did not create an account, no further action is required.</p><p>Regards,</p><p>{#Sitename#}</p>';


        $site_title = config('site.title');
        $user = auth()->user();
        $fullname = $user?$user->name:'';
        $name = explode(' ', $fullname);
        $first_name = $name[0];

        $body_content = $forgotpass_email_content;
        $body_content = str_replace('{#Fullname#}', $fullname, $body_content);
        $body_content = str_replace('{#Firstname#}', $first_name, $body_content);
        $body_content = str_replace('{#VerifyLink#}', $link, $body_content);
        $body_content = str_replace('{#Sitename#}', $site_title, $body_content);

        return (new MailMessage)->subject('Verify Email Address')->view('layouts.email', compact('body_content') );
                     
    }
}