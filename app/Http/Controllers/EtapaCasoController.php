<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\EtapaCaso;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\EtapaCasoStoreRequest;
use Session;

class EtapaCasoController extends Controller
{

    public function index()
    {
        abort_if(!Auth::user()->hasPermissionTo('Menu Etapa Caso'), 401);
        $etapacasos = EtapaCaso::all();
        return view('modulo_caso.etapacaso.index', compact('etapacasos'));
    }


    public function create()
    {
        abort_if(!Auth::user()->hasPermissionTo('Crear Etapa Caso'), 401);
        return view('modulo_caso.etapacaso.create');
    }

    public function store(EtapaCasoStoreRequest $request)
    {
        abort_if(!Auth::user()->hasPermissionTo('Crear Etapa Caso'), 401);
        $validated = $request->validated();
        EtapaCaso::create([
            'nombre' => $validated['nombre'],
        ]);
        Session::flash('success', 'Etapa Caso creado!');
        return redirect()->route('etapacaso.index');

    }

    public function show(EtapaCaso $etapacaso)
    {
        abort_if(!Auth::user()->hasPermissionTo('Ver Etapa Caso'), 401);
        return redirect()->route('etapacaso.index');
    }

    public function edit(EtapaCaso $etapacaso)
    {
        abort_if(!Auth::user()->hasPermissionTo('Editar Etapa Caso'), 401);
        return view('modulo_caso.etapacaso.edit', compact('etapacaso'));
    }

    public function update(EtapaCasoStoreRequest $request, EtapaCaso $etapacaso)
    {
        abort_if(!Auth::user()->hasPermissionTo('Editar Etapa Caso'), 401);
        $validated = $request->validated();
        $etapacaso->update([
            'nombre' => $validated['nombre'],
        ]);
        Session::flash('success', 'Etapa Caso editado!');
        return redirect()->route('etapacaso.index');

    }

    public function destroy(EtapaCaso $etapacaso)
    {
        abort_if(!Auth::user()->hasPermissionTo('Eliminar Etapa Caso'), 401);
        $etapacaso->delete();
        Session::flash('warning', 'Etapa Caso eliminado!');
        return redirect()->route('etapacaso.index');
    }
}
