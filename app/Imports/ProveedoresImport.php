<?php

namespace App\Imports;

use App\Models\Proveedor;
use Maatwebsite\Excel\Concerns\ToModel;

class ProveedoresImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Proveedor([
            'nombre' => $row[1],
            'direccion' => $row[2],
            'email' => $row[3],
            'fijo' => $row[4],
            'celular' => $row[5],
            'representante' => $row[6],
        ]);
    }
}
