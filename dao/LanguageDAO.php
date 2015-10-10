<?php

namespace app\dao;

use yii\db\Query;
use Yii;

class LanguageDAO
{

    public function findFilterOptionsLanguages($lang)
    {
        if(empty($lang)) {
            $sql = "SELECT DISTINCT `lang_id`, `name` FROM `tbl_languages` ORDER BY `name` ASC ";
            return Yii::$app->db->createCommand($sql)->queryAll();
        }  else {
            $sql = "SELECT `lang_id`, `name` FROM `tbl_languages` AS `l` WHERE `l`.`lang_id` IN ("
                . implode(',', $lang) . ") ORDER BY `name`";
            $selectedData = Yii::$app->db->createCommand($sql)->queryAll();
            $sql = "SELECT `lang_id`, `name` FROM `tbl_languages` AS `l` WHERE `l`.`lang_id` NOT IN ("
                . implode(',', $lang) . ") ORDER BY `name` ";
            $additionalData = Yii::$app->db->createCommand($sql)->queryAll();
            $selectedData = array_merge($selectedData, $additionalData);

        }
        return $selectedData;
    }

    public function findLanguageById($id)
    {
        $sql = "SELECT `lang_id`, `name` FROM `tbl_languages` WHERE `lang_id` = :id ";
        return Yii::$app->db->createCommand($sql)->bindValue(':id', $id)->queryOne();
    }
}

?>