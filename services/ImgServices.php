<?php

namespace app\services;

use app\dao\ImgDAO;

class ImgServices
{
    protected function dao()
    {
        return new ImgDAO();
    }

    public function getImageByAuthorId($id)
    {
        $result = self::dao()->findImageSrcByAuthorID($id);
        if ($result) {
            return $result['src'];
        }
        return '/css/images/authors/no-image.png';
    }

    public function getImageByBookId($id)
    {
        $result = self::dao()->findImageSrcByBookID($id);
        if ($result) {
            return $result['src'];
        }
        return '/css/images/authors/no-image.png';
    }
}