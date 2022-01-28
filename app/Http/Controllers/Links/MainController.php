<?php

namespace App\Http\Controllers\Links;

use App\Http\Controllers\Controller;
use App\Services\Links\Service;

class MainController extends Controller
{
    public $service;

    public function __construct(Service $service)
    {
        $this->middleware('auth');
        $this->service = $service;
    }
}
