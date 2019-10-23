<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class BitacoraCaso extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;

    protected $fillable = [
        'fecha',
        'nota',
        'casos_id',
        'user_id',
    ];

    protected $dates = ['fecha'];

    public function user() {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function caso() {
        return $this->belongsTo(Caso::class, 'casos_id', 'id');
    }
}
