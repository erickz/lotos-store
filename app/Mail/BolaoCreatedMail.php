<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

use App\Models\Customer;
use App\Models\Concurso;
use App\Models\Lotery;

class BolaoCreatedMail extends Mailable
{
    use Queueable, SerializesModels;

    public $bolaoData;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($bolaoData)
    {
        $this->bolaoData = $bolaoData;
    }

    /**
     * Get the message envelope.
     *
     * @return \Illuminate\Mail\Mailables\Envelope
     */
    public function envelope()
    {
        return new Envelope(
            subject: 'Seu Bolão no ' . env('APP_NAME') . ' foi criado com sucesso - Hora de compartilhar!',
        );
    }

    /**
     * Get the message content definition.
     *
     * @return \Illuminate\Mail\Mailables\Content
     */
    public function content()
    {
        $customer = Customer::find($this->bolaoData['customer_id']);
        $lotery = Lotery::find($this->bolaoData['lotery_id']);
        $concurso = Concurso::find($this->bolaoData['concurso_id']);

        return new Content(
            view: 'email.bolao-created',
            with: ['bolaoData' => $this->bolaoData, 'concursoLabel' => 'Nº' . $concurso->number . ' - ' . $concurso->getDrawDay(), 'customerName' => $customer->getFirstName(), 'loteryName' => $lotery->name, 'siteName' => env('APP_NAME')]
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
