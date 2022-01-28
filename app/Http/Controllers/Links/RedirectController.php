<?php

namespace App\Http\Controllers\Links;

use App\Http\Controllers\Links\MainController;

class RedirectController extends MainController
{
    public function __invoke($link)
    {
        return redirect($this->service->redirect($link));
    }
}
