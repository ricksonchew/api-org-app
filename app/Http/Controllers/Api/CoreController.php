<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;

class CoreController extends Controller
{
    protected $sqlConnection;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->sqlConnection = app('db')->connection(env('DB_DATABASE'));
    }

    /**
     * Get custom messages
     * @return array
     */
    protected function getCustomMessages()
    {
        return trans('customMessages');
    }
}
