<?php

namespace viking\app\controllers;

use viking\app\model\cartorio;
use viking\app\controllers\file;

class admin
{

    public function index()
    {
        $totalCartorios = count((new cartorio)->fetchAll('cartorio', ['id']));

        $totalMsg = 'Atualmente temos ' . $totalCartorios . ' cartórios resgistrados.';

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
                ['documento'],
                true
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
        
        $cartorios = $cartorio->fetchAll(
            'cartorio',
            $cartorio->fieldsNames['database']
        );

        if (file::fileExportXls($cartorios, $cartorio->fieldsNames['database'], '/tmp/spreadsheet.xlsx')) {
            return file::download('/tmp/spreadsheet.xlsx');
        }
        
        return $this->adminView('admin', ['msg' => ['type' => 'danger', 'msg' => 'Falha ao gerar planilha.']]);
    }

    public function list()
    {
        $limit = 10;
        $offset = 1;
        $page = 1;
        $cartorio = new cartorio;
        $maxPagination = intval(($cartorio->totalOfRows('cartorio'))['total'] / $limit);

        if (!empty($_GET['page'])) {
            $p = intval($_GET['page']);
            $page = ($p > $maxPagination)? $maxPagination : $p;
            $offset = ($page * $limit) - $limit;
        }

        $cartorios = $cartorio->fetchAll(
            'cartorio', 
            ['id', 'nome', 'tabeliao', 'cidade'],
            '',
            $offset . ', ' . $limit
        );

        $this->adminView('admin_cartorioList', null, ['cartorios' => $cartorios, 'page' => $page]);
    }


}


