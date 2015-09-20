<?php

namespace app\dao;

use Yii;
use yii\db\Query;

class BooksDAO
{
    private function filterByLanguage($lang)
    {
        $sql = "SELECT `b`.`book_id` FROM `tbl_books` AS `b` WHERE `b`.`lang` IN (" . implode(',', $lang) . ")";
        if ($data = Yii::$app->db->createCommand($sql)->queryAll()) {
            foreach ($data as $array) {
                foreach ($array as $value) {
                    $books[] = $value;
                }
            }
            return $books;
        } else {
            return array();
        }
    }

    private function filterByOriginLanguage($langor)
    {
        $sql = "SELECT `b`.`book_id` FROM `tbl_books` AS `b` WHERE `b`.`orig_lang` IN (" . implode(',', $langor) . ")";
        if ($data = Yii::$app->db->createCommand($sql)->queryAll()) {
            foreach ($data as $array) {
                foreach ($array as $value) {
                    $books[] = $value;
                }
            }
            return $books;
        } else {
            return array();
        }
    }

    private function filterByPublishHouse($ph)
    {
        $sql = "SELECT `b`.`book_id` FROM `tbl_books` AS `b` WHERE `b`.`ph_id` IN (" . implode(',', $ph) . ")";
        if ($data = Yii::$app->db->createCommand($sql)->queryAll()) {
            foreach ($data as $array) {
                foreach ($array as $value) {
                    $books[] = $value;
                }
            }
            return $books;
        } else {
            return array();
        }
    }

    private function filterBySeries($ser)
    {
        $sql = "SELECT `b`.`book_id` FROM `tbl_books` AS `b` WHERE `b`.`series_id` IN (" . implode(',', $ser) . ")";
        if ($data = Yii::$app->db->createCommand($sql)->queryAll()) {
            foreach ($data as $array) {
                foreach ($array as $value) {
                    $books[] = $value;
                }
            }
            return $books;
        } else {
            return array();
        }
    }

    private function filterByTranslator($trans)
    {
        $sql = "SELECT `b`.`book_id` FROM `tbl_books` AS `b` WHERE `b`.`trans_id` IN (" . implode(',', $trans) . ")";
        if ($data = Yii::$app->db->createCommand($sql)->queryAll()) {
            foreach ($data as $array) {
                foreach ($array as $value) {
                    $books[] = $value;
                }
            }
            return $books;
        } else {
            return array();
        }
    }

    private function filterByGenre($g)
    {
        $sql = "SELECT `b`.`book_id` FROM `tbl_books` AS `b` JOIN `tbl_book_genre` AS `bg` ON `b`.`book_id` = `bg`.`book_id` WHERE `bg`.`genre_id` IN (" . implode(',', $g) . ")";
        if ($data = Yii::$app->db->createCommand($sql)->queryAll()) {
            foreach ($data as $array) {
                foreach ($array as $value) {
                    $books[] = $value;
                }
            }
            return $books;
        } else {
            return array();
        }
    }

    private function filterByAuthor($a)
    {
        $sql = "SELECT `b`.`book_id` FROM `tbl_books` AS `b` JOIN `tbl_book_author` AS `ba` ON `b`.`book_id` = `ba`.`book_id` WHERE `ba`.`author_id` IN (" . implode(',', $a) . ")";
        if ($data = Yii::$app->db->createCommand($sql)->queryAll()) {
            foreach ($data as $array) {
                foreach ($array as $value) {
                    $books[] = $value;
                }
            }
            return $books;
        } else {
            return array();
        }
    }

    private function filterByCountry($c)
    {
        $sql = "SELECT `b`.`book_id` FROM `tbl_books` AS `b` JOIN `tbl_book_author` AS `ba` ON `b`.`book_id` = `ba`.`book_id` WHERE `ba`.`author_id` IN (SELECT `a`.`author_id` FROM `tbl_authors` AS `a` WHERE `a`.`country` IN (" . implode(',', $c) . "))";
        if ($data = Yii::$app->db->createCommand($sql)->queryAll()) {
            foreach ($data as $array) {
                foreach ($array as $value) {
                    $books[] = $value;
                }
            }
            return $books;
        } else {
            return array();
        }
    }

    private function filterByYear($year, $yeq)
    {
        $sql = "SELECT `b`.`book_id` FROM `tbl_books` AS `b` WHERE `b`.`year` ";
        if(isset($yeq)) {
            if($yeq == 'b') $sql .= " < ";
            elseif($yeq == 'a') $sql .= " > ";
            else $sql .= " = ";
        } else {
            $sql .= " = ";
        }
        $sql .= " :year ";
        if ($data = Yii::$app->db->createCommand($sql)->bindValue(':year', $year)->queryAll()) {
            foreach ($data as $array) {
                foreach ($array as $value) {
                    $books[] = $value;
                }
            }
            return $books;
        } else {
            return array();
        }
    }

