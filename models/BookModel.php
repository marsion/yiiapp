<?php

namespace app\models;

use yii\base\Model;

class BookModel extends Model {

    public $id;
    public $title;
    public $authorId;
    public $authorFirstName;
    public $authorLastName;
    public $description;

}
?>