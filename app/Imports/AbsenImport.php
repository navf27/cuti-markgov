<?php

namespace App\Imports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\Importable;

class AbsenImport implements ToModel
{
    use Importable;

    public function model(array $row)
    {
        return $row;
    }
}
