<?php

namespace App\Imports;

use App\Models\Barang;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;


class BarangImport implements ToModel, WithHeadingRow
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        return new Barang([
            'nama_barang'     => $row['nama_barang'],
            'qty'    => $row['qty'],
            'harga_beli' => $row['harga_beli'],
            'harga_jual' => $row['harga_jual'],
        ]);
    }

    /**
     * Write code on Method
     *
     * @return response()
     */
    public function rules(): array
    {
        return [
            'nama_barang' => 'required',
            'qty' => 'required|number',
            'harga_beli' => 'required|number',
            'harga_jual' => 'required|number'
        ];
    }
}
