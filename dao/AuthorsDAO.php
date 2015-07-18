<?php

namespace app\dao;

use yii\db\Query;

class AuthorsDAO
{
    protected function get() {
        return (new Query())
        ->select('*')
        ->from('tbl_authors as a');
    }

    public function getAllRows()
    {
        return self::get()
        ->all();
    }

    public function getRowById($id)
    {
        return self::get()
        ->join('LEFT JOIN', 'tbl_img_authors as aimg', 'a.author_id = aimg.author_id')
        ->where('a.author_id = :author_id')
        ->addParams([':author_id' => $id])
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
        return (new Query())
            ->select('c.iso AS value, c.name AS text')
            ->from('tbl_authors AS a')
            ->join('JOIN', 'tbl_countries AS c', 'a.country = c.id')
            ->groupBy('value')
            ->orderBy('text')
            ->all();
    }
}

?>