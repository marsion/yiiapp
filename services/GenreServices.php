<?php

namespace app\services;

use app\dao\GenreDAO;
use yii\db\Query;

class GenreServices {

    protected function dao()
    {
        return new GenreDAO();
    }

    public function getFilterOptionsGenres()
    {
        if($options = self::dao()->findFilterOptionsGenres()) {
            return $options;
        } else {
            return array();
        }
    }
}
?>