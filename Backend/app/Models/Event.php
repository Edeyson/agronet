<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    protected $fillable = [
        'producer_id',
        'addr_id',
        'fecha',
        'hora',
        'duracion',
        'state'
    ];

    protected $filters = ['sort', 'greater_or_equal'];


    public function scopeOwnedBy($query, $producer_id)
    {
        return $query->where('producer_id', '=', $producer_id);
    }

    public function owner()
    {
        return $this->belongsTo(Producer::class, 'producer_id');
    }

    public function addr()
    {
        return $this->belongsTo(Addr::class, 'addr_id');
    }
}
