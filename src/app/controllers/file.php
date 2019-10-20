<?php


namespace viking\app\controllers;
use viking\app\model\cartorio;
use viking\app\controllers\admin;

use viking\core\helpers\files\factoryFileTypeHandler;
use viking\core\helpers\spreadSheed;


class file
{

    protected $fileHandler;

    public function importXml()
    {
        return $this->toAdminView('admin_formFile', null, ['type' => '.xml']);
    }

    public function importXls()
    {
        return $this->toAdminView('admin_formFile', null, ['type' => '.xls, .xlsx']);
    }

    public function importXmlFile()
    {
        if (file_exists($_FILES['file']['tmp_name'])) {

            $cartorio = new cartorio;

            $this->loadHandler();

            $items = $this->fileHandler->load($_FILES['file']['tmp_name']);

            $inserted = array_count_values(array_map([$cartorio, 'insertCartorio'], $items));

            $msg = 'Total de registros inseridos: ' . (($inserted[$cartorio::REGISTER_INSERTED])?$inserted[$cartorio::REGISTER_INSERTED] : '0'). '.<br>
                Registro duplicados: ' . (($inserted[$cartorio::REGISTER_DUPLICATED])?$inserted[$cartorio::REGISTER_DUPLICATED] : '0') . ' (não foram inseridos).<br>
                Falhas na inserção: ' . (($inserted[$cartorio::REGISTER_FAILED])?$inserted[$cartorio::REGISTER_FAILED] : '0') . '.';
            
            return $this->toAdminView('admin_total', ['msg' => ['type' => 'dark', 'msg' => $msg]]);
            
        }
        
        return $this->toAdminView('admin', ['msg' => ['type' => 'danger', 'msg' => 'Erro ao carregar o arquivo']]);
    }

    private function toAdminView($content, $msg=null, $varsToView=[])
    {
        return (new admin)->adminView($content, $msg, $varsToView);
    }

    public function loadHandler()
    {
        $this->fileHandler = factoryFileTypeHandler::getFileHandler();
    }

    public static function fileExportXls($itens, $header, $filePath)
    {
        return spreadSheed::create(
            $itens,
            [array_map(
                function ($item) {
                    return str_replace('_', ' ', ucfirst($item));
                },
                $header
            )],
            $filePath
        );
    }

    public static function download($filePath)
    {
        spreadSheed::download($filePath);
    }
}
