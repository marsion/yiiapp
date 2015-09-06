<?php

namespace app\dao;

use yii\db\Query;
use Yii;

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

    public function findAllGenresOfBookById($id)
    {
        $sql = "SELECT `g`.`genre_id`, `g`.`name` "
            ." FROM `tbl_genres` AS `g` "
            ." JOIN `tbl_book_genre` AS `bg` "
            ." ON `g`.`genre_id` = `bg`.`genre_id` "
            ." WHERE `bg`.`book_id` = :id";
        return Yii::$app->db->createCommand($sql)->bindValue(':id', $id)->queryAll();
    }

    public function findAllGenresOfAuthorById($id)
    {
        $sql = "SELECT DISTINCT `g`.`genre_id`, `g`.`name` "
            ." FROM `tbl_genres` AS `g` "
            ." JOIN `tbl_book_genre` AS `bg` "
            ." ON `g`.`genre_id` = `bg`.`genre_id` "
            ." WHERE `bg`.`book_id` IN "
            ." (SELECT `ba`.`book_id` "
            ." FROM `tbl_book_author` AS `ba` "
            ." WHERE `ba`.`author_id` = :id)";
        return Yii::$app->db->createCommand($sql)->bindValue(':id', $id)->queryAll();
    }
}

?>