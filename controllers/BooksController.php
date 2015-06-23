<?php
namespace app\controllers;

use yii\web\Controller;

class BooksController extends Controller {

    public function actionIndex() {
        return $this->render('index');
    }

    public function actionBook($id) {
        if($id == 5)
            return $this->render('book', ['id' => $id]);
        else
            return $this->redirect(array('books/'));
    }
}
?>