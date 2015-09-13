<?php

namespace app\services;

use app\models;
use app\models\BookModel;
use app\dao\BooksDAO;
use yii\web\NotFoundHttpException;

class BookServices {

    protected function dao()
    {
        return new BooksDAO();
    }

    public function getBooksCountByParams($a, $c, $ph, $g, $lang, $langor, $year, $yeq, $ser, $trans)
    {
        return self::dao()->findBooksCountByParams($a, $c, $ph, $g, $lang, $langor, $year, $yeq, $ser, $trans);
    }

    public function getAllBooks($pages, $sort, $ord, $a, $c, $ph, $g, $lang, $langor, $year, $yeq, $ser, $trans)
    {
        if($data = self::dao()->findAllBooks($pages, $sort, $ord, $a, $c, $ph, $g, $lang, $langor, $year, $yeq, $ser, $trans)) {

            foreach ($data as $row) {
                $book = new BookModel();
                $book->id = $row['book_id'];
                $book->title = $row['title'];
                $book->authors = self::authorServices()->getAuthorsByBookID($row['book_id']);
                $book->img = self::imgServices()->getImageByBookId($row['book_id']);
                $books[] = $book;
            }
            return $books;
        } else {
            return array();
        }
    }

    public function getBookByID($id)
    {
        if($row = self::dao()->findBookByID($id)) {

            $book = new BookModel();
            $book->id = $id;
            $book->title = $row['title'];
            $book->description = $row['description'];
            $book->rating = $row['rating'];
            $book->pages = $row['pages'];
            $book->isbn = $row['isbn'];
            $book->lang = self::languageServices()->getLanguageById($row['lang']);
            $book->origLang = self::languageServices()->getLanguageById($row['orig_lang']);
            $book->year = $row['year'];
            $book->translator = self::translatorServices()->getTranslatorById($row['trans_id']);
            $book->publishingHouse = self::publishingHouseServices()->getPublishingHouseById($row['ph_id']);
            $book->series = self::seriesServices()->getSeriesById($row['series_id']);

            $book->authors = self::authorServices()->getAuthorsByBookID($id);
            $book->img = self::imgServices()->getImageByBookId($id);
            $book->genres = self::genreServices()->getAllGenresOfBookById($id);

            return $book;
        } else {
            throw new NotFoundHttpException('Sorry, but the requested page does not exist!');
        }
    }

    public function getMostPopularBooksByAuthorID($id, $amount)
    {
        if($data = self::dao()->findMostPopularBooksByAuthorID($id, $amount)) {

            foreach ($data as $row) {

                $book = new BookModel();
                $book->id = $row['book_id'];
                $book->title = $row['title'];
                $book->authors = self::authorServices()->getAuthorsByBookID($row['book_id']);
                $book->img = self::imgServices()->getImageByBookId($row['book_id']);

                $books[] = $book;
            }
            return $books;
        } else {
            return array();
        }
    }

    public function getUsersChoiceBooksByAuthorID($id, $amount)
    {
        if($data = self::dao()->findUsersChoiceBooksByAuthorID($id, $amount)) {

            foreach ($data as $row) {

                $book = new BookModel();
                $book->id = $row['book_id'];
                $book->title = $row['title'];
                $book->authors = self::authorServices()->getAuthorsByBookID($row['book_id']);
                $book->img = self::imgServices()->getImageByBookId($row['book_id']);

                $books[] = $book;
            }
            return $books;
        } else {
            return array();
        }
    }

    public function getYearOfFirstBookByAuthorId($id)
    {
        if($row = self::dao()->findYearOfFirstBookByAuthorId($id)) {
            return $row['year'] != 0 ? $row['year'] : "";
        } else {
            return "";
        }
    }

    public function getYearOfLastBookByAuthorId($id)
    {
        if($row = self::dao()->findYearOfLastBookByAuthorId($id)) {
            return $row['year'] != 0 ? $row['year'] : "";
        } else {
            return "";
        }
    }

    public function getBookAmountByAuthorId($id)
    {
        if($row = self::dao()->findBookAmountByAuthorId($id)) {
            return $row;
        } else {
            return 0;
        }
    }

    protected function imgServices()
    {
        return new ImgServices();
    }

    protected function authorServices()
    {
        return new AuthorServices();
    }

    protected function translatorServices()
    {
        return new TranslatorServices();
    }

    protected function publishingHouseServices()
    {
        return new PublishingHouseServices();
    }

    protected function seriesServices()
    {
        return new SeriesServices();
    }

    protected function genreServices()
    {
        return new GenreServices();
    }

    protected function languageServices()
    {
        return new LanguageServices();
    }
}
?>