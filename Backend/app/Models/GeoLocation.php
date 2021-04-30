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

    private function distance(GeoLocation $geo)
    {
    //select sqrt(pow((-5-geo.latitud), 2) + pow((75-geo.longitud), 2)) FROM geo_locations geo;
       return sqrt(pow(($this->latitud - $geo->latitud),2) + pow(($this->longitud - $geo->longitud),2));
    }

    public function circundantes()
    {

    }

}
