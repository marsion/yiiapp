<?php

namespace app\models;

use yii\base\Model;

class BookModel extends Model {

    public $id;
    public $title;
    public $description;
    public $img;
    public $authors;
    public $rating;
    public $pages;
    public $isbn;
    public $lang;
    public $origLang;
    public $year;
    public $translator;
    public $publishingHouse;
    public $series;
    public $genres;
}
?>