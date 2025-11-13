<?php

namespace App\Modules\CartReminderLogs\Models;

use Illuminate\Database\Eloquent\Model;
use App\Modules\Carts\Models\Carts;

class CartReminderLogs extends Model
{
    protected $fillable = ['cart_id', 'reminder_number', 'sent_at'];

    public function cart()
    {
        return $this->belongsTo(Carts::class, 'cart_id');
    }
}
