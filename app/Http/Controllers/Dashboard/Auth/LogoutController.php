<?php

namespace App\Http\Controllers\Dashboard\Auth;

use App\Http\Controllers\Controller;
use App\Services\Auth\LogoutService;
use Auth;
use Log;

class LogoutController extends Controller
{
    protected $logoutService;
    protected $route;

    public function __construct()
    {
        $this->route = "dashboard.auth.";
        $this->logoutService = new LogoutService();
    }

    public function logout()
    {
        try {

            $manager = app('impersonate');

            if ($manager->isImpersonating()) {
                alert()->html('Success', 'You have successfully exited impersonation ' . Auth::user()->name, 'success');
                Auth::user()->leaveImpersonation();
                return redirect()->route('dashboard.index');
            } else {
                $response = $this->logoutService->logout();
                if (!$response->success) {
                    alert()->error('Oops...', $response->message);
                    return redirect()->route($this->route . 'login.index')->withInput();
                }

                alert()->html('Success', $response->message, 'success');
                return redirect()->route($this->route . 'login.index');
            }
        } catch (\Throwable $th) {
            Log::emergency($th->getMessage());

            alert()->error('Oops...', $th->getMessage());
            return redirect()->route($this->route . 'login.index')->withInput();
        }
    }
}
