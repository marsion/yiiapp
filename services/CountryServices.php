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

    public function getCountryISOById($id)
    {
        $row = self::dao()->findCountryISOById($id);
        return $row['iso'];
    }

    protected function dao(){
        return new CountryDAO();
    }

    public function getCountryIdByISO($iso)
    {
        $row = self::dao()->findCountryRowByISO($iso);
        return $row['id'];
    }

    public function getFilterOptionsCountries()
    {
        if($options = self::dao()->findFilterOptionsCountries()) {
            return $options;
        } else {
            return array();
        }
    }
}
?>