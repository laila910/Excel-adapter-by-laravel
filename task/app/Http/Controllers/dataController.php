<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\data;
use App\Models\content;
use Excel;
use App\Imports\DataImport;
use Maatwebsite\Excel\Facades\Excel as FacadesExcel;
use Maatwebsite\Excel\HeadingRowImport;
use PhpOffice\PhpSpreadsheet\Reader\Xlsx as ReaderXlsc;
use Illuminate\Support\Facades\DB;


use Importer;

class dataController extends Controller
{
    public function importForm()
    {
        return view('index');
    }

    public function import(Request $request)
    {
        //         if(Schema::hasTable('content')){
// DB::delete('DROP TABLE content');
//         }
    
        $path = storage_path() . '/app/' . request()->file('file')->store('tmp');
        $reader = new ReaderXlsc();
        $spreadsheet = $reader->load($path);
        $sheet = $spreadsheet->getActiveSheet();
        $worksheetInfo = $reader->listWorksheetInfo($path);
        $totalRows = $worksheetInfo[0]['totalRows'];
        $totalColumns = $worksheetInfo[0]['totalColumns'];

        for ($column = 1; $column <= $totalColumns; $column++) {

            $firstColumn = $sheet->getCell("A{$column}")->getValue();
            $SecondColumn = $sheet->getCell("B{$column}")->getValue();
            $ThirdColumn = $sheet->getCell("C{$column}")->getValue();
            $FourthColumn = $sheet->getCell("D{$column}")->getValue();
            $FifthColumn = $sheet->getCell("E{$column}")->getValue();

            //YOU CAN ADD MORE TO READ MORE COLUMNS :)
            $array = [$firstColumn, $SecondColumn, $ThirdColumn, $FourthColumn, $FifthColumn];
            session()->put('array', $array);

            // Excel::import(new DataImport, session()->get($array));
            // return 'data loaded :) ';
            // DB::table('data')
            
               $createTableSqlString =
  "CREATE TABLE  content (
      $firstColumn INT(11) NOT NULL AUTO_INCREMENT,
      $SecondColumn Varchar(100) NOT NULL,
      $ThirdColumn Varchar(100) Not Null,
      $FourthColumn Varchar(100) Not Null,
      $FifthColumn Varchar(100) Not Null,
      
    )
    COLLATE='utf8mb4_unicode_ci	'
    ENGINE=InnoDB
    AUTO_INCREMENT=1";
       DB::statement($createTableSqlString);
        }
$data=$session() ->get('array') ;
foreach ($data as $key) {
            Validator::make($data, [
                $key => 'required',

            ])->validate();
        }


        Excel::import(new DataImport, $request->file);
        return 'data inserted';
    }
}
