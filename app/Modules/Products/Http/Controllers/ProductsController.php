<?php

namespace App\Modules\Products\Http\Controllers;

use Illuminate\Http\Request;

class ProductsController
{

    /**
     * Display the module welcome screen
     *
     * @return \Illuminate\Http\Response
     */
    public function welcome()
    {
        return view("Products::welcome");
    }
}
