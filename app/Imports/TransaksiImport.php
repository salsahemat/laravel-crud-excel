<?php

namespace App\Imports;

use App\Models\Transaksi;
use Maatwebsite\Excel\Concerns\ToModel;


class TransaksiImport implements ToModel
{
    public function model(array $row)
    {
        return new Transaksi([
            'kode_toko' => $row[0],
            'nominal_transaksi' => $row[1],
        ]);
    }
}
