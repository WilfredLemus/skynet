<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\UserStoreRequest;
use App\Http\Requests\UserUpdateRequest;
use App\Http\Requests\CambioPasswordRequest;
use Carbon\Carbon;
use App\User;
use App\Puesto;
use App\Oficina;
use App\Empresa;

use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Session;

class UserController extends Controller
{

    public function index()
    {
        abort_if(!Auth::user()->hasPermissionTo('Menu Usuarios'), 401);
        $users = User::all();
        return view('modulo_usuarios.users.index', compact('users'));
    }

    public function create()
    {
        abort_if(!Auth::user()->hasPermissionTo('Crear Usuario'), 401);
        $roles = Role::all();
        $permisos = Permission::all();
        $puestos = Puesto::where('estado', 'Activo')->get();
        $oficinas = Oficina::where('estado', 'Activo')->get();
        $empresas = Empresa::where('estado', 'Activo')->get();
        return view('modulo_usuarios.users.create',
            compact('roles', 'permisos', 'puestos', 'oficinas', 'empresas'));
    }

    public function store(UserStoreRequest $request)
    {
        abort_if(!Auth::user()->hasPermissionTo('Crear Usuario'), 401);
        $validated = $request->validated();
        $usuario = User::create([
            'nombre' => $validated['nombre'],
            'apellido' => $validated['apellido'],
            'email' => $validated['email'],
            'estado' => $validated['estado'],
            'password' => $validated['email'],
            'puesto_id' => $validated['puesto'],
            'oficina_id' => $validated['oficina'],
            'empresa_id' => $validated['empresa'],
            'nuevoPassword' => 1,
        ]);
        $this->createAuditRolesPermisos($usuario, $request);
        Session::flash('success', 'Usuario creado!');
        return redirect()->route('usuarios.index');
    }

    public function show($id)
    {
        abort_if(!Auth::user()->hasPermissionTo('Ver Usuario'), 401);
        $user = User::findOrFail($id);
        return view('modulo_usuarios.users.show', compact('user'));
    }

    public function edit($id)
    {
        abort_if(!Auth::user()->hasPermissionTo('Editar Usuario'), 401);
        $user = User::findOrFail($id);
        $roles = Role::all();
        $permisos = Permission::all();
        $puestos = Puesto::where('estado', 'Activo')->get();
        $oficinas = Oficina::where('estado', 'Activo')->get();
        $empresas = Empresa::where('estado', 'Activo')->get();
        return view('modulo_usuarios.users.edit',
            compact('user', 'roles', 'permisos', 'puestos', 'oficinas', 'empresas'));
    }

    public function update(UserUpdateRequest $request, $id)
    {
        abort_if(!Auth::user()->hasPermissionTo('Editar Usuario'), 401);
        $validated = $request->validated();
        $usuario = User::findOrFail($id);
        $validated = $request->validated();
        $usuario->update([
            'nombre' => $validated['nombre'],
            'apellido' => $validated['apellido'],
            'email' => $validated['email'],
            'estado' => $validated['estado'],
            'puesto_id' => $validated['puesto'],
            'oficina_id' => $validated['oficina'],
            'empresa_id' => $validated['empresa'],
        ]);
        $this->updateAuditRolesPermisos($usuario, $request);
        Session::flash('success', 'Usuario editado!');
        return redirect()->route('usuarios.index');
    }

    public function destroy($id)
    {
        abort_if(!Auth::user()->hasPermissionTo('Eliminar Usuario'), 401);
        $user = User::findOrFail($id);
        $user->delete();
        Session::flash('success', 'Usuario eliminado!');
        return redirect()->route('usuarios.index');
    }

    public function restablecerPassword($id)
    {
        if(!Auth::user()->hasPermissionTo('Restablecer Contraseña Usuario')) abort(403);
        $user = User::findOrFail($id);
        $user->update([
            'password' => $user->email,
            'nuevoPassword' => 1,
        ]);
        Session::flash('success', 'Se restablecio la contraseña del Usuario!');
        return redirect()->route('usuarios.index');
    }

    public function CambioPassword()
    {
        if(Auth::user()->nuevoPassword == 1){
            return view('auth.cambiopassword');
        }else {
            return redirect()->route('inicio');
        }
    }

    public function CambiarPassword(CambioPasswordRequest $request)
    {
        if(Auth::Check()){
            $validated = $request->validated();

            if (!Hash::check($validated['current_password'], Auth::User()->password)) {
                return redirect()->route('miperfil.editarpassword')->withErrors(['current_password' => 'Contraseña Actual Incorrecta!']);;
            }
            $userCurrent = User::find(Auth::User()->id);
            $userCurrent->password = $validated['password'];
            $userCurrent->nuevoPassword = 0;
            $userCurrent->password_changed_at = Carbon::now()->toDateTimeString();
            $userCurrent->save();
            Auth::logout();
            Session::flash('success', 'Tu contraseña se ha cambiado correctamente!');
            return redirect()->route('login');
        }
    }

    // FUNCIONES HELPERS
    private function createAuditRolesPermisos($usuario, $request)
    {
        $audit = $usuario->audits()->latest()->first();
        $newValues = $audit->new_values;
        if (!empty($request['roles_to'])) {
            $newValues['roles'] = '';

            foreach ($request['roles_to'] as $role_id) {
                $rol = Role::where('id', '=', $role_id)->first();
                $usuario->assignRole($rol->name);
                $newValues['roles'] .= $rol->name.', ';
            }
        }
        if (!empty($request['permisos_to'])) {
            $newValues['permisos'] = '';
            foreach ($request['permisos_to'] as $permiso_id) {
                $permiso = Permission::where('id', '=', $permiso_id)->first();
                $usuario->givePermissionTo($permiso);
                $newValues['permisos'] .= $permiso->name.', ';
            }
        }
        $audit->update(["new_values" => $newValues]);
    }

    private function updateAuditRolesPermisos($usuario, $request)
    {
        $audit = $usuario->audits()->latest()->first();
        $oldValues = $audit->old_values;
        $newValues = $audit->new_values;
        if (!empty($request['roles_to'])) {
            $oldValues['roles'] = '';
            $newValues['roles'] = '';

            foreach ($usuario->getRoleNames() as $oldRole) {
                $oldValues['roles'] .= $oldRole.', ';
            }

            foreach ($request['roles_to'] as $role_id) {
                $rol = Role::where('id', '=', $role_id)->first();
                $rol_asignar[] = $rol;
                $newValues['roles'] .= $rol->name.', ';
            }
            $usuario->syncRoles($rol_asignar);
        }else {
            $usuario->syncRoles([]);
        }

        if (!empty($request['permisos_to'])) {
            $oldValues['permisos'] = '';
            $newValues['permisos'] = '';

            foreach ($usuario->getDirectPermissions() as $oldPermission) {
                $oldValues['permisos'] .= $oldPermission->name.', ';
            }

            foreach ($request['permisos_to'] as $permiso_id) {
                $permisos = Permission::where('id', '=', $permiso_id)->first();
                $permisos_asignar[] = $permisos;
                $newValues['permisos'] .= $permisos->name.', ';
            }
            $usuario->syncPermissions($permisos_asignar);
        }else {
            $usuario->syncPermissions([]);
        }
        $audit->update(["old_values" => $oldValues, "new_values" => $newValues]);
    }
}
