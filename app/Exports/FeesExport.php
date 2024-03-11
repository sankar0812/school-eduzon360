<?php

namespace App\Exports;

use Illuminate\Support\Collection;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;

class FeesExport implements FromCollection, WithHeadings
{
    protected $feeStructures;

    public function __construct($feeStructures)
    {
        $this->feeStructures = $feeStructures;
    }

    public function collection()
    {
        return $this->feeStructures;
    }

    public function headings(): array
    {
        return [
            'Academic Year',
            'Class',
            'Student Name',
            'Annual Fees',
            'Exam Fees',
            'Transport Fees',
            'Others Fees',
            'Reason for other Fees',

        ];
    }
}
