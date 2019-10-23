<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Carbon\Carbon;

class LoginController extends Controller
{
    use AuthenticatesUsers;
    protected $redirectTo = '/';

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    function authenticated(Request $request, $user)
    {
        \Auth::logoutOtherDevices(request('password'));
        $user->update([
            'ultimo_login_el' => Carbon::now()->toDateTimeString(),
            'ultimo_login_ip' => $request->getClientIp(),
            'password' => request('password')
        ]);
    }
}
