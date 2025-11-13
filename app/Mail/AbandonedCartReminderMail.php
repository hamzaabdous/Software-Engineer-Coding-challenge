<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class AbandonedCartReminderMail extends Mailable
{
    use Queueable, SerializesModels;
    public $cart;
    public $reminderNumber;
    public function __construct($cart, $reminderNumber)
    {
        $this->cart = $cart;
        $this->reminderNumber = $reminderNumber;
    }
    
    public function build()
    {
        return $this->subject("Complete Your Order - Reminder #{$this->reminderNumber}")
                    ->view('emails.cart_reminder');
    }
}
