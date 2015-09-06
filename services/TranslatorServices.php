<?php

namespace app\services;

use app\dao\TranslatorDAO;
use app\models\TranslatorModel;

class TranslatorServices {

    protected function dao(){
        return new TranslatorDAO();
    }

    public function getTranslatorById($id)
    {
        if ($row = self::dao()->findTranslatorById($id)) {
            $translator = new TranslatorModel();
            $translator->id = $row['trans_id'];
            $translator->name = $row['name'];
            return $translator;
        } else {
            return array();
        }
    }
}
?>