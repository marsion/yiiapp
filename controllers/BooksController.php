<?php
namespace app\controllers;

use \Yii;
use \yii\db;
use yii\web\Controller;
use yii\db\Query;

class BooksController extends Controller {

    public function actionList()
    {
        $data = (new Query())
        ->select('*')
        ->from('tbl_book')
        ->all();

        return $this->render('list', array('data' => $data));
    }

    public function actionSingle($id) {
//        $query = "select * from `tbl_book` WHERE `id` = ".$id;
//        $data = Yii::$app->db->createCommand($query)->query();

        $data = (new Query())
            ->select('*')
            ->from('tbl_book')
            ->where('id = :id')
            ->addParams([':id' => $id])
            ->limit(1)
            ->one();
        return $this->render('single', array('id' => $id, 'data' => $data));
    }


}
?>