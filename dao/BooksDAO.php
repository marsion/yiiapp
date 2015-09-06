<?php

namespace app\dao;

use Yii;
use yii\db\Query;

class BooksDAO
{
    public function findAllBooks($pages, $sort, $ord, $c, $ph, $g, $l, $lo)
    {

        $wheresql = "";
        $joinsql = "";

        if (!($ph == null && $g == null && $l == null && $lo == null)) {

            if ($g != null) {
                $joinsql = " JOIN `tbl_book_genre` AS `bg` ON `b`.`book_id` = `bg`.`book_id` ";
                if (empty($wheresql)) {
                    $wheresql = $wheresql . "  WHERE ";
                } else {
                    $wheresql = $wheresql . " AND ";
                }
                $wheresql = $wheresql . " `bg`.`genre_id` = :genre_id ";
            }

            if ($ph != null) {
                if (empty($wheresql)) {
                    $wheresql = $wheresql . "  WHERE ";
                } else {
                    $wheresql = $wheresql . " AND ";
                }
                $wheresql = $wheresql . " `ph_id` = :ph_id ";
            }
            if ($l != null) {
                if (empty($wheresql)) {
                    $wheresql = $wheresql . " WHERE ";
                } else {
                    $wheresql = $wheresql . " AND ";
                }
                $wheresql = $wheresql . " `lang` = :lang ";
            }
            if ($lo != null) {
                if (empty($wheresql)) {
                    $wheresql = $wheresql . " WHERE ";
                } else {
                    $wheresql = $wheresql . " AND ";
                }
                $wheresql = $wheresql . " `orig_lang` = :orig_lang ";
            }
        }

        $sortsql = " ORDER BY ";
        if ($sort == 'title') {
            ($ord == 'asc') ? $sortBy = $sortsql = $sortsql . " `b`.`title` ASC " : $sortsql = $sortsql . " `b`.`title` DESC ";
        } elseif ($sort == 'year') {
            ($ord == 'asc') ? $sortsql = $sortsql . " `b`.`year` ASC " : $sortsql = $sortsql . " `b`.`year` DESC ";
        } else {
            $sortsql = $sortsql . " `b`.`year` DESC ";
        }

        $sql = "SELECT `b`.`book_id`, `b`.`title` FROM `tbl_books` AS `b` "
            . $joinsql . $wheresql . $sortsql
            . " LIMIT :limit OFFSET :offset ";

        $command = Yii::$app->db->createCommand($sql);

        if ($g != null) {
            $command->bindValue(':genre_id', $g);
        }
        if ($ph != null) {
            $command->bindValue(':ph_id', $ph);
        }
        if ($l != null) {
            $command->bindValue(':lang', $l);
        }
        if ($lo != null) {
            $command->bindValue(':orig_lang', $lo);
        }
        return $command
        ->bindValue(':limit', $pages->limit)
        ->bindValue(':offset', $pages->offset)
        ->queryAll();
    }

    public function findBookByID($id)
    {
        return (new Query())
        ->select('*')
        ->from('tbl_books as b')
        ->where('book_id = :id')
        ->addParams([':id' => $id])
        ->limit(1)
        ->one();
    }

    public function findAllBooksByAuthorID($id, $pages, $sort, $ord)
    {
        if ($sort == 'title') {
            ($ord == 'asc') ? $sortBy = 'title ASC' : $sortBy = 'title DESC';
        } else {
            $sortBy = 'title ASC';
        }

        return (new Query())
        ->select('*')
        ->from('tbl_books as b')
        ->join('JOIN', 'tbl_book_author as ab', 'b.book_id = ab.book_id')
        ->join('JOIN', 'tbl_authors as a', 'ab.author_id = a.author_id')
        ->where('ab.author_id = :id')
        ->addParams([':id' => $id])
        ->offset($pages->offset)
        ->limit($pages->limit)
        ->orderBy($sortBy)
        ->all();
    }

    public function findBooksCountByParams($c, $ph, $g, $l, $lo)
    {
        $c != null ? $countryName = "c.iso = '" . $c . "'" : $countryName = 1;

        return (new Query())
        ->select('*')
        ->from('tbl_books')
        ->count();
    }

    public function findBooksCountByAuthorId($id)
    {
        return (new Query())
        ->select('book_id')
        ->from('tbl_book_author')
        ->where('author_id = :id')
        ->addParams([':id' => $id])
        ->distinct()
        ->count();
    }

    public function findMostPopularBooksByAuthorID($id, $amount)
    {
        return (new Query())
        ->select('b.book_id, title')
        ->from('tbl_books as b')
        ->join('JOIN', 'tbl_book_author as ab', 'b.book_id = ab.book_id')
        ->where('ab.author_id = :id')
        ->addParams([':id' => $id])
        ->limit($amount)
        ->orderBy('rating DESC')
        ->all();
    }

    public function findUsersChoiceBooksByAuthorID($id, $amount)
    {
        $sql = "SELECT `b`.`book_id`, `b`.`title` "
            . " FROM `tbl_books` AS `b` "
            . " JOIN `tbl_book_genre` AS `bg` ON `b`.`book_id` = `bg`.`book_id` "
            . " WHERE `bg`.`genre_id` IN "
            . " (SELECT `bg`.`genre_id` "
            . " FROM `tbl_book_author` AS `ba` "
            . " JOIN `tbl_book_genre` AS `bg` ON `ba`.`book_id` = `bg`.`book_id` "
            . " WHERE `ba`.`author_id` = :id) "
            . " ORDER BY `b`.`rating` DESC limit :limit";
        return Yii::$app->db->createCommand($sql)
        ->bindValue(':id', $id)
        ->bindValue(':limit', $amount)
        ->queryAll();
    }

    public function findYearOfFirstBookByAuthorId($id)
    {
        $sql = "SELECT MIN(`year`) AS `year` "
            . " FROM `tbl_books` AS `b` "
            . " JOIN `tbl_book_author` AS `ab` "
            . " ON `b`.`book_id` = `ab`.`book_id` "
            . " WHERE `ab`.`author_id` = :id";
        return Yii::$app->db->createCommand($sql)
        ->bindValue(':id', $id)
        ->queryOne();
    }

    public function findYearOfLastBookByAuthorId($id)
    {
        $sql = "SELECT MAX(`year`) AS `year` "
            . " FROM `tbl_books` AS `b` "
            . " JOIN `tbl_book_author` AS `ab` "
            . " ON `b`.`book_id` = `ab`.`book_id` "
            . " WHERE `ab`.`author_id` = :id";
        return Yii::$app->db->createCommand($sql)
        ->bindValue(':id', $id)
        ->queryOne();
    }

    public function findBookAmountByAuthorId($id)
    {
        return (new Query())
        ->select('DISTINCT * as amount')
        ->from('tbl_books AS b')
        ->join('JOIN', 'tbl_book_author AS ab', 'b.book_id = ab.book_id')
        ->where('ab.author_id = :id')
        ->addParams([':id' => $id])
        ->count();
    }
}