<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\data;
use Excel;
use App\Imports\DataImport;
use Maatwebsite\Excel\Facades\Excel as FacadesExcel;
use Maatwebsite\Excel\HeadingRowImport;
use PhpOffice\PhpSpreadsheet\Reader\Xlsx as ReaderXlsc;


use Importer;

class dataController extends Controller
{
    public function importForm()
    {
        return view('index');
    }

    public function import(Request $request)
    {
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
        }



        Excel::import(new DataImport, $request->file);
    }
}
