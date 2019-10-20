<?php


namespace viking\app\model;

use viking\core\database\model;

class cartorio extends model
{
    const REGISTER_INSERTED   = 1;
    const REGISTER_DUPLICATED = 2;
    const REGISTER_FAILED     = 3;

    public $fieldsNames=[];

    public function __construct() 
    {
        parent::__construct();
        $this->setfieldsNamesRelation();
    }

    public function insertCartorio($cartorios)
    {
        // $fieldsArray = xml2array($cartorioInfo);

        $fields = [];
        array_walk(
            $cartorios,
            function ($item, $key) use (&$fields) {
                $fieldName = $this->findFieldDBName($key);
                $fields [$fieldName] = wrapperAndSlashes(
                    utf8_decode($this->removeNULLstring(trim($item)))
                );
            }
        );

        if (empty($this->fetch('cartorio', ['id'], 'documento = '.$fields['documento'].' AND nome = '.$fields['nome'].''))) {

            if ($this->insert('cartorio', $fields)) {
                return self::REGISTER_INSERTED;
            }

        } else {
            return self::REGISTER_DUPLICATED;
        }

        return self::REGISTER_FAILED;

    }

    public function removeNULLstring($item)
    {
        if (strtolower($item) == 'null') {
            return '';
        }

        return $item;
    }

    public function setfieldsNamesRelation()
    {
        $this->fieldsNames ['database'] = $this->namesDatabase();
        $this->fieldsNames ['xml'] = $this->namesXml();
        $this->fieldsNames ['xls'] = $this->namesXls();
    }

    public function namesDatabase()
    {
        return [
            'nome'           => 'nome',
            'razao'          => 'razao',
            'tipo_documento' => 'tipo_documento',
            'documento'      => 'documento',
            'cep'            => 'cep',
            'endereco'       => 'endereco',
            'bairro'         => 'bairro',
            'cidade'         => 'cidade',
            'uf'             => 'uf',
            'tabeliao'       => 'tabeliao',
            'ativo'          => 'ativo',
            'telefone'       => 'telefone',
            'email'          => 'email'
        ];
    }

    public function namesXml()
    {
        return [
            $this->fieldsNames['database']['nome']           => 'nome',
            $this->fieldsNames['database']['razao']          => 'razao',
            $this->fieldsNames['database']['tipo_documento'] => 'tipo_documento',
            $this->fieldsNames['database']['documento']      => 'documento',
            $this->fieldsNames['database']['cep']            => 'cep',
            $this->fieldsNames['database']['endereco']       => 'endereco',
            $this->fieldsNames['database']['bairro']         => 'bairro',
            $this->fieldsNames['database']['cidade']         => 'cidade',
            $this->fieldsNames['database']['uf']             => 'uf',
            $this->fieldsNames['database']['tabeliao']       => 'tabeliao',
            $this->fieldsNames['database']['ativo']          => 'ativo',
            $this->fieldsNames['database']['telefone']       => 'telefone',
            $this->fieldsNames['database']['email']          => 'email'
        ];
    }

    public function namesXls()
    {
        return [
            $this->fieldsNames['database']['nome']      => 'NOME',
            $this->fieldsNames['database']['razao']     => 'RAZÃO',
            $this->fieldsNames['database']['documento'] => 'DOCUMENTO',
            $this->fieldsNames['database']['cep']       => 'CEP',
            $this->fieldsNames['database']['endereco']  => 'ENDEREÇO',
            $this->fieldsNames['database']['bairro']    => 'BAIRRO',
            $this->fieldsNames['database']['cidade']    => 'CIDADE',
            $this->fieldsNames['database']['uf']        => 'UF',
            $this->fieldsNames['database']['telefone']  => 'TELEFONE',
            $this->fieldsNames['database']['email']     => 'E-MAIL',
            $this->fieldsNames['database']['tabeliao']  => 'TABELIÃO',
            $this->fieldsNames['database']['ativo']     => 'ATIVO',
        ];
    }

    public function findFieldDBName($fieldName)
    {
        $availableNames = array_keys($this->fieldsNames);

        foreach ($availableNames as $nameType) {
            foreach ($this->fieldsNames[$nameType] as $nameDB => $name) {
                if ($fieldName == $name) {
                    return $this->fieldsNames['database'][$nameDB];
                }
            }
        }
        return '';
    }

}
