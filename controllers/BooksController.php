<?php
namespace app\controllers;

use \Yii;
use \yii\db;
use yii\web\Controller;
use app\services\BookServices;
use yii\data\Pagination;

class BooksController extends Controller {

    public function actionList()
    {
        $pages = new Pagination(['totalCount' => (new BookServices())->getBooksCount(),
            'defaultPageSize' => 2,
            'pageSize' => Yii::$app->getRequest()->getQueryParam('per')
        ]);
        $pages->pageSizeParam = false;
        $books = (new BookServices())->getAllBooks($pages);
        return $this->render('list', ['books' => $books, 'pages' => $pages]);
    }

    public function actionSingle($id)
    {
        $book = (new BookServices())->getBookByID($id);
        return $this->render('single', array('id' => $id, 'book' => $book));
    }


}
?>