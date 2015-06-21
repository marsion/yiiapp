<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%book}}".
 *
 * @property integer $id
 * @property string $title
 * @property integer $author
 * @property string $description
 */
class Book extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%book}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title', 'author', 'description'], 'required'],
            [['title', 'description'], 'string'],
            [['author'], 'integer']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'title' => Yii::t('app', 'Title'),
            'author' => Yii::t('app', 'Author'),
            'description' => Yii::t('app', 'Description'),
        ];
    }
}
