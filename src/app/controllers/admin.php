<?php

namespace viking\app\controllers;

use viking\app\model\cartorio;

class admin
{

    public function index()
    {
        $this->adminView();
    }

    public function adminView($content='admin', $msg=null)
    {
        $itens = [
            'content' => $content,
            'header' => 'admin_header',
            'footer' => 'admin_footer',
            'aside' => 'admin_aside'
        ];

        view($itens, ['msg' => $msg['msg']]);
    }

    public function importXml()
    {
        $this->adminView('admin_formXML');
    }

    public function importXmlFile()
    {
        if (file_exists($_FILES['file']['tmp_name'])) {

            $cartorio = new cartorio;

            $xml =  xml2array(
                simplexml_load_file($_FILES['file']['tmp_name'])
            );
    
            $insert = array_map([$cartorio, 'insertCartorio'], $xml['cartorio']);

            $msg = 'Total de registros inseridos: ' . array_sum($insert);
            
            return $this->adminView('admin_total', ['msg' => ['type' => 'dark', 'msg' => $msg]]);
            
        }
        
        return $this->adminView('admin', ['msg' => ['type' => 'danger', 'msg' => 'Erro ao carregar o arquivo']]);
    }

}