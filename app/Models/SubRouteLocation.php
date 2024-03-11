<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubRouteLocation extends Model
{
    use HasFactory;
    protected $fillable = ['route_id', 'name'];

    public function route()
    {
        return $this->belongsTo(Routes::class);
    }

   
}
