<?php
namespace app\controllers;

use \Yii;
use \yii\db;
use yii\web\Controller;
use app\services\BookServices;

class BooksController extends Controller {

    public function actionList()
    {
        $books = (new BookServices())->getAllBooks();
        return $this->render('list', array('books' => $books));
    }

    public function actionSingle($id)
    {
        $book = (new BookServices())->getBookByID($id);
        return $this->render('single', array('id' => $id, 'book' => $book));
    }


}
?>