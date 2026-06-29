<?php

namespace App\Mail;

use App\Models\BreakfastDriveMember;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class BreakfastDriveWelcomeMail extends Mailable
{
    use Queueable, SerializesModels;

    public BreakfastDriveMember $member;

    public function __construct(BreakfastDriveMember $member)
    {
        $this->member = $member;
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'You\'re In! Breakfast Drive – TopGear India',
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.breakfast-drive-welcome',
            with: [
                'member' => $this->member,
            ],
        );
    }
}
