<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Oficina;
use App\Empresa;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\OficinaStoreRequest;
use Session;

class OficinaController extends Controller
{

    public function index()
    {
        abort_if(!Auth::user()->hasPermissionTo('Menu Oficina'), 401);
        $oficinas = Oficina::all();
        
        return view('organizacion.oficina.index', compact('oficinas'));
    }


    public function create()
    {
        abort_if(!Auth::user()->hasPermissionTo('Crear Oficina'), 401);
        $empresas = Empresa::where('estado', 'Activo')->get();
        $users = User::where('estado', 'Activo')->get();
        return view('organizacion.oficina.create', compact('empresas', 'users'));
    }

    public function store(OficinaStoreRequest $request)
    {
        abort_if(!Auth::user()->hasPermissionTo('Crear Oficina'), 401);
        $validated = $request->validated();
        Oficina::create([
            'nombre' => $validated['nombre'],
            'estado' => $validated['estado'],
            'empresa_id' => $validated['empresa'],
            'jefe_id' => $validated['jefe'],
        ]);
        Session::flash('success', 'Oficina creado!');
        return redirect()->route('oficina.index');

    }

    public function show(Oficina $oficina)
    {
        abort_if(!Auth::user()->hasPermissionTo('Ver Oficina'), 401);
        return redirect()->route('oficina.index');
    }

    public function edit(Oficina $oficina)
    {
        abort_if(!Auth::user()->hasPermissionTo('Editar Oficina'), 401);
        $empresas = Empresa::where('estado', 'Activo')->get();
        $users = User::where('estado', 'Activo')->get();
        return view('organizacion.oficina.edit', compact('oficina', 'empresas', 'users'));
    }

    public function update(OficinaStoreRequest $request, Oficina $oficina)
    {
        abort_if(!Auth::user()->hasPermissionTo('Editar Oficina'), 401);
        $validated = $request->validated();
        $oficina->update([
            'nombre' => $validated['nombre'],
            'estado' => $validated['estado'],
            'empresa_id' => $validated['empresa'],
            'jefe_id' => $validated['jefe'],
        ]);
        Session::flash('success', 'Oficina editado!');
        return redirect()->route('oficina.index');

    }

    public function destroy(Oficina $oficina)
    {
        abort_if(!Auth::user()->hasPermissionTo('Eliminar Oficina'), 401);
        $oficina->delete();
        Session::flash('warning', 'Oficina eliminado!');
        return redirect()->route('oficina.index');
    }
}
