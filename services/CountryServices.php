<?php

namespace app\services;

use app\dao\CountryDAO;
use app\models\CountryModel;
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

    public function getFilterOptionsCountries($c)
    {
        if ($data = self::dao()->findFilterOptionsCountries($c)) {
            foreach ($data as $row) {
                $country = new CountryModel();
                $country->id = $row['id'];
                $country->name = $row['name'];

                $countries[] = $country;
            }
            return $countries;
        } else {
            return array();
        }
    }
}
?>