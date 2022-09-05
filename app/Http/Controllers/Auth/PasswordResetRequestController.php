<?php

namespace App\Http\Controllers\Auth;

use App\Helpers\Helper;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\PasswordResetRequest;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Models\User;
use App\Mail\SendMail;
use App\Notifications\ResetPasswordNotification;
use Illuminate\Support\Facades\Mail;
use Carbon\Carbon;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use stdClass;

class PasswordResetRequestController extends Controller
{

    protected $is_public = true;
    protected $need_permission = false;

    public function __invoke(PasswordResetRequest $request)
    {
        $user = User::where($request->validated())->first();
        if ($user) {
            $this->sendMail($request);
        }
        return $this->success(new stdClass, 'Check your inbox, we have sent a link to reset email.');
    }

    public function sendMail($request)
    {
        $token = $this->generateToken($request->email);
        $user  = User::whereEmail($request->email)->first();
        //Notification::send($user, new ResetPasswordNotification($user, $token));
        $args = Helper::toObject([
            'name' => $user->name,
            'token' => $token
        ]);
        $user->notify(new ResetPasswordNotification($args));
    }

    public function validEmail($email)
    {
        return !!User::where('email', $email)->first();
    }

    public function generateToken($email)
    {
        $isOtherToken = DB::table('password_resets')->where('email', $email)->first();
        if ($isOtherToken) {
            return $isOtherToken->token;
        }
        $token = Str::random(80);;
        $this->storeToken($token, $email);
        return $token;
    }
    public function storeToken($token, $email)
    {
        DB::table('password_resets')->insert([
            'email' => $email,
            'token' => $token,
            'created_at' => Carbon::now()->timestamp
        ]);
    }
}
