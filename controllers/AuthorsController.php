<?php

namespace app\controllers;

use yii\web\Controller;
use app\services\AuthorServices;
use yii\data\Pagination;
use Yii;

class AuthorsController extends Controller {

    public function actionList()
    {
        $pages = new Pagination(['totalCount' => (new AuthorServices())->getAuthorsCount(),
            'defaultPageSize' => 3,
            'pageSize' => Yii::$app->getRequest()->getQueryParam('per')
        ]);
        $pages->pageSizeParam = false;

        $authors = (new AuthorServices())->getAllAuthors($pages);
        return $this->render('list', ['authors' => $authors, 'pages' => $pages]);
    }

    public function actionSingle($id)
    {
        $author = (new AuthorServices())->getAuthorByID($id);
        return $this->render('single', array('id' => $id, 'author' => $author));
    }
}
?>