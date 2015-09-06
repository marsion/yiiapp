<?php

namespace app\dao;

use yii\db\Query;

class PublishingHouseDAO
{
    public function findAllPublishingHousesByAuthorId($id)
    {
        return (new Query())
            ->select('ph.ph_id, name')
            ->distinct()
            ->from('tbl_publishing_houses as ph')
            ->join('JOIN', 'tbl_books as b', 'ph.ph_id = b.ph_id')
            ->join('JOIN', 'tbl_book_author as ba', 'ba.book_id = b.book_id')
            ->where('ba.author_id = :author_id')
            ->addParams([':author_id' => $id])
            ->all();
    }

    public function findPublishingHouseById($id)
    {
        return (new Query())
            ->select('ph_id, name')
            ->from('tbl_publishing_houses as ph')
            ->where('ph_id = :id')
            ->addParams([':id' => $id])
            ->one();
    }
}

?>