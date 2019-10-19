<?php


namespace viking\app\model;

use viking\app\model\model;

class cartorio extends model
{
    public function insertCartorio($cartorioInfo)
    {
        $fieldsArray = xml2array($cartorioInfo);

        $fields = array_map(
            function($item){
                return '"'.addslashes(utf8_decode($item)).'"';
            },
            $fieldsArray
        );

        if (empty($this->fetch('cartorio', ['id'], 'nome = '.$fields['nome'].''))) {
            return $this->insertTable('cartorio', $fields);
        }

        return false;

    }


}
