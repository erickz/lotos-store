<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class BolaoInviteMail extends Mailable
{
    use Queueable, SerializesModels;

    protected $data = '';

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($data = '')
    {
        $this->data = $data;

        $this->replyTo('contato@lotosonline.com.br', env('APP_NAME'));
    }

    /**
     * Get the message envelope.
     *
     * @return \Illuminate\Mail\Mailables\Envelope
     */
    public function envelope()
    {
        $concurso = $this->data['concurso'];
        $invite = $this->data['invite'];
        $lotery = $this->data['lotery'];

        return new Envelope(
            subject: 'Você ganhou ' . $invite->cotas . ' cota' . ($invite->cotas > 1 ? 's' : '') . ' de um Bolão da ' . $lotery->name,
        );
    }

    /**
     * Get the message content definition.
     *
     * @return \Illuminate\Mail\Mailables\Content
     */
    public function content()
    {
        $concurso = $this->data['concurso'];

        return new Content(
            view: 'email.bolao_invite',
            with: [
                'invite' => $this->data['invite'], 
                'concurso' => $concurso, 
                'concursoDate' => $concurso->getDrawDay(),
                'bolao' => $this->data['bolao'], 
                'ownerName' => $this->data['owner']->getFirstName(),
                'lotery' => $this->data['lotery'],
                'concursoPrize' => $concurso->getFormattedNextExpectedPrize(),
                'siteName' => env('APP_NAME')
            ]
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
