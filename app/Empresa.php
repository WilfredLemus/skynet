<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class Empresa extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;

    protected $fillable = [ 'nombre', 'estado', 'jefe_id'];

    public function jefe() {
        return $this->belongsTo(User::class, 'jefe_id', 'id');
    }

    public function empleados() {
        return $this->hasMany(User::class);
    }

    public function oficinas() {
        return $this->hasMany(Oficina::class);
    }
}
