<?php

namespace app\dao;

use yii\db\Query;
use Yii;

class LanguageDAO
{

    public function findFilterOptionsLanguages()
    {
        $sql = "SELECT DISTINCT `lang_id`, `name` FROM `tbl_languages` WHERE `filter` = 1 ORDER BY `name` ASC ";
        return Yii::$app->db->createCommand($sql)->queryAll();
    }

    public function findLanguageById($id)
    {
        $sql = "SELECT `lang_id`, `name` FROM `tbl_languages` WHERE `lang_id` = :id ";
        return Yii::$app->db->createCommand($sql)->bindValue(':id', $id)->queryOne();
    }
}

?>