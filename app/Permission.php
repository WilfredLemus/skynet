<?php

namespace App;

use Spatie\Permission\Models\Permission as BasePermission;
use OwenIt\Auditing\Contracts\Auditable;

class Permission extends BasePermission implements Auditable
{
    use \OwenIt\Auditing\Auditable;
}
