<?php
namespace app\controllers;

use \Yii;
use \yii\db;
use yii\web\Controller;
use app\services\BookServices;
use yii\data\Pagination;
use yii\web\NotFoundHttpException;

class BooksController extends Controller {

    public function actionList($sort = null, $ord = null, $c = null, $per = null)
    {
        $pages = self::paginate($sort, $ord, $c, $per);
        $countryOptions = self::services()->getFilterOptionsCountries();

        if(($books = self::services()->getAllBooks($pages, $sort, $ord, $c)) != null) {
            return $this->render('list', ['books' => $books, 'pages' => $pages, 'countryOptions' => $countryOptions]);
        } else {
            throw new NotFoundHttpException('Sorry, but the requested page does not exist!');
        }
    }

    public function actionSingle($id)
    {
        if(($book = self::services()->getBookByID($id)) != null) {
            return $this->render('single', array('book' => $book));
        }else {
            throw new NotFoundHttpException('Sorry, but the requested page does not exist!');
        }
    }

    protected function services(){
        return new BookServices();
    }

    protected function paginate($country, $per){
        $pagination = new Pagination(['totalCount' => self::services()->getBooksCountByCountry($country),
            'pageSize' => $per,
            'defaultPageSize' => 18,
        ]);
        $pagination->pageSizeParam = false;
        return $pagination;
    }
}
?>