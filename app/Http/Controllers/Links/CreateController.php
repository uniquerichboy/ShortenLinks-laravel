<?php

namespace App\Http\Controllers\Links;

use App\Http\Controllers\Links\MainController;
use App\Http\Requests\Links\CreateRequest;

class CreateController extends MainController
{
    public function __invoke(CreateRequest $request)
    {
        $request->validated();
        $create = $this->service->create($request);
        return redirect()->route('home');
    }
}
