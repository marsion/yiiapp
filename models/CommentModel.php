<?php
/**
 * Created by IntelliJ IDEA.
 * User: kshukost
 * Date: 10.10.15
 * Time: 15:10
 */

namespace app\models;

use yii\base\Model;

class CommentModel extends Model {

    public $id;
    public $parentId;
    public $topic;
    public $user;
    public $text;
    public $createdAt;
    public $updatedAt;

}