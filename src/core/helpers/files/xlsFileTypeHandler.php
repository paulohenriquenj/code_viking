<?php

namespace viking\core\helpers\files;

use viking\core\helpers\files\fileTypeHandler;

use \PhpOffice\PhpSpreadsheet\Reader\Xlsx as readerXlsx;

class xlsFileTypeHandler implements fileTypeHandler
{

    protected $spreadsheetFields;

    public function load(string $filePath)
    {
        $reader = new readerXlsx();

        if ($this->isValid($reader, $filePath)) {
            
            $reader->setReadDataOnly(true);
            $this->getDataFromXls($reader->load($filePath));

        }

        return $this->itens;
    }

    public function isValid($reader, $filePath)
    {
        if (!$reader->canRead($filePath)) {
            echo 'Tipo de arquivo inválido';
        }

        return true;
    }

    protected function getDataFromXls($spreadsheet)
    {
        $indexOfColumns = $this->setColumsIndexRange();
        $worksheet = $spreadsheet->getActiveSheet();
        $indexOfLastColumn = array_search($worksheet->getHighestColumn(), $indexOfColumns);
        
        for ($row = 1; $row <= $worksheet->getHighestRow(); $row++) {
            foreach ($indexOfColumns as $columnIndex => $columnLetter) {
                
                $cellValue = $worksheet->getCellByColumnAndRow(($columnIndex + 1), $row)->getValue();
                
                $this->setItem($row, $columnIndex, $cellValue);

                if ($columnIndex >= $indexOfLastColumn) {
                    break;
                }
            }
        }
    }

    protected function setItem($rowNum, $columnIndex, $cellValue)
    {
        if ($rowNum == 1 ) {
            $this->setSpreadsheetFields($cellValue);
            return;
        }

        $this->itens[$rowNum][$this->spreadsheetFields[$columnIndex]] =  $cellValue;

    }

    public function setColumsIndexRange($start='A', $end='Z')
    {
        return range($start, $end);
    }

    public function setSpreadsheetFields($fieldName)
    {
        $this->spreadsheetFields [] = $fieldName;
    }

    public function getSpreadsheetFields()
    {
        return $this->spreadsheetFields;
    }
}

