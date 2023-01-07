<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Config;

class InviteeMail extends Mailable
{
    use Queueable, SerializesModels;

    public $MailData;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($MailData)
    {
        $this->MailData = $MailData;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {        
        return $this->subject($this->MailData['subject'])->view('emails.invite');
    }
}
