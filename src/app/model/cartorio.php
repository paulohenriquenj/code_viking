<?php


namespace viking\app\model;

use viking\app\model\model;

class cartorio extends model
{
    const REGISTER_INSERTED   = 1;
    const REGISTER_DUPLICATED = 2;
    const REGISTER_FAILED     = 3;

    public function insertCartorio($cartorioInfo)
    {
        $fieldsArray = xml2array($cartorioInfo);

        $fields = array_map(
            function ($item) {
                return wrapperAndSlashes(
                    utf8_decode($this->removeNULLstring(trim($item)))
                );
            },
            $fieldsArray
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

}
