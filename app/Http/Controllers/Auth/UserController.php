<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Traits\JsonResponse;
use Illuminate\Http\Request;

class UserController extends Controller
{
    use JsonResponse;
    public function getData()
    {
        return $this->success(auth()->user());
    }
}
