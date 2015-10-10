<?php

namespace app\dao;

use Yii;
use yii\db\Query;

class CountryDAO
{
    protected function get() {
        return (new Query())
        ->select('*')
        ->from('tbl_countries');
    }

    public function getCountryNameById($id)
    {
        return (new Query())
        ->select('name')
        ->from('tbl_countries')
        ->where('id = :id')
        ->addParams([':id' => $id])
        ->limit(1)
        ->one();
    }

    public function findCountryISOById($id)
    {
        return (new Query())
        ->select('iso')
        ->from('tbl_countries')
        ->where('id = :id')
        ->addParams([':id' => $id])
        ->limit(1)
        ->one();
    }

    public function getRowById($id)
    {
        return self::get()
        ->where('id = :id')
        ->addParams([':id' => $id])
        ->limit(1)
        ->one();
    }

    public function getCount()
    {
        return self::get()
        ->count();
    }

    public function findFilterOptionsCountries($c)
    {
        if(empty($c)) {
            $sql = "SELECT `id`, `name` FROM `tbl_countries` ORDER BY `name` ASC";
            return Yii::$app->db->createCommand($sql)->queryAll();
        } else {
            $sql = "SELECT `id`, `name` FROM `tbl_countries` AS `c` WHERE `c`.`id` IN ("
                . implode(',', $c) . ") ORDER BY `name`";
            $selectedData = Yii::$app->db->createCommand($sql)->queryAll();
            $sql = "SELECT `id`, `name` FROM `tbl_countries` AS `c` WHERE `c`.`id` NOT IN ("
                . implode(',', $c) . ") ORDER BY `name` ";
            $additionalData = Yii::$app->db->createCommand($sql)->queryAll();
            $selectedData = array_merge($selectedData, $additionalData);

        }
        return $selectedData;
    }
}

?>