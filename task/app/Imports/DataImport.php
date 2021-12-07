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
        // list($keys, $values) = array_divide($row);
        // dd($keys);
        $array = [];
        foreach ($row as $key => $value) {

            array_push($array, $key);
        }
        foreach ($array as $key) {
            Validator::make($row, [
                $key => 'required',

            ])->validate();
        }
        if (count($array) > 0) {
            foreach ($array as $key => $value) {
               $Data= new data([
                    $key => $value,

                ]);
            }
        } else
            return $Data;
    }
}
