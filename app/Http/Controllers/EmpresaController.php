<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Empresa;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\EmpresaStoreRequest;
use Session;

class EmpresaController extends Controller
{

    public function index()
    {
        abort_if(!Auth::user()->hasPermissionTo('Menu Empresa'), 401);
        $empresas = Empresa::all();
        
        return view('organizacion.empresa.index', compact('empresas'));
    }


    public function create()
    {
        abort_if(!Auth::user()->hasPermissionTo('Crear Empresa'), 401);
        $users = User::where('estado', 'Activo')->get();
        return view('organizacion.empresa.create', compact('users'));
    }

    public function store(EmpresaStoreRequest $request)
    {
        abort_if(!Auth::user()->hasPermissionTo('Crear Empresa'), 401);
        $validated = $request->validated();
        Empresa::create([
            'nombre' => $validated['nombre'],
            'estado' => $validated['estado'],
            'jefe_id' => $validated['jefe'],
        ]);
        Session::flash('success', 'Empresa creado!');
        return redirect()->route('empresa.index');

    }

    public function show(Empresa $empresa)
    {
        abort_if(!Auth::user()->hasPermissionTo('Ver Empresa'), 401);
        return redirect()->route('empresa.index');
    }

    public function edit(Empresa $empresa)
    {
        abort_if(!Auth::user()->hasPermissionTo('Editar Empresa'), 401);
        $users = User::where('estado', 'Activo')->get();
        return view('organizacion.Empresa.edit', compact('empresa', 'users'));
    }

    public function update(EmpresaStoreRequest $request, Empresa $empresa)
    {
        abort_if(!Auth::user()->hasPermissionTo('Editar Empresa'), 401);
        $validated = $request->validated();
        $empresa->update([
            'nombre' => $validated['nombre'],
            'estado' => $validated['estado'],
            'jefe_id' => $validated['jefe'],
        ]);
        Session::flash('success', 'Empresa editado!');
        return redirect()->route('empresa.index');

    }

    public function destroy(Empresa $Empresa)
    {
        abort_if(!Auth::user()->hasPermissionTo('Eliminar Empresa'), 401);
        $empresa->delete();
        Session::flash('warning', 'Empresa eliminado!');
        return redirect()->route('empresa.index');
    }
}
