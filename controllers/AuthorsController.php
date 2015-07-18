<?php

namespace app\controllers;

use yii\web\Controller;
use app\services\AuthorServices;
use app\dao\AuthorDAO;
use yii\data\Pagination;
use Yii;

class AuthorsController extends Controller {

    public function actionList($sort = null, $ord = null, $c = null, $per = null)
    {
        $pages = self::paginate($sort, $ord, $c, $per);
        $countryOptions = self::services()->getFilterOptionsCountries();
        $authorModels = self::services()->getAllAuthors($pages, $sort, $ord, $c);
        return $this->render('list', ['authors' => $authorModels, 'pages' => $pages, 'countryOptions' => $countryOptions]);
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
            'defaultPageSize' => 10,
        ]);
        $pagination->pageSizeParam = false;
        return $pagination;
    }
}
?>