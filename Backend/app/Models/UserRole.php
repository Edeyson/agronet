<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

abstract class UserRole extends Authenticatable
{
    public function hasType($role)
    {
        return false;
    }
}
