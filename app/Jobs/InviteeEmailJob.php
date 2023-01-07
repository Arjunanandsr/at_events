<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Mail\InviteeMail;
use Mail;
use Illuminate\Support\Facades\Config;

class InviteeEmailJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $details;
    protected $mailInfo;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($details,$mailInfo)
    {
        $this->details = $details;
        $this->mailInfo = $mailInfo;

    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $to  =  $this->details['email'];
        $MailData['name'] = $this->details['email'];
        $MailData['token'] = $this->details['token'];
        $MailData['subject'] = $this->mailInfo['subject'];
        $MailData['url'] = $this->mailInfo['url'];
        $email = new InviteeMail($MailData);
        Mail::to($to)->send($email);
    }
}
