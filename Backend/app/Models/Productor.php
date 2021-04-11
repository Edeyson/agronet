<?php
use Illuminate\Support\Collection;
namespace App\Models;

class Productor extends User
{
    protected $telefono;

    protected $direccion;

    function __construct($telefono, $direccion)
    {
        $this->telefono = $telefono;
        $this->direccion = $direccion;
    }

    public function hasType($role)
    {
        if($role == Role::PRODUCTOR)
            return true;
        return parent::hasType($role);        
    }
}