<?php

namespace app\services;

use app\models\AuthorModel;
use app\dao\AuthorsDAO;
use app\services\BookServices;
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

    protected function bookServices()
    {
        return new BookServices();
    }

    protected function publishingHouseServices()
    {
        return new PublishingHouseServices();
    }

    protected function genreServices()
    {
        return new GenreServices();
    }

    public function getAllAuthors($pages, $sort, $ord, $c, $byear, $byeq, $dyear, $dyeq)
    {
        if($data = self::dao()->findAllAuthors($pages, $sort, $ord, $c, $byear, $byeq, $dyear, $dyeq)) {
            foreach ($data as $row) {
                $author = new AuthorModel();
                $author->id = $row['author_id'];
                $author->fullName = $row['full_name'];
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
            $author->yearFirstBook = self::bookServices()->getYearOfFirstBookByAuthorId($id);
            $author->yearLastBook = self::bookServices()->getYearOfLastBookByAuthorId($id);
            $author->bookAmount = self::bookServices()->getBookAmountByAuthorId($id);
            $author->countryName = self::countryServices()->getCountryNameById($data['country']);
            $author->countryISO = self::countryServices()->getCountryISOById($data['country']);
            $author->img = self::imgServices()->getImageByAuthorId($id);
            $author->publishingHouses = self::publishingHouseServices()->getAllPublishingHousesByAuthorId($id);
            $author->genres = self::genreServices()->getAllGenresOfAuthorById($id);

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
            return "";
        }
    }

    public function getAuthorsCountByParams($c, $byear, $byeq, $dyear, $dyeq)
    {
        return self::dao()->findAuthorsCountByParams($c, $byear, $byeq, $dyear, $dyeq);
    }
}

?>