<?php

namespace App\Http\Controllers\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\CambioPasswordRequest;
use Carbon\Carbon;
use App\User;
use Session;

class PasswordController extends Controller
{

    public function CambioPassword()
    {
        $password_changed_at = new Carbon((Auth::user()->password_changed_at) ? Auth::user()->password_changed_at : Auth::user()->created_at);
        // 30 dias expira la contraseña (los dias pueden ser configurables desde el sistema)
        if(Auth::user()->nuevoPassword == 1 || Carbon::now()->diffInDays($password_changed_at) >= 30){
            return view('auth.cambiopassword');
        }else {
            return redirect()->route('inicio');
        }
    }

    public function CambiarPassword(CambioPasswordRequest $request)
    {
        if(Auth::Check()){
            $validated = $request->validated();

            if (!Hash::check($validated['current_password'], Auth::User()->password)) {
                return redirect()->route('passwordchange.get')->withErrors(['current_password' => 'Contraseña Actual Incorrecta!']);;
            }
            $userCurrent = User::find(Auth::User()->id);
            $userCurrent->password = $validated['password'];
            $userCurrent->nuevoPassword = 0;
            $userCurrent->password_changed_at = Carbon::now()->toDateTimeString();
            $userCurrent->save();
            Auth::logout();
            Session::flash('success', 'Tu contraseña se ha cambiado correctamente!');
            return redirect()->route('login');
        }
    }
}
