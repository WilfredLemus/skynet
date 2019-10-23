<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\TipoCaso;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\TipoCasoStoreRequest;
use Session;

class TipoCasoController extends Controller
{

    public function index()
    {
        abort_if(!Auth::user()->hasPermissionTo('Menu Tipo Caso'), 401);
        $tipocasos = TipoCaso::all();
        return view('modulo_caso.tipocaso.index', compact('tipocasos'));
    }


    public function create()
    {
        abort_if(!Auth::user()->hasPermissionTo('Crear Tipo Caso'), 401);
        return view('modulo_caso.tipocaso.create');
    }

    public function store(TipoCasoStoreRequest $request)
    {
        abort_if(!Auth::user()->hasPermissionTo('Crear Tipo Caso'), 401);
        $validated = $request->validated();
        TipoCaso::create([
            'nombre' => $validated['nombre'],
        ]);
        Session::flash('success', 'Tipo Caso creado!');
        return redirect()->route('tipocaso.index');

    }

    public function show(TipoCaso $tipocaso)
    {
        abort_if(!Auth::user()->hasPermissionTo('Ver Tipo Caso'), 401);
        return redirect()->route('tipocaso.index');
    }

    public function edit(TipoCaso $tipocaso)
    {
        abort_if(!Auth::user()->hasPermissionTo('Editar Tipo Caso'), 401);
        return view('modulo_caso.tipocaso.edit', compact('tipocaso'));
    }

    public function update(TipoCasoStoreRequest $request, TipoCaso $tipocaso)
    {
        abort_if(!Auth::user()->hasPermissionTo('Editar Tipo Caso'), 401);
        $validated = $request->validated();
        $tipocaso->update([
            'nombre' => $validated['nombre'],
        ]);
        Session::flash('success', 'Tipo Caso editado!');
        return redirect()->route('tipocaso.index');

    }

    public function destroy(TipoCaso $tipocaso)
    {
        abort_if(!Auth::user()->hasPermissionTo('Eliminar Tipo Caso'), 401);
        $tipocaso->delete();
        Session::flash('warning', 'Tipo Caso eliminado!');
        return redirect()->route('tipocaso.index');
    }
}
