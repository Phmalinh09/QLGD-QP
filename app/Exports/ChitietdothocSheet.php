<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithTitle;

class ChitietdothocSheet implements  FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    private $exports;

    public function __construct($exports)
    {
        $this->exports = $exports;
    }

    public function collection()
    {
        $data = [];
        foreach ($this->exports as $export) {
            $data[] = collect($export->headings());
            $data[] = collect($export->collection());
        }

        return collect($data)->flatten(1);
    }
}
