<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use Carbon\Carbon; // 追記

class TicketSend extends Mailable
{
    use Queueable, SerializesModels;
    

    public $data;
    public $ticket;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($data, Ticket $ticket)
    {
        $this->data = $data;
        $this->ticket = $ticket;
    }

    /**
     * Get the message envelope.
     *
     * @return \Illuminate\Mail\Mailables\Envelope
     */
    public function envelope()
    {
        return new Envelope(
            subject: 'Ticket Send',
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
            markdown: 'ticketsendcontent',
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
    
    
    
    public function build()
    {
        return $this->view('emails.ticket_send')
                    ->with([
                        'recipient_email' => $this->data['recipient_email'],
                        'gift_sender' => $this->data['gift_sender'],
                        'message' => $this->data['message'],
                        'qrcode_url' => 'https://dummyurl.com/qr.png',
                        'product_name' => $this->ticket->product->product_name,
                        'price' => $this->ticket->product->price,
                        'expiry_date' => date('Y/m/d', strtotime($this->ticket->userTickets->first()->get_date . '+3 months')),
                        'ticket_id' => $this->ticket->id,
                    ]);
    }
}
