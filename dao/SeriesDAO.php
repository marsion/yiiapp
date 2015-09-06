<?php

namespace app\dao;

use yii\db\Query;

class SeriesDAO
{

    public function findSeriesById($id)
    {
        return (new Query())
        ->select('series_id, name')
        ->from('tbl_series')
        ->where('series_id = :id')
        ->addParams([':id' => $id])
        ->one();
    }
}

?>