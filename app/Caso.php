<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class Caso extends Model implements Auditable
{
    
    use \OwenIt\Auditing\Auditable;

    protected $fillable = [
        'fecha_creado',
        'nombre_caso',
        'descripcion',
        'fecha_finalizado',
        'tipo_casos_id',
        'etapa_casos_id',
        'usuario_crear',
        'oficina_id',
        'empresa_id',
    ];

    protected $dates = ['fecha_creado',];

    public function TipoCaso() {
        return $this->belongsTo(TipoCaso::class, 'tipo_casos_id', 'id');
    }

    public function EtapaCaso() {
        return $this->belongsTo(EtapaCaso::class, 'etapa_casos_id', 'id');
    }

    public function user() {
        return $this->belongsTo(User::class, 'usuario_crear', 'id');
    }

    public function Oficina() {
        return $this->belongsTo(Oficina::class, 'oficina_id', 'id');
    }

    public function empresa() {
        return $this->belongsTo(Empresa::class, 'empresa_id', 'id');
    }

    public function bitacora() {
        return $this->hasMany(BitacoraCaso::class, 'casos_id', 'id')->orderBy('fecha');
    }
}
