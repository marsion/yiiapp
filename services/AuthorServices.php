<?php

namespace app\services;

use yii\db\Query;
use app\models\AuthorModel;

class AuthorServices {

    public function getAuthorsCount()
    {
        $count = (new Query())
        ->select('*')
        ->from('tbl_authors')
        ->count();

        return $count;
    }

    public function getAllAuthors($pages)
    {
        $data = (new Query())
        ->select('*')
        ->from('tbl_authors')
        ->offset($pages->offset)
        ->limit($pages->limit)
        ->orderBy('first_name asc')
        ->all();

        foreach($data as $row)
        {
            $dataCountry = (new Query())
            ->select('*')
            ->from('tbl_countries')
            ->where('id = :country')
            ->addParams([':country' => $row['country']])
            ->limit(1)
            ->one();

            $author = new AuthorModel();
            $author->id = $row['id'];
            $author->firstName = $row['first_name'];
            $author->lastName = $row['last_name'];
            $author->birthYear = $row['birth_year'];
            $author->deathYear = $row['death_year'];
            $author->countryId = $row['country'];
            $author->countryName = $dataCountry['name'];
            $author->bio = mb_substr($row['bio'],0,mb_strrpos(mb_substr($row['bio'],0,500,'utf-8'),' ','utf-8'),'utf-8').' ...';

            $authors[] = $author;
        }

        return $authors;
    }

    public function getAuthorByID($id)
    {
        $data = (new Query())
            ->select('*')
            ->from('tbl_authors')
            ->where('id = :id')
            ->addParams([':id' => $id])
            ->limit(1)
            ->one();

        $dataCountry = (new Query())
            ->select('*')
            ->from('tbl_countries')
            ->where('id = :country')
            ->addParams([':country' => $data['country']])
            ->limit(1)
            ->one();

        $author = new AuthorModel();
        $author->id = $data['id'];
        $author->firstName = $data['first_name'];
        $author->lastName = $data['last_name'];
        $author->birthYear = $data['birth_year'];
        $author->deathYear = $data['death_year'];
        $author->countryId = $data['country'];
        $author->countryName = $dataCountry['name'];
        $author->bio = $data['bio'];

        return $author;
    }
}
?>