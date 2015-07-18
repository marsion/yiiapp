<?php
namespace app\controllers;

use \Yii;
use \yii\db;
use yii\web\Controller;
use app\services\BookServices;
use yii\data\Pagination;

class BooksController extends Controller {

    public function actionList($sort = null, $ord = null, $c = null, $per = null)
    {
        $pages = self::paginate($sort, $ord, $c, $per);
        $countryOptions = self::services()->getFilterOptionsCountries();
        $books = (new BookServices())->getAllBooks($pages, $sort, $ord, $c);
        return $this->render('list', ['books' => $books, 'pages' => $pages, 'countryOptions' => $countryOptions]);
    }

    public function actionSingle($id)
    {
        $book = (new BookServices())->getBookByID($id);
        return $this->render('single', array('book' => $book));
    }

    protected function services(){
        return new BookServices();
    }

    protected function paginate($sort, $ord, $country, $per){
        $pagination = new Pagination(['totalCount' => self::services()->getBooksCount($sort, $ord, $country),
            'pageSize' => $per,
            'defaultPageSize' => 10,
        ]);
        $pagination->pageSizeParam = false;
        return $pagination;
    }
}
?>