<?php
use Illuminate\Support\Collection;
use Illuminate\Database\Eloquent\SoftDeletes;

namespace App\Models;

class Producer extends RegisteredUser
{
    protected $fillable = [

        'sede_ppal',
        'registered_user_id'
    ];

    public function hasType($role)
    {
        if($role == Role::PRODUCER)
            return true;
        return parent::hasType($role);
    }

    public function owner()
    {
        return $this->belongsTo(RegisteredUser::class, 'registered_user_id');
    }

    public function events()
    {
        return $this->hasMany(Event::class);
    }

}
