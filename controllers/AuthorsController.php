<?php

namespace app\controllers;

use yii\web\Controller;

class AuthorsController extends Controller {

    public function actionList()
    {
        return $this->render('list');
    }

    public function actionSingle($id)
    {
        return $this->render('single', ['id' => $id]);
    }
}
?>