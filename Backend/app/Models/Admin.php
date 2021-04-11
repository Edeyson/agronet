<?php
use Illuminate\Support\Collection;
namespace App\Models;

class Admin extends User
{
    public function hasType($role)
    {
        if($role == Role::ADMIN)
            return true;
        return parent::hasType($role);        
    }
}