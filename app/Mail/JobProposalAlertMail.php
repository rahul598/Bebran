<?php
namespace App\Mail;

use App\Models\Emailtemplate;
use App\Models\User;
use App\Models\HfJob;
use App\Models\JobProposal;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class JobProposalAlertMail extends Mailable
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
        $job_proposal_alert = $emailtemplate->job_proposal_alert;

        $site_title = config('site.title');
        $proposal_id = $this->user['proposal_id'];
        $proposal = JobProposal::where('id',$proposal_id)->with('user')->first();
        $job = HfJob::where('id',$proposal->job_id)->with('user')->first();

        $body_content = $job_proposal_alert;
        $body_content = str_replace('{#JobTitle#}', $job->title, $body_content);
        $body_content = str_replace('{#JobNumber#}', $job->job_number, $body_content);
        $body_content = str_replace('{#Fullname#}', $job->user->name, $body_content);
        $body_content = str_replace('{#WorkerFullname#}', $proposal->user->name, $body_content);
        $body_content = str_replace('{#Sitename#}', $site_title, $body_content);

        return $this->view('layouts.email', compact('body_content'));
    }
}