<?php

namespace App\Modules\CartReminderLogs\Http\Controllers;

use Illuminate\Http\Request;

class CartReminderLogsController
{

    /**
     * Display the module welcome screen
     *
     * @return \Illuminate\Http\Response
     */
    public function welcome()
    {
        return view("CartReminderLogs::welcome");
    }
}
