<?php

namespace app\services;

use app\models\CommentModel;
use app\dao\CommentDAO;

class CommentServices
{
    var $topicAuthor = 1;
    var $topicBook = 2;

    protected function dao()
    {
        return new CommentDAO();
    }

    public function getAuthorCommentsCount($id)
    {
        return self::dao()->getCommentsCount($this->topicAuthor, $id);
    }

    public function getBookCommentsCount($id)
    {
        return self::dao()->getCommentsCount($this->topicBook, $id);
    }

    private function findComments($pages, $topic, $id) {
        if($data = self::dao()->getComments($pages, $topic, $id)) {
            foreach ($data as $row) {
                $comment = new CommentModel();
                $comment->id = $row['comment_id'];
                $comment->parentId = $row['parent_id'];
                $comment->topic = $row['topic'];
                $comment->user = $row['user_id'];
                $comment->text = $row['text'];
                $comment->createdAt = $row['created_at'];
                $comment->updatedAt = $row['updated_at'];
                $comments[] = $comment;
            }
            return $comments;
        } else {
            return array();
        }
    }

    function findCommentsForAuthor($pages, $id) {
        return self::findComments($pages, $this->topicAuthor, $id);
    }

    function findCommentsForBook($pages, $id) {
        return self::findComments($pages, $this->topicBook, $id);
    }
}