<?php

namespace App\Jobs;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\Mail;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

use App\Modules\CartReminderLogs\Models\CartReminderLogs;
use App\Mail\AbandonedCartReminderMail;

class SendCartReminderJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $cart;
    protected $reminderNumber;

    public function __construct($cart, $reminderNumber)
    {
        $this->cart = $cart;
        $this->reminderNumber = $reminderNumber;
    }

    public function handle()
    {
        if ($this->cart->is_finalized) return;

        Mail::to($this->cart->user->email)->send(
            new AbandonedCartReminderMail($this->cart, $this->reminderNumber)
        );

        CartReminderLogs::create([
            'cart_id' => $this->cart->id,
            'reminder_number' => $this->reminderNumber,
            'sent_at' => now(),
        ]);
    }
}
