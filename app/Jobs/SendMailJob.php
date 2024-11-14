<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class SendMailJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public $data;
    public function __construct($data)
    {
        $this->data = $data;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $data_arr = $this->data;
        Mail::send([], [], function ($message) use ($data_arr) {
            // $message->from(env('MAIL_FROM_ADDRESS'), env('MAIL_FROM_NAME'));
            // $message->replyTo(env('MAIL_FROM_ADDRESS'), env('MAIL_FROM_NAME'));
            // $message->from('dkdbit@gmail.com', 'Dev');
            // $message->replyTo('dkdbit@gmail.com', 'Dev');
            $message->subject($data_arr['subject']);
            $message->setBody($data_arr['content'], 'text/html');
            $message->to($data_arr['to']);
        });
    }
}