<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class Oficina extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;

    protected $fillable = [ 'nombre', 'estado', 'jefe_id', 'empresa_id'];

    public function jefe() {
        return $this->belongsTo(User::class, 'jefe_id', 'id');
    }

    public function empresa() {
        return $this->belongsTo(Empresa::class, 'empresa_id', 'id');
    }

    public function empleados() {
        return $this->hasMany(User::class);
    }
}
