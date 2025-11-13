<?php

namespace App\Modules\CartItems\Models;

use Illuminate\Database\Eloquent\Model;

use App\Modules\Carts\Models\Carts;
use App\Modules\Products\Models\Products;

class CartItems extends Model
{
    protected $fillable = ['cart_id', 'product_id', 'quantity'];

    public function cart()
    {
        return $this->belongsTo(Carts::class);
    }

    public function product()
    {
        return $this->belongsTo(Products::class);
    }
}
