<?php
use Illuminate\Support\Collection;
namespace App\Models;

class Gestor extends Productor
{
    public function hasType($role)
    {
        if($role == Role::GESTOR)
            return true;
        return parent::hasType($role);        
    }
}