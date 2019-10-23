<?php

use Illuminate\Database\Seeder;
use App\Puesto;
use App\Empresa;
use App\Oficina;
use App\TipoCaso;
use App\EtapaCaso;
use App\User;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
        Puesto::create(['nombre' => 'ADMINISTRADOR DE SKYNET', 'estado' => "Activo"]);
        Puesto::create(['nombre' => 'ADMINISTRADOR', 'estado' => "Activo"]);
        Puesto::create(['nombre' => 'SECRETARIA', 'estado' => "Activo"]);
        Puesto::create(['nombre' => 'JEFE DE OFICINA', 'estado' => "Activo"]);
        Puesto::create(['nombre' => 'JEFE DE EMPRESA', 'estado' => "Activo"]);


        Empresa::create(['nombre' => 'SKYNET', 'estado' => "Activo"]);
        Empresa::create(['nombre' => 'PATITO, S.A.', 'estado' => "Activo"]);
        Empresa::create(['nombre' => 'MICROSOFT, S.A.', 'estado' => "Activo"]);

        Oficina::create(['nombre' => 'Oficina 1', 'estado' => "Activo", 'empresa_id' => 1]);
        Oficina::create(['nombre' => 'Oficina 2', 'estado' => "Activo", 'empresa_id' => 1]);


        TipoCaso::create(['nombre' => 'Soporte Administrativo',]);
        TipoCaso::create(['nombre' => 'Soporte Financiera',]);
        TipoCaso::create(['nombre' => 'Soporte Tecnologico',]);


        EtapaCaso::create(['nombre' => 'Ingresado',]);
        EtapaCaso::create(['nombre' => 'Registrado',]);
        EtapaCaso::create(['nombre' => 'Verificado',]);
        EtapaCaso::create(['nombre' => 'Analisado',]);
        EtapaCaso::create(['nombre' => 'En Tramite',]);
        EtapaCaso::create(['nombre' => 'Rechazado',]);
        EtapaCaso::create(['nombre' => 'Aprobado',]);
        EtapaCaso::create(['nombre' => 'Finalizado',]);

        Permission::create(['name' => 'Menu Usuarios',]);
        Permission::create(['name' => 'Menu Organización',]);
        Permission::create(['name' => 'Menu Registros',]);
        Permission::create(['name' => 'Menu Usuario',]);
        Permission::create(['name' => 'Ver Usuario',]);
        Permission::create(['name' => 'Crear Usuario',]);
        Permission::create(['name' => 'Editar Usuario',]);
        Permission::create(['name' => 'Eliminar Usuario',]);
        Permission::create(['name' => 'Restablecer Contraseña Usuario',]);
        
        Permission::create(['name' => 'Menu Rol',]);
        Permission::create(['name' => 'Ver Rol',]);
        Permission::create(['name' => 'Crear Rol',]);
        Permission::create(['name' => 'Editar Rol',]);
        Permission::create(['name' => 'Eliminar Rol',]);
        Permission::create(['name' => 'Menu Permiso',]);
        Permission::create(['name' => 'Ver Permiso',]);
        Permission::create(['name' => 'Crear Permiso',]);
        Permission::create(['name' => 'Editar Permiso',]);
        Permission::create(['name' => 'Eliminar Permiso',]);
        
        Permission::create(['name' => 'Menu Puesto',]);
        Permission::create(['name' => 'Crear Puesto',]);
        Permission::create(['name' => 'Ver Puesto',]);
        Permission::create(['name' => 'Editar Puesto',]);
        Permission::create(['name' => 'Eliminar Puesto',]);

        Permission::create(['name' => 'Menu Oficina',]);
        Permission::create(['name' => 'Crear Oficina',]);
        Permission::create(['name' => 'Ver Oficina',]);
        Permission::create(['name' => 'Editar Oficina',]);
        Permission::create(['name' => 'Eliminar Oficina',]);

        Permission::create(['name' => 'Menu Empresa',]);
        Permission::create(['name' => 'Crear Empresa',]);
        Permission::create(['name' => 'Ver Empresa',]);
        Permission::create(['name' => 'Editar Empresa',]);
        Permission::create(['name' => 'Eliminar Empresa',]);

        Permission::create(['name' => 'Menu Caso',]);
        Permission::create(['name' => 'Crear Caso',]);
        Permission::create(['name' => 'Ver Caso',]);
        Permission::create(['name' => 'Editar Caso',]);
        Permission::create(['name' => 'Eliminar Caso',]);
        Permission::create(['name' => 'Lista Casos',]);
        Permission::create(['name' => 'Buscar Caso',]);

        Permission::create(['name' => 'Menu Configuracion Casos',]);

        Permission::create(['name' => 'Menu Tipo Caso',]);
        Permission::create(['name' => 'Crear Tipo Caso',]);
        Permission::create(['name' => 'Ver Tipo Caso',]);
        Permission::create(['name' => 'Editar Tipo Caso',]);
        Permission::create(['name' => 'Eliminar Tipo Caso',]);

        Permission::create(['name' => 'Menu Etapa Caso',]);
        Permission::create(['name' => 'Crear Etapa Caso',]);
        Permission::create(['name' => 'Ver Etapa Caso',]);
        Permission::create(['name' => 'Editar Etapa Caso',]);
        Permission::create(['name' => 'Eliminar Etapa Caso',]);

        



        Permission::create(['name' => 'Menu Auditoria',]);
        
        $permisos = Permission::all();
        $rol = Role::create(['name' => 'SuperAdministrador',]);
        $rol->syncPermissions($permisos);

        $usuario = User::create([
            'nombre' => 'Wilfred',
            'apellido' => 'Lemus',
            'email' => 'wilfred.lemus@gmail.com',
            'estado' => 'Activo',
            'password' => 'wilfred123',
            'puesto_id' => 1,
            'oficina_id' => 1,
            'empresa_id' => 1,
            'nuevoPassword' => 1,
        ]);
        $usuario->assignRole('SuperAdministrador');
    }
}
