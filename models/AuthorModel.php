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
    public $bio;
    public $img;
    public $rating;
}
?>