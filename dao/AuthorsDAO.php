<?php

namespace app\dao;

use yii\db\Query;

class AuthorsDAO
{
    protected function get() {
        return (new Query())
        ->select('*')
        ->from('tbl_authors');
    }

    public function getAllRows()
    {
        return self::get()
        ->all();
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