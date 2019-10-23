<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Support\Facades\Hash;
use OwenIt\Auditing\Contracts\Auditable;

class User extends Authenticatable implements Auditable
{
    use \OwenIt\Auditing\Auditable;
    use HasRoles;
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nombre', 'apellido', 'email', 'password', 'estado', 'nuevoPassword', 'password_changed_at',
        'ultimo_login_el', 'ultimo_login_ip', 'puesto_id', 'oficina_id', 'empresa_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    // SET Attributes
    public function setPasswordAttribute($password)
    {
        $this->attributes['password'] = Hash::make($password);
    }

    // GET Attributes
    public function getNombreCompletoAttribute()
    {
        return "$this->nombre $this->apellido";
    }


    public function puesto() {
        return $this->belongsTo(Puesto::class, 'puesto_id', 'id');
    }

    public function Oficina() {
        return $this->belongsTo(Oficina::class, 'oficina_id', 'id');
    }

    public function empresa() {
        return $this->belongsTo(Empresa::class, 'empresa_id', 'id');
    }
}
