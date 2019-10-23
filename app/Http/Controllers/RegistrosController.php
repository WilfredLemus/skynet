<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use OwenIt\Auditing\Models\Audit;

class RegistrosController extends Controller
{
    public function registrosAll()
    {
        $auditAll = Audit::all();
        // dd($auditAll[0]);
        // return view('registros.registros', compact('auditAll'));
        return view('registros.registros' , compact('auditAll'));
    }

    // public function registrosUser()
    // {
    //     $uid = request()->input('uid');
    //     $showRegistros = false;
    //     if($uid){
    //         $showRegistros = true;
    //         $userActual = User::find($uid);
    //         $audits = $userActual->audits()->with('user')->get();
    //     }
    //     $users = User::orderBy('cif', 'DESC')->get();
    //     return view('registros.users', compact('users', 'showRegistros', 'audits', 'userActual'));
    // }
}
