<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends UserRole
{
    use HasFactory, Notifiable, HasApiTokens;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nombre',
        'apellido',
        'email',
        'password',
        'departamento',
        'ciudad',
        'telefono'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function hasType($role)
    {
        if($role == Role::USUARIO_REGISTRADO)
            return true;
        return parent::hasType($role);
    }

    public function admin()
    {
        return $this->hasOne(Admin::class);
    }

    public function productor()
    {
        return $this->hasOne(Productor::class);
    }

    public function gestor()
    {
        return $this->hasOneThrough(Gestor::class, Productor::class);
    }

    public function cliente()
    {
        return $this->hasOne(Cliente::class);
    }

    private function registrarComoCliente($telefono)
    {
        return new Cliente($telefono);
    }

    private function registrarComoProductor($telefono, $direccion)
    {
        return new Productor($telefono, $direccion);
    }

    public function setPasswordAttribute($password)
    {
        $this->attributes['password'] = Hash::make($password);
    }
}
