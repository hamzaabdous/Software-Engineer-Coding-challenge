<?php

namespace App\Modules\Products\Models;

use Illuminate\Database\Eloquent\Model;
use App\Modules\CartItems\Models\CartItems;
class Products extends Model
{
    protected $fillable = ['name', 'description', 'price', 'stock'];

    public function cartItems()
    {
        return $this->hasMany(CartItems::class);
    }
}
