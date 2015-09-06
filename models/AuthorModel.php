<?php

namespace app\models;

use yii\base\Model;

class AuthorModel extends Model {

    public $id;
    public $fullName;
    public $birthYear;
    public $deathYear;
    public $countryId;
    public $countryName;
    public $countryISO;
    public $bio;
    public $img;
    public $rating;
    public $yearFirstBook;
    public $yearLastBook;
    public $bookAmount;
    public $publishingHouses;
    public $genres;
}
?>