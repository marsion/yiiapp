<?php

namespace app\services;

use app\dao\SeriesDAO;
use app\models\SeriesModel;

class SeriesServices {

    protected function dao(){
        return new SeriesDAO();
    }

    public function getSeriesById($id)
    {
        if ($row = self::dao()->findSeriesById($id)) {
            $series = new SeriesModel();
            $series->id = $row['series_id'];
            $series->name = $row['name'];
            return $series;
        } else {
            return array();
        }
    }
}
?>