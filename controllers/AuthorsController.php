<?php

namespace app\controllers;

use yii\web\Controller;
use app\services\AuthorServices;
use app\dao\AuthorDAO;
use yii\data\Pagination;
use Yii;

class AuthorsController extends Controller {

    public function actionList($sort = null, $ord =null, $country =null, $per =null)
    {
        $pages = self::paginate($sort, $ord, $country, $per);
        $authorModels = self::services()->getAllAuthors($pages, $sort, $ord, $country);
        return $this->render('list', ['authors' => $authorModels, 'pages' => $pages]);
    }

    public function actionSingle($id)
    {
        $authorModel = self::services()->getAuthorByID($id);
        return $this->render('single', array('id' => $id, 'author' => $authorModel));
    }

    protected function services(){
        return new AuthorServices();
    }

    protected function paginate($sort, $ord, $country, $per){
        $pagination = new Pagination(['totalCount' => self::services()->getAuthorsCount($sort, $ord, $country),
            'pageSize' => $per,
            'defaultPageSize' => 2,
        ]);
        $pagination->pageSizeParam = false;
        return $pagination;
    }
}
?>