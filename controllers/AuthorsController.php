<?php

namespace app\controllers;


use yii\web\Controller;
use app\services\AuthorServices;
use app\services\BookServices;
use app\services\GenreServices;
use app\services\CountryServices;
use yii\data\Pagination;
use Yii;

class AuthorsController extends Controller
{

    public function actionList($sort = null, $ord = null, $c = null, $g = null, $per = null)
    {
        $pages = self::paginate($c, $per);
        $countryOptions = self::countryServices()->getFilterOptionsCountries();

        $authorModels = self::services()->getAllAuthors($pages, $sort, $ord, $c);
        return $this->render('list', ['authors' => $authorModels,
            'pages' => $pages,
            'countryOptions' => $countryOptions]);
    }

    public function actionSingle($id)
    {
        $authorModel = self::services()->getAuthorByID($id);
        $popularBooks = self::bookServices()->getMostPopularBooksByAuthorID($id, 6);
        $genres = self::genreServices()->getFilterOptionsGenres();
        return $this->render('single', array('id' => $id, 'author' => $authorModel, 'genres' => $genres,
            'popularBooks' => $popularBooks));
    }

    public function actionBooks($id, $sort = null, $ord = null, $per = null)
    {
        $pages = self::paginateByAuthorId($id, $per);
        $author = self::services()->getAuthorForAllHisBooks($id);
        $genres = self::genreServices()->getFilterOptionsGenres();
        $bookModels = (new BookServices())->getAllBooksByAuthorID($id, $pages, $sort, $ord);
        return $this->render('books', ['books' => $bookModels, 'pages' => $pages,
            'author' => $author, 'genres' => $genres]);
    }

    protected function services()
    {
        return new AuthorServices();
    }

    protected function bookServices()
    {
        return new BookServices();
    }

    protected function countryServices()
    {
        return new CountryServices();
    }

    protected function genreServices()
    {
        return new GenreServices();
    }

    protected function paginate($country, $per)
    {
        $pagination = new Pagination(['totalCount' =>
            self::services()->getAuthorsCountByCountryId($country),
            'pageSize' => $per,
            'defaultPageSize' => 30,
        ]);
        $pagination->pageSizeParam = false;
        return $pagination;
    }

    protected function paginateByAuthorId($id, $per)
    {
        $pagination = new Pagination(['totalCount' => (new BookServices())->getBooksCountByAuthorId($id),
            'pageSize' => $per,
            'defaultPageSize' => 30,
        ]);
        $pagination->pageSizeParam = false;
        return $pagination;
    }
}

?>