<?php

namespace App\Imports;

use App\Models\Cliente;
use Maatwebsite\Excel\Concerns\ToModel;

class ClientesImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Cliente([
        'nombre' => $row[1],
        'direccion'=> $row[2],
        'email'=> $row[3],
        'fijo'=> $row[4],
        'celular'=> $row[5],
        ]);
    }
}
