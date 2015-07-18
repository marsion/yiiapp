<?php

namespace app\services;

use yii\db\Query;
use app\models\AuthorModel;
use app\dao\AuthorsDAO;

class AuthorServices
{

    public function getAuthorsCount($sort, $ord, $country)
    {
        if ($sort == 'fname') {
            $sortBy = 'first_name';
        } elseif ($sort == 'lname') {
            $sortBy = 'last_name';
        } elseif ($sort == 'country') {
            $sortBy = 'c.name';
        } else {
            $sortBy = 'first_name';
        }

        $country != null ? $countryname = "c.iso = '" . $country . "'" : $countryname = 1;

        return (new Query())
        ->select('*')
        ->from('tbl_authors as a')
        ->join('JOIN', 'tbl_countries as c', 'a.country = c.id')
        ->where($countryname)
        ->orderBy($sortBy)
        ->count();
    }

    public function getAllAuthors($pages, $sort, $ord, $country)
    {
        if ($sort == 'fname') {
            ($ord == 'asc') ? $sortBy = 'first_name asc' : $sortBy = 'first_name desc';
        } elseif ($sort == 'lname') {
            ($ord == 'asc') ? $sortBy = 'last_name asc' : $sortBy = 'last_name desc';
        } else {
            $sortBy = 'first_name asc';
        }

        $country != null ? $countryname = "c.iso = '" . $country . "'" : $countryname = 1;

        $data = (new Query())
        ->select('*')
        ->from('tbl_authors as a')
        ->join('JOIN', 'tbl_countries as c', 'a.country = c.id')
        ->join('JOIN', 'tbl_img_authors as aimg', 'a.author_id = aimg.author_id')
        ->where($countryname)
        ->offset($pages->offset)
        ->limit($pages->limit)
        ->orderBy($sortBy)
        ->all();

        foreach ($data as $row) {
            $author = new AuthorModel();
            $author->id = $row['author_id'];
            $author->firstName = $row['first_name'];
            $author->lastName = $row['last_name'];
            $author->originalFirstName = $row['original_first_name'];
            $author->originalLastName = $row['original_last_name'];
            $author->birthYear = $row['birth_year'];
            $author->deathYear = $row['death_year'];
            $author->countryId = $row['country'];
            $author->countryName = $row['name'];
            $author->bio = mb_substr($row['bio'], 0, mb_strrpos(mb_substr($row['bio'],
                    0, 500, 'utf-8'), ' ', 'utf-8'), 'utf-8') . ' ...';
            $author->img = $row['src'];

            $authors[] = $author;
        }

        return $authors;
    }

    public function getAuthorByID($id)
    {
        $data = self::dao()->getRowById($id);
        $country = self::countryServices()->getCountryNameById($data['country']);

        $author = new AuthorModel();
        $author->id = $data['author_id'];
        $author->firstName = $data['first_name'];
        $author->lastName = $data['last_name'];
        $author->originalFirstName = $data['original_first_name'];
        $author->originalLastName = $data['original_last_name'];
        $author->birthYear = $data['birth_year'];
        $author->deathYear = $data['death_year'];
        $author->countryId = $data['country'];
        $author->countryName = $country;
        $author->bio = $data['bio'];
        $author->img = $data['src'];

        return $author;
    }

    public function getFilterOptionsCountries() {
        return self::dao()->findFilterOptionsCountries();
    }

    protected function dao()
    {
        return new AuthorsDAO();
    }

    protected function countryServices()
    {
        return new CountryServices();
    }
}

?>