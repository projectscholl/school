<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class TagihanExport implements FromCollection, WithHeadings
{
    /**
     * @return \Illuminate\Support\Collection
     */
    protected $excel;
    public function __construct($excel)
    {
        $this->excel = $excel;
    }

    public function collection()
    {
        return collect($this->excel);
    }
    public function headings(): array
    {
        return [
            'NAMA TAGIHAN',
            'NAMA MURID',
            'ANGKATAN',
            'BULAN TAGIHAN',
            'STATUS',
            'TOTAL',
            // etc
        ];
    }
}
