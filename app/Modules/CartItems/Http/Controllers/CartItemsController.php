<?php

namespace App\Modules\CartItems\Http\Controllers;

use Illuminate\Http\Request;

class CartItemsController
{

    /**
     * Display the module welcome screen
     *
     * @return \Illuminate\Http\Response
     */
    public function welcome()
    {
        return view("CartItems::welcome");
    }
}
