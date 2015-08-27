<?php

namespace app\dao;

use yii\db\Query;

class BooksDAO
{
    public function findAllBooks($pages, $sort, $ord, $country) {
        if ($sort == 'title') {
            ($ord == 'asc') ? $sortBy = 'title asc' : $sortBy = 'title desc';
        } elseif ($sort == 'author') {
            ($ord == 'asc') ? $sortBy = 'author asc' : $sortBy = 'author desc';
        } elseif ($sort == 'country') {
            ($ord == 'asc') ? $sortBy = 'c.name asc' : $sortBy = 'c.name desc';
        } else {
            $sortBy = 'title asc';
        }

        $country != null ? $countryName = "c.iso = '" . $country . "'" : $countryName = 1;

        return $data = (new Query())
            ->select('book_id, title')
            ->from('tbl_books as b')
            ->offset($pages->offset)
            ->limit($pages->limit)
            ->orderBy($sortBy)
            ->all();
    }

    public function findBookByID($id) {
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

    public function findBooksCountByCountry($country)
    {
        $country != null ? $countryName = "c.iso = '" . $country . "'" : $countryName = 1;

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

    public function findYearOfFirstBookByAuthorId($id)
    {
        return (new Query())
            ->select('year')
            ->from('tbl_books as b')
            ->join('JOIN', 'tbl_book_author as ab', 'b.book_id = ab.book_id')
            ->where('ab.author_id = :id')
            ->addParams([':id' => $id])
            ->orderBy('year ASC')
            ->one();
    }

    public function findYearOfLastBookByAuthorId($id)
    {
        return (new Query())
            ->select('year')
            ->from('tbl_books as b')
            ->join('JOIN', 'tbl_book_author as ab', 'b.book_id = ab.book_id')
            ->where('ab.author_id = :id')
            ->addParams([':id' => $id])
            ->orderBy('year DESC')
            ->one();
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