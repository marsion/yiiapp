<?php

namespace app\services;

use yii\db\Query;
use app\models;
use app\models\BookModel;
use app\dao\BooksDAO;

class BookServices {

    protected function dao()
    {
        return new BooksDAO();
    }

    public function getBooksCount($sort, $ord, $country)
    {
        $count = (new Query())
        ->select('*')
        ->from('tbl_books')
        ->count();

        return $count;
    }

    public function getAllBooks($pages, $sort, $ord, $country)
    {
        if ($sort == 'title') {
            ($ord == 'asc') ? $sortBy = 'title asc' : $sortBy = 'title desc';
        } elseif ($sort == 'author') {
            ($ord == 'asc') ? $sortBy = 'author asc' : $sortBy = 'author desc';
        } elseif ($sort == 'country') {
            ($ord == 'asc') ? $sortBy = 'c.name asc' : $sortBy = 'c.name desc';
        } else {
            $sortBy = 'title asc';
        }

        $country != null ? $countryname = "c.iso = '" . $country . "'" : $countryname = 1;

        $data = (new Query())
        ->select('*')
        ->from('tbl_books as b')
        ->join('LEFT JOIN', 'tbl_img_books as bimg', 'b.id = bimg.book_id')
        ->offset($pages->offset)
        ->limit($pages->limit)
        ->orderBy($sortBy)
        ->all();



        foreach($data as $row)
        {
            $authors = (new Query())
            ->select('*')
            ->from('tbl_books as b')
            ->join('JOIN', 'tbl_ab as ab', 'b.id = ab.book_id')
            ->join('JOIN', 'tbl_authors as a', 'ab.author_id = a.author_id')
            ->where('id = :id')
            ->addParams([':id' => $row['id']])
            ->all();

            $book = new BookModel();
            $book->id = $row['id'];
            $book->title = $row['title'];
            $book->description = mb_substr($row['description'],0,mb_strrpos(mb_substr($row['description'],
                    0,500,'utf-8'),' ','utf-8'),'utf-8').' ...';
            $book->authors = $authors;
            $book->img = $row['src'];

            $books[] = $book;
        }
        return $books;
    }

    public function getBookByID($id)
    {
        $data = (new Query())
        ->select('*')
        ->from('tbl_books as b')
        ->where('id = :id')
        ->addParams([':id' => $id])
        ->limit(1)
        ->one();

        $images = (new Query())
        ->select('*')
        ->from('tbl_img_books')
        ->where('book_id = :book_id')
        ->addParams([':book_id' => $id])
        ->limit(1)
        ->one();

        $authors = (new Query())
        ->select('*')
        ->from('tbl_books as b')
        ->join('JOIN', 'tbl_ab as ab', 'b.id = ab.book_id')
        ->join('JOIN', 'tbl_authors as a', 'ab.author_id = a.author_id')
        ->where('id = :id')
        ->addParams([':id' => $id])
        ->all();

        $book = new BookModel();
        $book->id = $data['id'];
        $book->title = $data['title'];
        $book->description = $data['description'];
        $book->authors = $authors;
//        $book->authorFirstName = $authors;
//        $book->authorLastName = $dataAuthor->lastName;
        $book->img = $images['src'];

        return $book;
    }

    public function getFilterOptionsCountries() {
        return self::dao()->findFilterOptionsCountries();
    }

}
?>