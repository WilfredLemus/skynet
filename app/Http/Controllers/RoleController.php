<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\RolesStoreRequest;
use Illuminate\Support\Facades\Auth;
use App\Role;
use App\Permission;
use Session;
use OwenIt\Auditing\Facades\Auditor;
use OwenIt\Auditing\Models\Audit;

class RoleController extends Controller
{
    public function index()
    {
        if(!Auth::user()->hasPermissionTo('Menu Rol')) abort(403);
        $roles = Role::all();
        return view('modulo_usuarios.roles.index', compact('roles'));;
    }

    public function create()
    {
        if(!Auth::user()->hasPermissionTo('Crear Rol')) abort(403);
        $permisos = Permission::all();
        return view('modulo_usuarios.roles.create', compact('permisos'));
    }

    public function store(RolesStoreRequest $request)
    {
        if(!Auth::user()->hasPermissionTo('Crear Rol')) abort(403);
        $validated = $request->validated();
        $role = new Role();
        $role->name = $validated['name'];
        $role->save();
        $this->createAuditPermisos($role, $request);
        Session::flash('success', 'Rol creado!');
        return redirect()->route('roles.index');
    }

    public function show($id)
    {
        if(!Auth::user()->hasPermissionTo('Ver Rol')) abort(403);
        return redirect()->route('roles.index');
    }

    public function edit(Role $role)
    {
        if(!Auth::user()->hasPermissionTo('Editar Rol')) abort(403);
        $permisos = Permission::all();
        return view('modulo_usuarios.roles.edit', compact('role', 'permisos'));
    }

    public function update(RolesStoreRequest $request, Role $role)
    {
        if(!Auth::user()->hasPermissionTo('Editar Rol')) abort(403);
        $validated = $request->validated();
        $role->update($validated);
        $role->save();
        $this->updateAuditPermisos($role, $request);
        Session::flash('success', 'Rol editado!');
        return redirect()->route('roles.index');
    }

    public function destroy(Role $role)
    {
        if(!Auth::user()->hasPermissionTo('Eliminar Rol')) abort(403);
        $role->delete();
        Session::flash('warning', 'Rol eliminado!');
        return redirect()->route('roles.index');
    }


    // FUNCIONES HELPERS
    private function createAuditPermisos($role, $request)
    {
        if (!empty($request['permisos_to'])) {
            $audit = $role->audits()->latest()->first();
            $newValues = $audit->new_values;
            $newValues['permisos'] = '';

            foreach ($request['permisos_to'] as $permiso_id) {
                $permiso = Permission::where('id', '=', $permiso_id)->first();
                $role->givePermissionTo($permiso);
                $newValues['permisos'] .= $permiso->name.', ';
            }

            $audit->update(["new_values" => $newValues]);
        }
    }

    private function updateAuditPermisos($role, $request)
    {
        if (!empty($request['permisos_to'])) {
            $newValues['permisos'] = '';

            foreach ($request['permisos_to'] as $permiso_id) {
                $permiso = Permission::where('id', '=', $permiso_id)->first();
                $permisos_asignar[] = $permiso;
                $newValues['permisos'] .= $permiso->name.', ';
            }
            $role->syncPermissions($permisos_asignar);

            $audit = $role->audits()->latest()->first();
            if($audit) {

                $oldValues = $audit->old_values;
                $oldValues['permisos'] = '';
                // $newValues = $audit->new_values;
                // $newValues['permisos'] = '';

                foreach ($role->getAllPermissions() as $oldPermission) {
                    $oldValues['permisos'] .= $oldPermission->name.', ';
                }
                $audit->update(["old_values" => $oldValues, "new_values" => $newValues]);
            }



        }
    }
}
