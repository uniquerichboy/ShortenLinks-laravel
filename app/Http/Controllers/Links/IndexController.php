<?php

namespace App\Http\Controllers\Links;

use App\Http\Controllers\Links\MainController;
use Illuminate\Http\Request;

class IndexController extends MainController
{ 
    public function __invoke()
    {
        return view('home', [
            'links' => $this->service->get()
        ]); 
    }
}
