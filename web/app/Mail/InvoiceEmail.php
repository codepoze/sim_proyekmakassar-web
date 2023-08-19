<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class InvoiceEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $title;
    public $content;
    public $pdf;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($title, $content, $pdf)
    {
        $this->title = $title;
        $this->content = $content;
        $this->pdf     = $pdf;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('email/invoice')
            ->subject($this->title)
            ->with('data', $this->content)
            ->attachData($this->pdf->output(), 'Invoice.pdf');
    }
}
