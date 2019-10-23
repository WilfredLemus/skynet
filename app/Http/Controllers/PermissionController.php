<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\PermisosStoreRequest;
use Session;

// use Spatie\Permission\Models\Role;
// use Spatie\Permission\Models\Permission;
use App\Role;
use App\Permission;

class PermissionController extends Controller
{

    public function index()
    {
        abort_if(!Auth::user()->hasPermissionTo('Menu Permiso'), 401);
        $permisos = Permission::all();
        return view('modulo_usuarios.permisos.index', compact('permisos'));
    }

    public function create()
    {
        abort_if(!Auth::user()->hasPermissionTo('Crear Permiso'), 401);
        $role = Role::all();
        return view('modulo_usuarios.permisos.create', compact('role'));
    }

    public function store(PermisosStoreRequest $request)
    {
        abort_if(!Auth::user()->hasPermissionTo('Crear Permiso'), 401);
        $validated = $request->validated();
        $permission = new Permission();
        $permission->name = $validated['name'];
        $permission->save();
        $this->createAuditRole($permission, $request);
        Session::flash('success', 'Permiso creado!');
        return redirect()->route('permisos.index');
    }

    public function show($id)
    {
        abort_if(!Auth::user()->hasPermissionTo('Ver Permiso'), 401);
        return redirect()->route('permisos.index');
    }

    public function edit(Permission $permiso)
    {
        abort_if(!Auth::user()->hasPermissionTo('Editar Permiso'), 401);
        return view('modulo_usuarios.permisos.edit', compact('permiso'));
    }

    public function update(PermisosStoreRequest $request, Permission $permiso)
    {
        abort_if(!Auth::user()->hasPermissionTo('Editar Permiso'), 401);
        $validated = $request->validated();
        $permiso->update($validated);
        Session::flash('success', 'Permiso editado!');
        return redirect()->route('permisos.index');
    }

    public function destroy(Permission $permiso)
    {
        abort_if(!Auth::user()->hasPermissionTo('Eliminar Permiso'), 401);
        $permiso->delete();
        Session::flash('warning', 'Permiso eliminado!');
        return redirect()->route('permisos.index');
    }


    // FUNCIONES HELPERS
    private function createAuditRole($permission, $request)
    {
        if (!empty($request['roles_to'])) {
            $audit = $permission->audits()->latest()->first();
            $newValues = $audit->new_values;
            $newValues['roles'] = '';
            foreach ($request['roles_to'] as $role_id) {
                $rol = Role::where('id', '=', $role_id)->first();
                $rol->givePermissionTo($permission);
                $newValues['roles'] .= $rol->name.', ';
            }
            $audit->update(["new_values" => $newValues]);
        }
    }


}
