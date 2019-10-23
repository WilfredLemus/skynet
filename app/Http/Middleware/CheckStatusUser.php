<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Session;
use Carbon\Carbon;

class CheckStatusUser
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $response = $next($request);
        if(Auth::check()){
            //Verifica si el usuario esta inactivo
            if(Auth::user()->estado == 'Inactivo'){
                Auth::logout();
                Session::flash('error', 'Tú usuario esta inactivo, comunicate con el administrador del sistema');
                return redirect()->route('login')->withErrors(['Tú usuario esta inactivo']);
            }
            // Verifica si el usuario tiene que cambiar la contraseña
            if(Auth::user()->nuevoPassword == 1){
                Session::flash('error', 'Debes cambiar tu contraseña');
                return redirect()->route('passwordchange.get')->withErrors(['Por favor cambia tu contraseña']);
            }
            // Verifica si al usuario se le expiro la contraseña
            $password_changed_at = new Carbon((Auth::user()->password_changed_at) ? Auth::user()->password_changed_at : Auth::user()->created_at);
            // 30 dias expira la contraseña (los dias pueden ser configurables desde el sistema)
            if(Carbon::now()->diffInDays($password_changed_at) >= 30){
                Session::flash('error', 'Tu contraseña expiro, debes cambiarla');
                return redirect()->route('passwordchange.get')->withErrors(['Tu contraseña expiro, por favor cambiala.']);
            }
        }
        return $response;
    }
}
