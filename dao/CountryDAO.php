<?php

namespace app\dao;

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
}

?>