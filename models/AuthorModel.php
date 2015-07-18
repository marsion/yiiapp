<?php

namespace app\models;

use yii\base\Model;

class AuthorModel extends Model {

    public $id;
    public $firstName;
    public $lastName;
    public $originalFirstName;
    public $originalLastName;
    public $birthYear;
    public $deathYear;
    public $countryId;
    public $countryName;
    public $bio;
    public $img;
}
?>