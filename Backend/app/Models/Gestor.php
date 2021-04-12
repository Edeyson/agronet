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

    public function owner()
    {
        return $this->belongsTo(Productor::class, 'productor_id');
    }

}