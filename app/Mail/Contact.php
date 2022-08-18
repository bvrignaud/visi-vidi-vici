<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class Contact extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    /**
     * @param  array<string, mixed>  $details
     */
    public function __construct(private array $details)
    {
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build(): Contact
    {
        return $this->markdown('emails.contact', $this->details);
    }
}
