<?php
namespace app\models;

use yii\db\ActiveRecord;

class Book extends ActiveRecord {

    public static function getTableName() {
        return 'book';
    }

    public function attributeLabels() {
        return [
            'id' => 'ID',
            'title' => 'Title',
            'author' => 'Author',
            'description' => 'Description',
        ];
    }

    public function rules() {
        return [
            [['title', 'author', 'description'], 'required'],
            [['title', 'description'], 'string'],
            [['author'], 'integer'],
        ];
    }
}
?>