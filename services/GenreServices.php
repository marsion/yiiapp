<?php

namespace app\services;

use app\dao\GenreDAO;
use app\models\GenreModel;
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

    public function getAllGenresOfBookById($id) {
        if($data = self::dao()->findAllGenresOfBookById($id)) {
            foreach ($data as $row) {
                $genre = new GenreModel();
                $genre->id = $row['genre_id'];
                $genre->name = $row['name'];

                $genres[] = $genre;
            }

            return $genres;
        } else {
            return array();
        }
    }

    public function getAllGenresOfAuthorById($id) {
        if($data = self::dao()->findAllGenresOfAuthorById($id)) {
            foreach ($data as $row) {
                $genre = new GenreModel();
                $genre->id = $row['genre_id'];
                $genre->name = $row['name'];

                $genres[] = $genre;
            }

            return $genres;
        } else {
            return array();
        }
    }
}
?>