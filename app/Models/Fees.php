<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fees extends Model
{
    use HasFactory;
    protected $fillable = [
    'student_id',
    'fees_structure_id' ,
    'annual_fees',
    'exam_fees',
    'transport',
    'others',
    'reason',
    'total',
    'academic_year'];
}
