<?php

namespace app\dao;

use Yii;
use yii\db\Query;

class CommentDAO
{

    function getCommentsCount($topic, $id)
    {
        $sql = "SELECT COUNT(*) AS `count` FROM `tbl_comments` WHERE `topic` = :topic AND `topic_id` = :id ";
        $data = Yii::$app->db->createCommand($sql)->bindValue(':topic', $topic)->bindValue(':id', $id)->queryOne();
        return $data['count'];
    }

    function getComments($pages, $topic, $id)
    {
        $sql = "SELECT `comment_id`, `parent_id`, `topic`, `topic_id`, `user_id`, `text`, `created_at`, `updated_at` FROM `tbl_comments` WHERE `topic` = :topic AND `topic_id` = :id LIMIT :limit OFFSET :offset ";
        return Yii::$app->db->createCommand($sql)
        ->bindValue(':topic', $topic)
        ->bindValue(':id', $id)
        ->bindValue(':limit', $pages->limit)
        ->bindValue(':offset', $pages->offset)
        ->queryAll();
    }
}