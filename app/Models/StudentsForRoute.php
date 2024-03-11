<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentsForRoute extends Model
{
    use HasFactory;

  

    protected $table = 'students_for_route';

    protected $fillable = ['route_id', 'roll_no', 'name'];
    
    // Add any additional fields as needed

    public function route()
    {
        return $this->belongsTo(Routes::class);
    }
}