    private function filterBooks($a, $c, $ph, $g, $lang, $langor, $year, $yeq, $ser, $trans)
    {
        if (!(empty($a) && empty($ph) && empty($g) && empty($c) && empty($lang) && empty($langor)
            && $year == null && empty($ser) && empty($trans))) {
            $books = array();

            if (!empty($lang)) {
                if (empty($booksLang = self::filterByLanguage($lang))) {
                    return array();
                } else {
                    $books[] = $booksLang;
                }
            }
            if (!empty($langor)) {
                if (empty($booksLangOrig = self::filterByOriginLanguage($langor))) {
                    return array();
                } else {
                    $books[] = $booksLangOrig;
                }
            }
            if (!empty($g)) {
                if (empty($booksGenre = self::filterByGenre($g))) {
                    return array();
                } else {
                    $books[] = $booksGenre;
                }
            }
            if (!empty($ph)) {
                if (empty($booksPublishHouse = self::filterByPublishHouse($ph))) {
                    return array();
                } else {
                    $books[] = $booksPublishHouse;
                }
            }
            if (!empty($c)) {
                if (empty($booksCountry = self::filterByCountry($c))) {
                    return array();
                } else {
                    $books[] = $booksCountry;
                }
            }
            if ($year != null) {
                if (empty($booksYear = self::filterByYear($year, $yeq))) {
                    return array();
                } else {
                    $books[] = $booksYear;
                }
            }
            if (!empty($a)) {
                if (empty($booksAuthor = self::filterByAuthor($a))) {
                    return array();
                } else {
                    $books[] = $booksAuthor;
                }
            }
            if (!empty($ser)) {
                if (empty($booksSeries = self::filterBySeries($ser))) {
                    return array();
                } else {
                    $books[] = $booksSeries;
                }
            }
            if (!empty($trans)) {
                if (empty($booksTranslator = self::filterByTranslator($trans))) {
                    return array();
                } else {
                    $books[] = $booksTranslator;
                }
            }
            if(count($books) > 1) {
                return call_user_func_array('array_intersect', $books);
            } else {
                return $books[0];
            }
        } else {
            return array();
        }
    }

    private function prepareOrdering($sort, $ord) {
        $sortsql = " ORDER BY ";
        if ($sort == 'title') {
            $sortsql .= ($ord == 'asc') ? " `b`.`title` ASC " : " `b`.`title` DESC ";
        } elseif ($sort == 'rating') {
            $sortsql .= ($ord == 'asc') ? " `b`.`rating` ASC " : " `b`.`rating` DESC ";
        } elseif ($sort == 'year') {
            $sortsql .= ($ord == 'asc') ? " `b`.`year` ASC " : " `b`.`year` DESC ";
        } elseif ($sort == 'pages') {
            $sortsql .= ($ord == 'asc') ? " `b`.`pages` ASC " : " `b`.`pages` DESC ";
        } elseif ($sort == 'circ') {
            $sortsql .= ($ord == 'asc') ? " `b`.`circ` ASC " : " `b`.`circ` DESC ";
        } else {
            $sortsql .= " `b`.`year` DESC ";
        }
        return $sortsql;
    }

    public function findAllBooks($pages, $sort, $ord, $a, $c, $ph, $g, $lang, $langor, $year, $yeq, $ser, $trans)
    {
        $sql = "SELECT `b`.`book_id`, `b`.`title` FROM `tbl_books` AS `b` ";

        if (!(empty($a) && empty($ph) && empty($g) && empty($c) && empty($lang) && empty($langor)
            && $year == null && empty($ser) && empty($trans))) {
            if (!empty($books = self::filterBooks($a, $c, $ph, $g, $lang, $langor, $year, $yeq, $ser, $trans))) {
                $sql .= " WHERE `b`.`book_id` IN (" . implode(',', $books) . ")";
            } else {
                return array();
            }
        }

        $sql .= self::prepareOrdering($sort, $ord) . " LIMIT :limit OFFSET :offset ";
        file_put_contents('log.txt', var_export($sql, true), FILE_APPEND);
        return Yii::$app->db->createCommand($sql)
            ->bindValue(':limit', $pages->limit)
            ->bindValue(':offset', $pages->offset)
            ->queryAll();
    }

    public function findBooksCountByParams($a, $c, $ph, $g, $lang, $langor, $year, $yeq, $ser, $trans)
    {
        if (!(empty($a) && empty($ph) && empty($g) && empty($c) && empty($lang) && empty($langor)
            && $year == null && empty($ser) && empty($trans))) {
            if (!empty($books = self::filterBooks($a, $c, $ph, $g, $lang, $langor, $year, $yeq, $ser, $trans))) {
                return count($books);
            } else {
                return 0;
            }
        } else {
            $sql = "SELECT COUNT(`b`.`book_id`) AS `count` FROM `tbl_books` AS `b` ";
            $data = Yii::$app->db->createCommand($sql)->queryOne();
            return $data['count'];
        }
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