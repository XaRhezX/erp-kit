<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\Response;
use Tymon\JWTAuth\Facades\JWTAuth;

class LoginController extends Controller
{
    protected $is_public = true;
    protected $need_permission = false;

    public function __invoke(LoginRequest $request)
    {
        $input = $request->only('msisdn', 'email', 'password');
        $jwt_token = null;

        if (!$jwt_token = JWTAuth::attempt($input)) {
            return $this->error(Response::HTTP_UNAUTHORIZED, [
                'error' => [
                    'password' => ['Invalid Password']
                ]
            ]);
        }

        $user = JWTAuth::user();
        $customClaims = [
            'user'  => $user->makeHidden('roles'),
            'roles' => $user->getRoleNames(),
            'permissions' => $user->getPermissionsViaRoles()->pluck('name'),
        ];
        $jwt_token = JWTAuth::claims($customClaims)->attempt($input);

        $data = collect([
            'token' => $jwt_token,
            'version' => session()->getId(),
        ]);

        return $this->success($data);
    }
}
