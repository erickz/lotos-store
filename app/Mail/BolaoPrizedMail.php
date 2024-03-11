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

class BolaoPrizedMail extends Mailable
{
    use Queueable, SerializesModels;

    public $bolaoData;
    public $lotery;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($bolaoData)
    {
        $this->bolaoData = $bolaoData;
        $this->lotery = Lotery::find($this->bolaoData['lotery_id']);
    }

    /**
     * Get the message envelope.
     *
     * @return \Illuminate\Mail\Mailables\Envelope
     */
    public function envelope()
    {
        return new Envelope(
            subject: 'Parabéns! Seu bolão da ' . $this->lotery->name . ' foi premiado!',
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
        $concurso = Concurso::find($this->bolaoData['concurso_id']);
        $lotery = $this->lotery;

        return new Content(
            view: 'email.bolao-prized',
            with: ['customerName' => $customer->getFirstName(), 'concursoLabel' => 'Nº' . $concurso->number . ' - ' . $concurso->getDrawDay(), 'bolaoName' => $this->bolaoData['name'], 'cotasBought' => $this->bolaoData['cotas'], 'prized' => $this->bolaoData['prized'], 'loteryName' => $lotery->name, 'siteName' => env('APP_NAME')]
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
