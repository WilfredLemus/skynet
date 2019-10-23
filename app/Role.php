<?php

namespace App;

use Spatie\Permission\Models\Role as BaseRole;
use OwenIt\Auditing\Contracts\Auditable;

class Role extends BaseRole implements Auditable
{
    use \OwenIt\Auditing\Auditable;
}
