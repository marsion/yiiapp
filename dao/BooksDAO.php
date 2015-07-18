<?php

namespace app\dao;

use yii\db\Query;

class BooksDAO
{
    public function findFilterOptionsCountries()
    {
        return (new Query())
        ->select('c.iso AS value, c.name AS text')
        ->from('tbl_ab AS ab')
        ->join('JOIN', 'tbl_authors AS a', 'ab.author_id = a.author_id')
        ->join('JOIN', 'tbl_countries AS c', 'a.country = c.id')
        ->groupBy('value')
        ->orderBy('text')
        ->all();
    }
}