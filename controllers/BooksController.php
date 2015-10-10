<?php
namespace app\controllers;

use \Yii;
use \yii\db;
use yii\web\Controller;
use app\services\BookServices;
use app\services\GenreServices;
use app\services\CountryServices;
use app\services\LanguageServices;
use app\services\CommentServices;
use yii\data\Pagination;

class BooksController extends Controller
{

    public function actionList()
    {
        $sort = Yii::$app->request->get('sort', null);
        $ord = Yii::$app->request->get('ord', null);
        $per = Yii::$app->request->get('per', null);
        $a = Yii::$app->request->get('a', array());
        $c = Yii::$app->request->get('c', array());
        $ph = Yii::$app->request->get('ph', array());
        $g = Yii::$app->request->get('g', array());
        $lang = Yii::$app->request->get('lang', array());
        $langor = Yii::$app->request->get('langor', array());
        $year = Yii::$app->request->get('year', null);
        $yeq = Yii::$app->request->get('yeq', null);
        $ser = Yii::$app->request->get('ser', array());
        $trans = Yii::$app->request->get('trans', array());

        $pages = self::paginate($per, $a, $c, $ph, $g, $lang, $langor, $year, $yeq, $ser, $trans);
        $countryOptions = self::countryServices()->getFilterOptionsCountries($c);
        $langOptions = self::languageServices()->getFilterOptionsLanguages($lang);
        $langOrigOptions = self::languageServices()->getFilterOptionsLanguagesOrig($langor);
        $genres = self::genreServices()->getFilterOptionsGenres();

        $books = self::services()->getAllBooks($pages, $sort, $ord, $a, $c, $ph, $g,
            $lang, $langor, $year, $yeq, $ser, $trans);
        return $this->render('list', ['books' => $books, 'pages' => $pages,
            'countryOptions' => $countryOptions, 'langOptions' => $langOptions,
            'langOrigOptions' => $langOrigOptions, 'genres' => $genres]);
    }

    public function actionSingle($id)
    {
        $book = self::services()->getBookByID($id);
        $pages = self::paginateComments($id);
        $comments = self::commentServices()->findCommentsForBook($pages, $id);
        $genres = self::genreServices()->getFilterOptionsGenres();
        return $this->render('single', ['book' => $book, 'pages' => $pages, 'genres' => $genres,
            'comments' => $comments]);
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

    protected function commentServices()
    {
        return new CommentServices();
    }

    protected function paginate($per, $a, $c, $ph, $g, $lang, $langor, $year, $yeq, $ser, $trans)
    {
        $pagination = new Pagination(
            ['totalCount' => self::services()->getBooksCountByParams($a, $c, $ph, $g, $lang, $langor,
                $year, $yeq, $ser, $trans),
                'pageSize' => $per,
                'defaultPageSize' => 30,
            ]);
        $pagination->pageSizeParam = false;
        return $pagination;
    }

    protected function paginateComments($id)
    {
        $pagination = new Pagination(
            ['totalCount' => self::commentServices()->getBookCommentsCount($id),
                'defaultPageSize' => 2,
            ]);
        $pagination->pageSizeParam = false;
        return $pagination;
    }
}

?>