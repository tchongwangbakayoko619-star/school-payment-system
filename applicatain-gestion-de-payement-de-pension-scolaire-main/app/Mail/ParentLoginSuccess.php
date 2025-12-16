<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use Illuminate\Mail\Mailables\Address;
class ParentLoginSuccess extends Mailable
{
    use Queueable, SerializesModels;

    public string $homePageLink;

    /**
     * Create a new message instance.
     */
    public function __construct(string $homePageLink)
    {
        $this->homePageLink = $homePageLink;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            from: new Address(address: 'nathanbakayoko237999999999@gmail.com', name: 'Nathan Bakayoko'),
          subject: 'Parent Login Success',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.parent_login_success',
            with: ['homePageLink' => $this->homePageLink],
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}
