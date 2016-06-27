<?php

namespace App\Http\Controllers\Yoyo;

use App\Http\Controllers\Yoyo\CoreController;

class HomeController extends CoreController
{
    /**
     * Load page
     */
    public function index()
    {
        return view('yoyo.home.index');
    }
}
