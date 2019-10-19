<?php


namespace viking\core\helpers;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class spreadSheed 
{
    public static function create(array $items, array $header, $filePath)
    {

        $spreadsheet = new Spreadsheet();

        $rows = array_merge($header, $items);

        $spreadsheet
            ->getActiveSheet()
            ->fromArray(
                array_map(
                    function ($item) { 
                        return arrayUtf8Encoder($item); 
                    }, 
                    $rows
                )
            );

        $writer = new Xlsx($spreadsheet);
        $writer->save($filePath);

        return file_exists($filePath);
    }

    public static function download($filePath)
    {

        $fileName = end(explode('/', $filePath));

        return view(
            'download', 
            [
                'headers'  => [
                                'Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
                                'Content-Disposition: attachment; filename="'.$fileName.'"'
                            ],
                'filePath' => $filePath
            ]
        );
    }
}


