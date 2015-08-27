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

    public function getBooksCountByCountry($country)
    {
        return self::dao()->findBooksCountByCountry($country);
    }

    public function getBooksCountByAuthorId($id)
    {
        return self::dao()->findBooksCountByAuthorId($id);
    }

    public function getAllBooks($pages, $sort, $ord, $country)
    {
        if($data = self::dao()->findAllBooks($pages, $sort, $ord, $country)) {

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
            throw new NotFoundHttpException('Sorry, but the requested page does not exist!');
        }
    }

    public function getBookByID($id)
    {
        if($row = self::dao()->findBookByID($id)) {

            $book = new BookModel();
            $book->id = $id;
            $book->title = $row['title'];
            $book->description = $row['description'];

            $book->authors = self::authorServices()->getAuthorsByBookID($id);
            $book->img = self::imgServices()->getImageByBookId($id);

            return $book;
        } else {
            throw new NotFoundHttpException('Sorry, but the requested page does not exist!');
        }
    }

    public function getAllBooksByAuthorID($id, $pages, $sort, $ord) {
        if($data = self::dao()->findAllBooksByAuthorID($id, $pages, $sort, $ord)) {

            foreach ($data as $row) {

                $book = new BookModel();
                $book->id = $row['book_id'];
                $book->title = $row['title'];
                $book->description = mb_substr($row['description'], 0, mb_strrpos(mb_substr($row['description'],
                        0, 500, 'utf-8'), ' ', 'utf-8'), 'utf-8') . ' ...';

                $book->authors = self::authorServices()->getAuthorsByBookID($row['book_id']);
                $book->img = self::imgServices()->getImageByBookId($row['book_id']);

                $books[] = $book;
            }
            return $books;
        } else {
            return array();
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

    public function getYearOfFirstBookByAuthorId($id)
    {
        if($row = self::dao()->findYearOfFirstBookByAuthorId($id)) {
            return $row['year'];
        } else {
            return "";
        }
    }

    public function getYearOfLastBookByAuthorId($id)
    {
        if($row = self::dao()->findYearOfLastBookByAuthorId($id)) {
            return $row['year'];
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
}
?>