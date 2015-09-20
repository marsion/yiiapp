<?php

namespace app\dao;

use Yii;
use yii\db\Query;

class AuthorsDAO
{
    private function filterByCountry($c)
    {
        $sql = "SELECT `a`.`author_id` FROM `tbl_authors` AS `a` WHERE `a`.`country` IN (" . implode(',', $c) . ")";
        if ($data = Yii::$app->db->createCommand($sql)->queryAll()) {
            foreach ($data as $array) {
                foreach ($array as $value) {
                    $authors[] = $value;
                }
            }
            return $authors;
        } else {
            return array();
        }
    }

    private function filterByBirthYear($byear, $byeq)
    {
        $sql = "SELECT `a`.`author_id` FROM `tbl_authors` AS `a` WHERE `a`.`birth_year` ";
        if(isset($byeq)) {
            if($byeq == 'b') $sql .= " < ";
            elseif($byeq == 'a') $sql .= " > ";
            else $sql .= " = ";
        } else {
            $sql .= " = ";
        }
        $sql .= " :byear ";
        if ($data = Yii::$app->db->createCommand($sql)->bindValue(':byear', $byear)->queryAll()) {
            foreach ($data as $array) {
                foreach ($array as $value) {
                    $authors[] = $value;
                }
            }
            return $authors;
        } else {
            return array();
        }
    }

    private function filterByDeathYear($dyear, $dyeq)
    {
        $sql = "SELECT `a`.`author_id` FROM `tbl_authors` AS `a` WHERE `a`.`death_year` ";
        if(isset($dyeq)) {
            if($dyeq == 'b') $sql .= " < ";
            elseif($dyeq == 'a') $sql .= " > ";
            else $sql .= " = ";
        } else {
            $sql .= " = ";
        }
        $sql .= " :dyear ";
        if ($data = Yii::$app->db->createCommand($sql)->bindValue(':dyear', $dyear)->queryAll()) {
            foreach ($data as $array) {
                foreach ($array as $value) {
                    $authors[] = $value;
                }
            }
            return $authors;
        } else {
            return array();
        }
    }

    private function filterAuthors($c, $byear, $byeq, $dyear, $dyeq)
    {
        if (!(empty($c) && $byear == null && $dyear == null)) {
            $authors = array();

            if (!empty($c)) {
                if (empty($authorsCountry = self::filterByCountry($c))) {
                    return array();
                } else {
                    $authors[] = $authorsCountry;
                }
            }
            if ($byear != null) {
                if (empty($authorsBirthYear = self::filterByBirthYear($byear, $byeq))) {
                    return array();
                } else {
                    $authors[] = $authorsBirthYear;
                }
            }
            if ($dyear != null) {
                if (empty($authorsDeathYear = self::filterByDeathYear($dyear, $dyeq))) {
                    return array();
                } else {
                    $authors[] = $authorsDeathYear;
                }
            }
            if(count($authors) > 1) {
                return call_user_func_array('array_intersect', $authors);
            } else {
                return $authors[0];
            }
        } else {
            return array();
        }
    }

    private function prepareOrdering($sort, $ord) {
        $sortsql = " ORDER BY ";
        if ($sort == 'name') {
            $sortsql .= ($ord == 'asc') ? 'full_name ASC' : 'full_name DESC';
        } elseif ($sort == 'rating') {
            $sortsql .= ($ord == 'asc') ? 'rating ASC' : 'rating DESC';
        } elseif ($sort == 'byear') {
            $sortsql .= ($ord == 'asc') ? 'birth_year ASC' : 'birth_year DESC';
        } else {
            $sortsql .= 'rating DESC';
        }
        return $sortsql;
    }

    public function findAllAuthors($pages, $sort, $ord, $c, $byear, $byeq, $dyear, $dyeq)
    {
        $sql = "SELECT `a`.`author_id`, `a`.`full_name` FROM `tbl_authors` AS `a` ";

        if (!(empty($c) && $byear == null && $dyear == null)) {
            if (!empty($authors = self::filterAuthors($c, $byear, $byeq, $dyear, $dyeq))) {
                $sql .= " WHERE `a`.`author_id` IN (" . implode(',', $authors) . ")";
            } else {
                return array();
            }
        }
        $sql .= self::prepareOrdering($sort, $ord) . " LIMIT :limit OFFSET :offset ";

        return Yii::$app->db->createCommand($sql)
        ->bindValue(':limit', $pages->limit)
        ->bindValue(':offset', $pages->offset)
        ->queryAll();
    }

    public function findAuthorsCountByParams($c, $byear, $byeq, $dyear, $dyeq)
    {
        if (!(empty($c) && $byear == null && $dyear == null)) {
            if (!empty($authors = self::filterAuthors($c, $byear, $byeq, $dyear, $dyeq))) {
                return count($authors);
            } else {
                return 0;
            }
        } else {
            $sql = "SELECT COUNT(`a`.`author_id`) AS `count` FROM `tbl_authors` AS `a` ";
            $data = Yii::$app->db->createCommand($sql)->queryOne();
            return $data['count'];
        }

    }

    public function findAuthorById($id)
    {
        return (new Query())
        ->select('*')
        ->from('tbl_authors as a')
        ->where('a.author_id = :author_id')
        ->addParams([':author_id' => $id])
        ->limit(1)
        ->one();
    }

    public function findAuthorsByBookID($id) {
        return (new Query())
            ->select('*')
            ->from('tbl_book_author as ab')
            ->join('JOIN', 'tbl_authors as a', 'ab.author_id = a.author_id')
            ->where('book_id = :book_id')
            ->addParams([':book_id' => $id])
            ->all();
    }




}

?>