<?php
use Illuminate\Support\Collection;
namespace App\Models;

class Productor extends User
{
    protected $direccion;

    protected $fillable = [

        'direccion',
    ];

    public function hasType($role)
    {
        if($role == Role::PRODUCTOR)
            return true;
        return parent::hasType($role);
    }

    public function owner()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

}
