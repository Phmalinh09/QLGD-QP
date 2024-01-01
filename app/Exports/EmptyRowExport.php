<?php

namespace App\Exports;

use App\Models\Sinhvien;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class EmptyRowExport implements FromCollection,WithHeadings
{
    use Exportable;
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return collect([]); // Return an empty collection to represent an empty row
    }
    public function headings(): array
    {
        return []; // Return an empty array for headings (no headings for the empty row)
    }
}
