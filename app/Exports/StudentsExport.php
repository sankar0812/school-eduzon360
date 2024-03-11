<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Illuminate\Support\Collection;

class StudentsExport implements FromCollection, WithHeadings
{
    protected $headings;

    public function __construct($headings = null)
    {
        $this->headings = $headings ?: [];
    }

    public function collection()
    {
        // Return an empty collection
        return new Collection([]);
    }

    public function headings(): array
    {
        return $this->headings;
    }
}
