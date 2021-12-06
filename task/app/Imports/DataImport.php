<?php

namespace App\Imports;

use App\Models\data;
use Maatwebsite\Excel\Concerns\ToModel;

use Maatwebsite\Excel\Concerns\WithHeadingRow;

class DataImport implements ToModel, WithHeadingRow
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {

        // $keys = $row->keys();
        list($keys, $values) = array_divide($row);
        dd($keys);
        return new data([
            //
        ]);
    }
}
