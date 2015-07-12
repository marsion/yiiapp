<?php

namespace app\services;

use app\dao\CountryDAO;
use yii\db\Query;

class CountryServices {

    public function getCount()
    {
        return self::dao()->getCount();
    }

    public function getCountryNameById($id)
    {
        $row = self::dao()->getCountryNameById($id);
        return $row['name'];
    }

    protected function dao(){
        return new CountryDAO();
    }
}
?>