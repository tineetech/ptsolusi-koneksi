<?php

namespace App\Mail;

use App\Models\PesanKontak;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class BalasanPesanKontak extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(
        public PesanKontak $pesan,
        public string $subjekBalasan,
        public string $isiBalasan,
    ) {
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: $this->subjekBalasan,
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.balasan-pesan',
        );
    }
}
