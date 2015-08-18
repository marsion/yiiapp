<?php

namespace app\dao;

use yii\db\Query;

class GenreDAO
{

    public function findFilterOptionsGenres()
    {
        return (new Query())
            ->select('name AS text, genre_id AS value')
            ->from('tbl_genres')
            ->distinct()
            ->all();
    }
}

?>