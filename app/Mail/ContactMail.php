<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ContactMail extends Mailable
{
    use Queueable, SerializesModels;

    protected $message = '';
    protected $email = '';
    protected $name = '';
    protected $reason = '';

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($data = '')
    {
        $this->message = $data['message'];
        $this->email = $data['email'];
        $this->name = $data['name'];
        $this->reason = $data['reason'];

        $this->replyTo($data['email'], $data['name']);
    }

    /**
     * Get the message envelope.
     *
     * @return \Illuminate\Mail\Mailables\Envelope
     */
    public function envelope()
    {
        return new Envelope(
            subject: 'Contato via site',
        );
    }

    /**
     * Get the message content definition.
     *
     * @return \Illuminate\Mail\Mailables\Content
     */
    public function content()
    {
        return new Content(
            view: 'email.contact',
            with: ['messageText' => $this->message, 'email' => $this->email, 'name' => $this->name, 'reason' => $this->reason]
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array
     */
    public function attachments()
    {
        return [];
    }
}
