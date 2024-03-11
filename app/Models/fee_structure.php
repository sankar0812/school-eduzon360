<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class fee_structure extends Model
{
    use HasFactory;
    protected $fillable = ['class_id', 'annual_fee', 'exam_fees', 'academic_year', 'status'];


    public function classSection()
    {
        return $this->belongsTo(Class_section::class, 'class_id');
    }
}
