<?php

namespace App\Http\Controllers\Links;

use App\Http\Controllers\Links\MainController;

class DeleteController extends MainController
{
    public function __invoke($id)
    {
        $this->service->delete($id);
        return redirect()->route('home');
    }
}
