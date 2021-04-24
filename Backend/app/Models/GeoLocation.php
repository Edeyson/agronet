<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GeoLocation extends Model
{
    use HasFactory;

    protected $fillable = [

        'latitud',
        'longitud',
        'addr_id'
    ];

    public function scopeOwnedBy($query, $addr_id)
    {
        return $query->where('addr_id', '=', $addr_id);
    }

    public function owner()
    {
        return $this->belongsTo(Addr::class, 'addr_id');
    }

}
