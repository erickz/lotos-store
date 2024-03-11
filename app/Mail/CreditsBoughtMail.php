<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class CreditsBoughtMail extends Mailable
{
    use Queueable, SerializesModels;

    public $credits;
    public $customerName;
    public $dataBuy;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($customerName = '', $credits = 0, $dataBuy = '')
    {
        $this->customerName = $customerName;
        $this->credits = $credits;
        $this->dataBuy = $dataBuy;
    }

    /**
     * Get the message envelope.
     *
     * @return \Illuminate\Mail\Mailables\Envelope
     */
    public function envelope()
    {
        return new Envelope(
            subject: 'Compra de créditos realizada com sucesso!',
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
            view: 'email.credits-bought',
            with: ['customerName' => $this->customerName ,'credits' => $this->credits, 'dataBuy' => $this->dataBuy, 'siteName' => env('APP_NAME')]
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
