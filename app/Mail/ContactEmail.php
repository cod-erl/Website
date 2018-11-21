<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class ContactEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $contact ;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($contact)
    {
        return $this->contact=$contact;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Re:Contact')
            ->view('emails.contact_email')->withContact($this->contact);
    }
}
