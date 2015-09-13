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

    public function findFilterOptionsCountries()
    {
        $sql = "SELECT `id`, `name` FROM `tbl_countries` WHERE `filter` = 1 ORDER BY `name` ASC";
        return Yii::$app->db->createCommand($sql)->queryAll();
    }
}

?>