<?php
namespace app\controllers;

use \Yii;
use \yii\db;
use yii\web\Controller;
use app\services\BookServices;
use app\services\GenreServices;
use app\services\CountryServices;
use yii\data\Pagination;

class BooksController extends Controller {

    public function actionList($sort = null, $ord = null, $c = null, $per = null)
    {
        $pages = self::paginate($c, $per);
        $countryOptions = self::countryServices()->getFilterOptionsCountries();
        $genreOptions = self::genreServices()->getFilterOptionsGenres();

        $books = self::services()->getAllBooks($pages, $sort, $ord, $c);
        return $this->render('list', ['books' => $books, 'pages' => $pages,
            'countryOptions' => $countryOptions, 'genreOptions' => $genreOptions, 'genres' => $genreOptions]);
    }

    public function actionSingle($id)
    {
        $book = self::services()->getBookByID($id);
        $genres = self::genreServices()->getFilterOptionsGenres();
        return $this->render('single', array('book' => $book, 'genres' => $genres));
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

    protected function paginate($country, $per){
        $pagination = new Pagination(['totalCount' => self::services()->getBooksCountByCountry($country),
            'pageSize' => $per,
            'defaultPageSize' => 30,
        ]);
        $pagination->pageSizeParam = false;
        return $pagination;
    }
}
?>