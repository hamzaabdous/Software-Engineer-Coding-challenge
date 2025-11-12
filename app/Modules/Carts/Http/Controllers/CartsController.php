<?php

namespace App\Modules\Carts\Http\Controllers;

use Illuminate\Http\Request;

class CartsController
{

    /**
     * Display the module welcome screen
     *
     * @return \Illuminate\Http\Response
     */
    public function welcome()
    {
        return view("Carts::welcome");
    }
}
