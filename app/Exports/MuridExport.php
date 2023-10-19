<?php

namespace App\Exports;

use App\Models\Murid;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\FromView;

class MuridExport implements FromCollection, WithHeadings
{
    // /**
    //  * @return \Illuminate\Support\Collection
    //  */
    protected $data;
    public function __construct($data)
    {
        $this->data = $data;
    }

    public function collection()
    {
        return collect($this->data);
    }
    public function headings(): array
    {
        return [
            'NO',
            'NAMA WALI',
            'NAMA',
            'NAMA AYAH',
            'NAMA IBU',
            'ANGKATAN MURID',
            'JURUSAN MURID',
            'KELAS',
            // etc
        ];
    }
}
