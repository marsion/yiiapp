<?php

namespace app\services;

use app\models\AuthorModel;
use app\dao\AuthorsDAO;
use yii\web\NotFoundHttpException;

class AuthorServices
{
    protected function dao()
    {
        return new AuthorsDAO();
    }

    protected function countryServices()
    {
        return new CountryServices();
    }

    protected function imgServices()
    {
        return new ImgServices();
    }

    public function getAllAuthors($pages, $sort, $ord, $country)
    {
        if($data = self::dao()->findAllAuthors($pages, $sort, $ord, $country)) {
            foreach ($data as $row) {
                $author = new AuthorModel();
                $author->id = $row['author_id'];
                $author->fullName = $row['full_name'];
                $author->birthYear = $row['birth_year'];
                $author->deathYear = $row['death_year'];
                $author->countryId = $row['country'];
                $author->countryName = $row['name'];
                $author->bio = mb_substr($row['bio'], 0, mb_strrpos(mb_substr($row['bio'],
                        0, 500, 'utf-8'), ' ', 'utf-8'), 'utf-8') . ' ...';
                $author->rating = $row['rating'];
                $author->img = self::imgServices()->getImageByAuthorId($row['author_id']);

                $authors[] = $author;
            }

            return $authors;
        } else {
            return array();
        }
    }

    public function getAuthorByID($id)
    {
        if($data = self::dao()->findAuthorById($id)) {
            $author = new AuthorModel();
            $author->id = $data['author_id'];
            $author->fullName = $data['full_name'];
            $author->birthYear = $data['birth_year'];
            $author->deathYear = $data['death_year'];
            $author->countryId = $data['country'];
            $author->bio = $data['bio'];
            $author->rating = $data['rating'];
            $author->countryName = self::countryServices()->getCountryNameById($data['country']);
            $author->img = self::imgServices()->getImageByAuthorId($data['author_id']);

            return $author;
        } else {
            throw new NotFoundHttpException('Sorry, but there is no author with such ID!');
        }
    }

    public function getAuthorsByBookID($id) {
        if($data = self::dao()->findAuthorsByBookID($id)) {
            foreach ($data as $row) {
                $author = new AuthorModel();
                $author->id = $row['author_id'];
                $author->fullName = $row['full_name'];
                $author->birthYear = $row['birth_year'];
                $author->deathYear = $row['death_year'];
                $author->countryId = $row['country'];
                $author->rating = $row['rating'];
                $author->bio = mb_substr($row['bio'], 0, mb_strrpos(mb_substr($row['bio'],
                        0, 500, 'utf-8'), ' ', 'utf-8'), 'utf-8') . ' ...';

                $author->countryName = self::countryServices()->getCountryNameById($row['country']);
                $author->img = self::imgServices()->getImageByAuthorId($row['author_id']);

                $authors[] = $author;
            }

            return $authors;
        } else {
            return array();
        }
    }

    public function getAuthorNameByID($id)
    {
        if($data = self::dao()->findAuthorById($id)) {
            return $data['full_name'];
        } else {
            throw new NotFoundHttpException('Sorry, but there is no author with such ID!');
        }
    }

    public function getAuthorsCountByCountryId($country)
    {
        $countryId = self::countryServices()->getCountryIdByISO($country);
        return self::dao()->findAuthorsCountByCountryId($countryId);
    }
}

?>