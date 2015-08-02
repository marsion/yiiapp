<?php

namespace app\dao;

use yii\db\Query;

class ImgDAO
{

    public function findImageSrcByAuthorID($id)
    {
        return (new Query())
            ->select('src')
            ->from('tbl_img_authors')
            ->where('author_id = :author_id')
            ->addParams([':author_id' => $id])
            ->limit(1)
            ->one();
    }

    public function findImageSrcByBookID($id)
    {
        return (new Query())
            ->select('src')
            ->from('tbl_img_books')
            ->where('book_id = :book_id')
            ->addParams([':book_id' => $id])
            ->limit(1)
            ->one();
    }
}