<?php

namespace app\dao;

use yii\db\Query;

class AuthorsDAO
{

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

    public function findAllAuthors($pages, $sort, $ord, $country)
    {
        if ($sort == 'name') {
            ($ord == 'asc') ? $sortBy = 'full_name asc' : $sortBy = 'full_name desc';
        } elseif ($sort == 'rating') {
            ($ord == 'asc') ? $sortBy = 'rating asc' : $sortBy = 'rating desc';
        } elseif ($sort == 'byear') {
            ($ord == 'asc') ? $sortBy = 'birth_year asc' : $sortBy = 'birth_year desc';
        } else {
            $sortBy = 'full_name asc';
        }

        $country != null ? $countryName = "c.iso = '" . $country . "'" : $countryName = 1;

        return (new Query())
            ->select('author_id, full_name')
            ->from('tbl_authors as a')
            ->join('LEFT JOIN', 'tbl_countries as c', 'a.country = c.id')
            ->where($countryName)
            ->offset($pages->offset)
            ->limit($pages->limit)
            ->orderBy($sortBy)
            ->all();
    }

    public function findAuthorForAllHisBooks($id)
    {
        return (new Query())
        ->select('author_id, full_name, country')
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



    public function findAuthorsCountByCountryId($countryId)
    {
        return $countryId != null ?

         (new Query())
            ->select('*')
            ->from('tbl_authors as a')
            ->where('country = :country')
            ->addParams([':country' => $countryId])
            ->count()
        :
         (new Query())
            ->select('*')
            ->from('tbl_authors as a')
            ->count();
    }
}

?>