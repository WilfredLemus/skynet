<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Auth::routes(['register' => false, 'reset' => false, 'verify' => false]);
Route::post('login', [
    'uses'          => 'Auth\LoginController@login',
    'middleware'    => 'checkstatus',
])->name('login');

Route::group(['middleware' => ['auth']], function () {
    Route::get('/cambiar-contraseña', 'Auth\PasswordController@CambioPassword')->name('passwordchange.get');
    Route::post('/cambiar-contraseña', 'Auth\PasswordController@CambiarPassword')->name('passwordchange.post');
    Route::group(['middleware' => ['checkstatus']], function () {
        Route::get('/', 'HomeController@index')->name('inicio');
        // USUARIOS
        // User y Perfil
        Route::post('usuarios/restablecer/{user}', 'UserController@restablecerPassword')->name('usuarios.restablecer');
        Route::view('/perfil', 'modulo_usuarios.users.miperfil')->name('miperfil');
        Route::view('/perfil/editar-password', 'modulo_usuarios.users.edit-password')->name('miperfil.editarpassword');
        Route::post('/perfil/editar-password', 'UserController@CambiarPassword')->name('miperfil.cambiarpassword');


        Route::resources([
            // Caso
            'caso' => 'CasoController',
            // Tipo Caso
            'tipocaso' => 'TipoCasoController',
            // Etapa Caso
            'etapacaso' => 'EtapaCasoController',
        ]);

        Route::get('/caso/buscar', 'CasoController@index')->name('caso.buscar');
        Route::post('/caso/cambiaretapa/{id}', 'CasoController@cambiaretapa')->name('caso.cambiaretapa');

        Route::resources([
            // User
            'usuarios' => 'UserController',
            // Roles
            'roles' => 'RoleController',
            // Permisos
            'permisos' => 'PermissionController'
        ]);

        // ORGANIZACION
        Route::resources([
            // Puestos
            'puestos' => 'PuestoController',
            // Oficiana
            'oficina' => 'OficinaController',
            // Empresa
            'empresa' => 'EmpresaController',
        ]);
        // REGISTROS
        Route::get('/registros', 'RegistrosController@registrosAll')->name('registros.all');
        Route::get('/registros/usuario', 'RegistrosController@registrosUser')->name('registros.users');

    });

    // API REQUIERE LOGIN
    // Usuarios
    Route::get('/api/users/list', 'DataAjaxController@getUsersList')->name('AjaxUsersList');
    // Registros
    Route::get('/api/registros/list', 'DataAjaxController@getRegistrosList')->name('AjaxRegistrosList');

});
