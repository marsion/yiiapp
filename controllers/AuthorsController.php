<?php

namespace app\controllers;

use yii\web\Controller;

class AuthorsController extends Controller {

    public function actionIndex(){
        return $this->render('index');
    }

    public function actionAuthor($id) {
        return $this->render('author', ['id' => $id]);
    }
}
?>