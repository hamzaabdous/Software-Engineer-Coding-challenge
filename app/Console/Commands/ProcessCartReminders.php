<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\jobs\SendCartReminderJob;
use App\Modules\Carts\Models\Carts;
use Carbon\Carbon;

class ProcessCartReminders extends Command
{

/*     public function handle()
    {
        $carts = Carts::where('is_finalized', false)->get();

        foreach ($carts as $cart) {
            $lastReminder = $cart->reminderLogs()->latest('reminder_number')->first();
            $nextReminder = $lastReminder ? $lastReminder->reminder_number + 1 : 1;

            if ($nextReminder > 3)
                continue;

            $lastActionTime = $lastReminder->sent_at ?? $cart->created_at;
            $diffInHours = now()->diffInHours($lastActionTime);

            $interval = config("cart.reminder_intervals.$nextReminder");

            if ($diffInHours >= $interval) {
                dispatch(new SendCartReminderJob($cart, $nextReminder));
            }
        }
    } */
    protected $signature = 'cart:process-reminders';
    protected $description = 'Send reminder emails for abandoned carts';

    public function handlec()
    {
        $intervals = config('cart.reminder_intervals');
        $carts = Carts::where('is_finalized', false)->get();
    
        if ($carts->isEmpty()) {
            $this->info('No carts found to process.');
            return Command::SUCCESS;
        }
    
        $processed = false;
    
        foreach ($carts as $cart) {
            $lastReminder = $cart->reminderLogs()->latest('reminder_number')->first();
            $nextReminder = $lastReminder ? $lastReminder->reminder_number + 1 : 1;
    
            if ($nextReminder > 3) continue;
    
            $lastTime = $lastReminder->sent_at ?? $cart->created_at;
            $hoursPassed = now()->diffInHours($lastTime);
    
            if ($hoursPassed >= $intervals[$nextReminder]) {
                SendCartReminderJob::dispatch($cart, $nextReminder);
                $this->info("Dispatched reminder #{$nextReminder} for cart ID: {$cart->id}");
                $processed = true;
            }
        }
    
        if (!$processed) {
            $this->info('No carts matched reminder conditions.');
        }
    
        return Command::SUCCESS;
    }
    public function handle()
    {
        $intervals = config('cart.reminder_intervals');

        $carts = Carts::where('is_finalized', false)->get();

        if ($carts->isEmpty()) {
            $this->info('No carts found to process.');
            return Command::SUCCESS;
        }

        foreach ($carts as $cart) {
            $this->info("Checking cart ID: {$cart->id}");

            $lastReminder = $cart->reminderLogs()->latest('reminder_number')->first();
            $nextReminderNumber = $lastReminder ? $lastReminder->reminder_number + 1 : 1;
            $this->info("Next reminder: $nextReminderNumber");

            $lastTime = $lastReminder->sent_at ?? $cart->created_at;
            $this->info("Cart created/sent at: " . $lastTime);

            $hoursPassed = Carbon::parse($lastTime)->diffInHours(now());
            $this->info("Hours passed: $hoursPassed");

            $interval = $intervals[$nextReminderNumber] ?? null;
            $this->info("Interval needed: $interval");

            if ($interval !== null && $hoursPassed >= $interval) {
                SendCartReminderJob::dispatch($cart, $nextReminderNumber);
                $this->info("✅ Dispatched reminder #{$nextReminderNumber} for cart ID: {$cart->id}");
            } else {
                $this->info("⏳ Not enough time passed.");
            }
        }

        return Command::SUCCESS;
        
    }
}
