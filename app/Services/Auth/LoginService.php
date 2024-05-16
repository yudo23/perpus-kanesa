<?php

namespace App\Services\Auth;

use App\Services\BaseService;
use Illuminate\Http\Request;
use App\Enums\RoleEnum;
use App\Http\Requests\Auth\LoginRequest;
use Auth;
use Illuminate\Http\Response;
use Log;

/**
 * Class LoginService.
 */
class LoginService extends BaseService
{
    public function login(LoginRequest $request)
    {
        try {
            $username = (empty($request->username)) ? null : trim(strip_tags($request->username));
            $password = (empty($request->password)) ? null : trim(strip_tags($request->password));
            $rememberme = (empty($request->rememberme)) ? null : trim(strip_tags($request->rememberme));

            $field = [
                'username' => $username,
                'password' => $password,
            ];

            if (!Auth::attempt($field, $rememberme)) {

                return $this->response(false, "Username / password tidak sesuai",null);

                if (!Auth::user()->hasRole([
                    RoleEnum::SUPERADMIN,
                    RoleEnum::ADMINISTRATOR,
                    RoleEnum::STUDENT,
                ])) {
                    Auth::logout();
                    return $this->response(true, "Login berhasil");
                }
            } else {
                
            }

            return $this->response(true, "Login berhasil");
        } catch (\Throwable $th) {
            Log::emergency($th->getMessage());

            return $this->response(false, "Internal server error",null, Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
