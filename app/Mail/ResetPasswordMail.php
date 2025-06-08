<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
namespace App\Mail;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ResetPasswordMail extends Mailable
{
    use Queueable, SerializesModels;

    public $link;

    public function __construct($link)
    {
        $this->link = $link;
    }

    public function build()
    {
        return $this->subject('Redefinição de Senha')
                    ->view('mail.reset-password')
                    ->with(['link' => $this->link]);
    }
}
