<?php

namespace app\controllers;

use yii\web\Controller;
use app\services\AuthorServices;

class AuthorsController extends Controller {

    public function actionList()
    {
        $authors = (new AuthorServices())->getAllAuthors();
        return $this->render('list', array('authors' => $authors));
    }

    public function actionSingle($id)
    {
        $author = (new AuthorServices())->getAuthorByID($id);
        return $this->render('single', array('id' => $id, 'author' => $author));
    }
}
?>