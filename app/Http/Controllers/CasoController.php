<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Caso;
use App\TipoCaso;
use App\EtapaCaso;
use App\BitacoraCaso;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\CasoStoreRequest;
use Session;

class CasoController extends Controller
{
    public function index()
    {
        abort_if(!Auth::user()->hasPermissionTo('Lista Casos'), 401);
        $casos = Caso::where([
                ['oficina_id', Auth::user()->oficina_id], 
                ['empresa_id', Auth::user()->empresa_id]])->get();
        return view('modulo_caso.caso.index', compact('casos'));
    }

    public function create()
    {
        abort_if(!Auth::user()->hasPermissionTo('Crear Caso'), 401);
        $tipocasos = TipoCaso::all();
        return view('modulo_caso.caso.create', compact('tipocasos'));
    }

    public function store(CasoStoreRequest $request)
    {
        abort_if(!Auth::user()->hasPermissionTo('Crear Caso'), 401);
        $validated = $request->validated();
        $caso = Caso::create([
            'fecha_creado' => Carbon::now(),
            'nombre_caso' => $validated['nombre_caso'],
            'descripcion' => $validated['descripcion'],
            'tipo_casos_id' => $validated['tipo_caso'],
            'etapa_casos_id' => 1,
            'usuario_crear' => Auth::user()->id,
            'oficina_id' => Auth::user()->oficina_id,
            'empresa_id' => Auth::user()->empresa_id,
        ]);

        BitacoraCaso::create([
            'fecha' => Carbon::now(),
            'nota' => 'CASO INGRESADO',
            'casos_id' => $caso->id,
            'user_id' => Auth::user()->id,
        ]);
        Session::flash('success', 'Caso creado!');
        return redirect()->route('caso.index');

    }

    public function show(Caso $caso)
    {
        abort_if(!Auth::user()->hasPermissionTo('Ver Caso'), 401);
        $etapacasos = Etapacaso::all();
        return view('modulo_caso.caso.show', compact('caso', 'etapacasos'));
    }

    public function edit(Caso $caso)
    {
        abort_if(!Auth::user()->hasPermissionTo('Editar Caso'), 401);
        $tipocasos = TipoCaso::all();
        return view('modulo_caso.caso.edit', compact('caso', 'tipocasos'));
    }

    public function update(CasoStoreRequest $request, Caso $caso)
    {
        abort_if(!Auth::user()->hasPermissionTo('Editar Caso'), 401);
        $validated = $request->validated();
        $caso->update([
            'nombre_caso' => $validated['nombre_caso'],
            'descripcion' => $validated['descripcion'],
            'tipo_casos_id' => $validated['tipo_caso'],
        ]);
        Session::flash('success', 'Caso editado!');
        return redirect()->route('caso.index');
    }

    public function destroy(Caso $caso)
    {
        abort_if(!Auth::user()->hasPermissionTo('Eliminar Caso'), 401);
        BitacoraCaso::where('casos_id', $caso->id)->delete();
        $caso->delete();
        Session::flash('warning', 'Caso eliminado!');
        return redirect()->route('caso.index');
    }

    public function cambiaretapa(Request $request, $id)
    {
        $caso = Caso::findOrFail($id);
        $etapa = EtapaCaso::findOrFail($request['etapa_caso']);
        BitacoraCaso::create([
            'fecha' => Carbon::now(),
            'nota' => $etapa->nombre,
            'casos_id' => $caso->id,
            'user_id' => Auth::user()->id,
        ]);
        Session::flash('success', 'Etapa de Caso guardado!');
        return redirect()->route('caso.show', $caso->id);

    }
}
