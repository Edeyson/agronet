<?php
use Illuminate\Support\Collection;
namespace App\Models;

class Cliente extends User
{
    protected $direccion;
    
    protected $fillable = [       
        
        'direccion',
    ];

    function __construct($telefono)
    {
        $this->telefono = $telefono;
    }

    public function hasType($role)
    {
        if($role == Role::CLIENTE)
            return true;
        return parent::hasType($role);        
    }

    public function owner()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}