<?php

namespace app\services;

use app\dao\PublishingHouseDAO;
use app\models\PublishingHouseModel;
use yii\web\NotFoundHttpException;

class PublishingHouseServices
{
    protected function dao()
    {
        return new PublishingHouseDAO();
    }

    public function getAllPublishingHousesByAuthorId($id)
    {
        if ($data = self::dao()->findAllPublishingHousesByAuthorId($id)) {

            foreach ($data as $row) {
                $publishingHouse = new PublishingHouseModel();
                $publishingHouse->id = $row['ph_id'];
                $publishingHouse->name = $row['name'];
                $publishingHouses[] = $publishingHouse;
            }
            return $publishingHouses;
        } else {
            return array();
        }
    }

    public function getPublishingHouseById($id)
    {
        if ($row = self::dao()->findPublishingHouseById($id)) {
            $publishingHouse = new PublishingHouseModel();
            $publishingHouse->id = $row['ph_id'];
            $publishingHouse->name = $row['name'];
            return $publishingHouse;
        } else {
            return array();
        }
    }
}

?>