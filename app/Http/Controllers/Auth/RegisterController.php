<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\RegisterRequest;
use App\Models\User;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    protected $is_public = true;
    protected $need_permission = false;
    public $token = false;

    public function __invoke(RegisterRequest $request)
    {
        $user = User::create([
            'name'      => $request->name,
            'email'     => $request->email,
            'msisdn'    => $request->msisdn,
            'password'  => bcrypt($request->password),
        ]);

        if ($this->token) {
            $token = new LoginController($request);
            return $token;
        }
        $data = $user;
        return $this->success($data, "Regisration Success");
    }
}
