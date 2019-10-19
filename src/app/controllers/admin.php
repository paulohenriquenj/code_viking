<?php

namespace viking\app\controllers;

use viking\app\model\cartorio;
use viking\core\helpers\spreadSheed;

class admin
{

    public function index()
    {
        $totalCartorios = count((new cartorio)->fetchAll('cartorio', ['id']));

        $totalMsg = 'Temos ' . $totalCartorios . ' registros de cartórios.';

        $this->adminView('admin', null, ['totalMsg' => $totalMsg]);
    }

    public function adminView($content='admin', $msg=null, $varsToView=[])
    {
        $itens = [
            'content' => $content,
            'header' => 'admin_header',
            'footer' => 'admin_footer',
            'aside' => 'admin_aside'
        ];

        if (!empty($msg)) {
            $varsToView ['msg'] = $msg['msg'];
        }

        view($itens, $varsToView);
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
    
            $inserted = array_count_values(array_map([$cartorio, 'insertCartorio'], $xml['cartorio']));

            $msg = 'Total de registros inseridos: ' . (($inserted[$cartorio::REGISTER_INSERTED])?$inserted[$cartorio::REGISTER_INSERTED] : '0'). '.<br>
                Registro duplicados: ' . (($inserted[$cartorio::REGISTER_DUPLICATED])?$inserted[$cartorio::REGISTER_DUPLICATED] : '0') . ' (não foram inseridos).<br>
                Falhas na inserção: ' . (($inserted[$cartorio::REGISTER_FAILED])?$inserted[$cartorio::REGISTER_FAILED] : '0') . '.';
            
            return $this->adminView('admin_total', ['msg' => ['type' => 'dark', 'msg' => $msg]]);
            
        }
        
        return $this->adminView('admin', ['msg' => ['type' => 'danger', 'msg' => 'Erro ao carregar o arquivo']]);
    }

    public function editCartorio()
    {
        $this->adminView('admin_cartorio');
    }

    public function searchCartorio()
    {
        $cartorio = new cartorio;

        $fields = array_filter(
            $cartorio->wrapperFields(
                array_filter($_POST),
                ['nome', 'tabeliao'],
                ['documento']
            )
        );

        $fieldsToWhere = $cartorio->buildWhereInstruction($fields);

        $cartorios = (new cartorio)->fetchAll(
            'cartorio', 
            ['id', 'nome', 'tabeliao', 'cidade'],
            implode(' OR ', $fieldsToWhere)
        );


        $this->adminView('admin_cartorioList', null, ['cartorios' => $cartorios]);
    }

    public function editCartorioInfo($id=null, $msg=null)
    {
        if (!empty($_GET['id']) || !empty($id)) {

            $_id = intval($id ?? $_GET['id']);

            $cartorio = (new cartorio)->fetch('cartorio', ['*'], ' id = '. $_id);
            return $this->adminView('admin_cartorioEdit', $msg, ['cartorio' =>  arrayUtf8Encoder($cartorio)]);
        }

        return $this->adminView('admin', ['msg' => ['type' => 'danger', 'msg' => 'Não encontrei as informação sobre o cartório desejado.']]);
    }

    public function updataCartorioInfo()
    {
        $cartorio = new cartorio;

        $id = intval($_POST['id']);
        unset($_POST['id']);

        $fields = array_filter(
            $cartorio->wrapperFields(
                $_POST,
                []
            )
        );


        if ($cartorio->update('cartorio', 'id = ' .$id, $fields['equal']) ) {
            return $this->editCartorioInfo($id, ['msg' => ['type' => 'success', 'msg' => 'Cartório editado.']]);
        }

        return $this->adminView('admin', ['msg' => ['type' => 'danger', 'msg' => 'Falha ao aditar cartório.']]);

    }

    public function deleteCartorio()
    {
        if (!empty($_GET['id'])) {
            if ((new cartorio)->delete('cartorio', 'id = ' . intval($_GET['id']))) {
                return $this->adminView('admin', ['msg' => ['type' => 'success', 'msg' => 'Registro apagado com sucesso.']]);
            }
        }

        return $this->adminView('admin', ['msg' => ['type' => 'danger', 'msg' => 'Falha ao apagar registro.']]);
    }

    public function exportCartorio()
    {
        $cartorio = new cartorio;
        $filePath = '/tmp/spreadsheet.xlsx';
        
        $header = [
                'nome',
                'razao',
                'tipo_documento',
                'documento',
                'cep',
                'endereco',
                'bairro',
                'cidade',
                'uf',
                'tabeliao',
                'ativo',
                'telefone',
                'email'
            ];
        
        $cartorios = $cartorio->fetchAll(
            'cartorio',
            $header
        );

        $spreadsheet = spreadSheed::create(
            $cartorios,
            [array_map(
                function ($item) {
                    return str_replace('_', ' ', ucfirst($item));
                },
                $header
            )],
            $filePath
        );
        

        if ($spreadsheet) {
            return spreadSheed::download($filePath);
        }
        
        return $this->adminView('admin', ['msg' => ['type' => 'danger', 'msg' => 'Falha ao gerar planilha.']]);
    }

}


