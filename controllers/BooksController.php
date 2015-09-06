<?php
namespace app\controllers;

use \Yii;
use \yii\db;
use yii\web\Controller;
use app\services\BookServices;
use app\services\GenreServices;
use app\services\CountryServices;
use app\services\LanguageServices;
use yii\data\Pagination;

class BooksController extends Controller {

    public function actionList($sort = null, $ord = null, $per = null,
                               $c = null, $ph = null, $g = null, $l = null, $lo = null)
    {
        $pages = self::paginate($per, $c, $ph, $g, $l, $lo);
        $countryOptions = self::countryServices()->getFilterOptionsCountries();
        $langOptions = self::languageServices()->getFilterOptionsLanguages();
        $genres = self::genreServices()->getFilterOptionsGenres();

        $books = self::services()->getAllBooks($pages, $sort, $ord, $c, $ph, $g, $l, $lo);
        return $this->render('list', ['books' => $books, 'pages' => $pages,
            'countryOptions' => $countryOptions, 'langOptions' => $langOptions, 'genres' => $genres]);
    }

    public function actionSingle($id)
    {
        $book = self::services()->getBookByID($id);
        $genres = self::genreServices()->getFilterOptionsGenres();
        return $this->render('single', ['book' => $book, 'genres' => $genres]);
    }

    protected function services()
    {
        return new BookServices();
    }

    protected function genreServices()
    {
        return new GenreServices();
    }

    protected function countryServices()
    {
        return new CountryServices();
    }

    protected function languageServices()
    {
        return new LanguageServices();
    }

    protected function paginate($per, $c, $ph, $g, $l, $lo){
        $pagination = new Pagination(['totalCount' => self::services()->getBooksCountByParams($c, $ph, $g, $l, $lo),
            'pageSize' => $per,
            'defaultPageSize' => 30,
        ]);
        $pagination->pageSizeParam = false;
        return $pagination;
    }
}
?>