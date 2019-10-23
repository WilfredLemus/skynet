<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Puesto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\PuestosStoreRequest;
use Session;

class PuestoController extends Controller
{

    public function index()
    {
        abort_if(!Auth::user()->hasPermissionTo('Menu Puesto'), 401);
        $puestos = Puesto::all();
        return view('organizacion.puesto.index', compact('puestos'));
    }


    public function create()
    {
        abort_if(!Auth::user()->hasPermissionTo('Crear Puesto'), 401);
        return view('organizacion.puesto.create');
    }

    public function store(PuestosStoreRequest $request)
    {
        abort_if(!Auth::user()->hasPermissionTo('Crear Puesto'), 401);
        $validated = $request->validated();
        Puesto::create([
            'nombre' => $validated['nombre'],
            'estado' => $validated['estado'],
        ]);
        Session::flash('success', 'Puesto creado!');
        return redirect()->route('puestos.index');

    }

    public function show(Puesto $puesto)
    {
        abort_if(!Auth::user()->hasPermissionTo('Ver Puesto'), 401);
        return redirect()->route('puestos.index');
    }

    public function edit(Puesto $puesto)
    {
        abort_if(!Auth::user()->hasPermissionTo('Editar Puesto'), 401);
        return view('organizacion.puesto.edit', compact('puesto'));
    }

    public function update(PuestosStoreRequest $request, Puesto $puesto)
    {
        abort_if(!Auth::user()->hasPermissionTo('Editar Puesto'), 401);
        $validated = $request->validated();
        $puesto->update($validated);
        Session::flash('success', 'Puesto editado!');
        return redirect()->route('puestos.index');

    }

    public function destroy(Puesto $puesto)
    {
        abort_if(!Auth::user()->hasPermissionTo('Eliminar Puesto'), 401);
        $puesto->delete();
        Session::flash('warning', 'Puesto eliminado!');
        return redirect()->route('puestos.index');
    }
}
