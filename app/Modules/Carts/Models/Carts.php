<?php

namespace App\Modules\Carts\Models;

use Illuminate\Database\Eloquent\Model;
use App\Modules\CartItems\Models\CartItems;
use App\Models\User;
use App\Modules\CartReminderLogs\Models\CartReminderLogs;

class Carts extends Model
{
    protected $fillable = ['user_id', 'is_finalized'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function items()
    {
        return $this->hasMany(CartItems::class);
    }

    public function reminderLogs()
    {
        return $this->hasMany(CartReminderLogs::class, 'cart_id');
    }
}
