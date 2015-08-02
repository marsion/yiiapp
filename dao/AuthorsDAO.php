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
        if ($sort == 'fname') {
            ($ord == 'asc') ? $sortBy = 'first_name asc' : $sortBy = 'first_name desc';
        } elseif ($sort == 'lname') {
            ($ord == 'asc') ? $sortBy = 'last_name asc' : $sortBy = 'last_name desc';
        } elseif ($sort == 'rating') {
            ($ord == 'asc') ? $sortBy = 'rating asc' : $sortBy = 'rating desc';
        } elseif ($sort == 'chron') {
            ($ord == 'asc') ? $sortBy = 'birth_year asc' : $sortBy = 'birth_year desc';
        } else {
            $sortBy = 'last_name asc';
        }

        $country != null ? $countryName = "c.iso = '" . $country . "'" : $countryName = 1;

        return (new Query())
            ->select('*')
            ->from('tbl_authors as a')
            ->join('JOIN', 'tbl_countries as c', 'a.country = c.id')
            ->where($countryName)
            ->offset($pages->offset)
            ->limit($pages->limit)
            ->orderBy($sortBy)
            ->all();
    }

    public function findAuthorsByBookID($id) {
        return (new Query())
            ->select('*')
            ->from('tbl_ab as ab')
            ->join('JOIN', 'tbl_authors as a', 'ab.author_id = a.author_id')
            ->where('book_id = :book_id')
            ->addParams([':book_id' => $id])
            ->all();
    }

    public function findFilterOptionsCountries()
    {
        return (new Query())
            ->select('c.iso AS value, c.name AS text')
            ->from('tbl_authors AS a')
            ->join('JOIN', 'tbl_countries AS c', 'a.country = c.id')
            ->groupBy('value')
            ->orderBy('text')
            ->all();
    }

    public function findAuthorsCountByCountry($country)
    {
        $country != null ? $countryName = "c.iso = '" . $country . "'" : $countryName = 1;

        return (new Query())
            ->select('*')
            ->from('tbl_authors as a')
            ->join('JOIN', 'tbl_countries as c', 'a.country = c.id')
            ->where($countryName)
            ->count();
    }

    public function findAuthorFullNameByID ($id) {
        return (new Query())
            ->select(["CONCAT(first_name, ' ', last_name) AS full_name"])
            ->from('tbl_authors')
            ->where('author_id = :author_id')
            ->addParams([':author_id' => $id])
            ->one();
    }
}

?>