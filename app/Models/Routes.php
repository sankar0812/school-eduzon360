<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Routes extends Model
{
    use HasFactory;
    protected $fillable = ['routetitle', 'starting_point', 'ending_point'];

    public function subRouteLocations()
    {
        return $this->hasMany(SubRouteLocation::class, 'route_id');   
     }
     public function students()
     {
         return $this->hasMany(StudentsForRoute::class, 'route_id');
     }
}
