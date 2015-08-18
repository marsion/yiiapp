<?php

namespace app\controllers;

use app\services\CountryServices;
use yii\web\Controller;
use app\services\AuthorServices;
use app\services\BookServices;
use app\services\GenreServices;
use yii\data\Pagination;
use Yii;

class AuthorsController extends Controller
{

    public function actionList($sort = null, $ord = null, $c = null, $g = null, $per = null)
    {
        $pages = self::paginate($c, $per);
        $countryOptions = self::countryServices()->getFilterOptionsCountries();
        $genres = self::genreServices()->getFilterOptionsGenres();

        $authorModels = self::services()->getAllAuthors($pages, $sort, $ord, $c);
        return $this->render('list', ['authors' => $authorModels,
            'pages' => $pages,
            'countryOptions' => $countryOptions, 'genres' => $genres]);
    }

    public function actionSingle($id)
    {
        $authorModel = self::services()->getAuthorByID($id);
        $genres = self::genreServices()->getFilterOptionsGenres();
        return $this->render('single', array('id' => $id, 'author' => $authorModel, 'genres' => $genres));
    }

    public function actionBooks($id, $sort = null, $ord = null, $per = null)
    {
        $pages = self::paginateByAuthorId($id, $per);
        $authorName = self::services()->getAuthorNameByID($id);
        $genres = self::genreServices()->getFilterOptionsGenres();
        $bookModels = (new BookServices())->getAllBooksByAuthorID($id, $pages, $sort, $ord);
        return $this->render('books', ['books' => $bookModels, 'pages' => $pages,
            'authorId' => $id, 'authorName' => $authorName, 'genres' => $genres]);
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
            'defaultPageSize' => 60,
        ]);
        $pagination->pageSizeParam = false;
        return $pagination;
    }

    protected function paginateByAuthorId($id, $per)
    {
        $pagination = new Pagination(['totalCount' => (new BookServices())->getBooksCountByAuthorId($id),
            'pageSize' => $per,
            'defaultPageSize' => 60,
        ]);
        $pagination->pageSizeParam = false;
        return $pagination;
    }
}

?>