<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Api\CoreController;

class ApiController extends CoreController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('api.index');
    }
}
