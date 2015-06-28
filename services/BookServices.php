<?php

namespace app\services;

use yii\db\Query;
use app\models;
use app\models\BookModel;

class BookServices {

    public function getAllBooks()
    {
        $query = new Query();

        $data = $query
        ->select('*')
        ->from('tbl_books')
        ->all();

        foreach($data as $row)
        {
            $dataAuthor = (new AuthorServices())->getAuthorByID($row['author']);

            $book = new BookModel();
            $book->id = $row['id'];
            $book->title = $row['title'];
            $book->description = mb_substr($row['description'],0,mb_strrpos(mb_substr($row['description'],0,500,'utf-8'),' ','utf-8'),'utf-8').' ...';
            $book->authorId = $row['author'];
            $book->authorFirstName = $dataAuthor->firstName;
            $book->authorLastName = $dataAuthor->lastName;

            $books[] = $book;
        }
        return $books;
    }

    public function getBookByID($id)
    {
        $data = (new Query())
        ->select('*')
        ->from('tbl_books')
        ->where('id = :id')
        ->addParams([':id' => $id])
        ->limit(1)
        ->one();

        $dataAuthor = (new AuthorServices())->getAuthorByID($data['author']);

        $book = new BookModel();
        $book->id = $data['id'];
        $book->title = $data['title'];
        $book->description = $data['description'];
        $book->authorId = $data['author'];
        $book->authorFirstName = $dataAuthor->firstName;
        $book->authorLastName = $dataAuthor->lastName;

        return $book;
    }
}
?>