<?php

namespace App\Mail;

use App\Models\RedlineMember;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class RedlineWelcomeMail extends Mailable
{
    use Queueable, SerializesModels;

    public RedlineMember $member;

    public function __construct(RedlineMember $member)
    {
        $this->member = $member;
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Welcome to the Red Line Club – TopGear India',
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.redline-welcome',
            with: [
                'member' => $this->member,
            ],
        );
    }
}
