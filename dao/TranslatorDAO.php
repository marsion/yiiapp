<?php

namespace app\dao;

use yii\db\Query;

class TranslatorDAO
{

    public function findTranslatorById($id)
    {
        return (new Query())
        ->select('trans_id, name')
        ->from('tbl_translators')
        ->where('trans_id = :id')
        ->addParams([':id' => $id])
        ->one();
    }
}

?>