<?php

namespace app\controllers;

use yii\web\Controller;
use app\services\AuthorServices;
use app\services\BookServices;
use app\dao\AuthorDAO;
use yii\data\Pagination;
use Yii;

class AuthorsController extends Controller
{

    public function actionList($sort = null, $ord = null, $c = null, $per = null)
    {
        $pages = self::paginate($c, $per);
        $countryOptions = self::services()->getFilterOptionsCountries();

        $authorModels = self::services()->getAllAuthors($pages, $sort, $ord, $c);
        return $this->render('list', ['authors' => $authorModels,
            'pages' => $pages,
            'countryOptions' => $countryOptions]);
    }

    public function actionSingle($id)
    {
        $authorModel = self::services()->getAuthorByID($id);
        return $this->render('single', array('id' => $id, 'author' => $authorModel));
    }

    public function actionBooks($id, $sort = null, $ord = null, $per = null)
    {
        $pages = self::paginateByAuthorId($id, $per);
        $bookModels = (new BookServices())->getAllBooksByAuthorID($id, $pages, $sort, $ord);
        $authorFullName = self::services()->getAuthorFullNameByID($id);
        return $this->render('books', ['books' => $bookModels,
            'pages' => $pages,
            'authorId' => $id,
            'authorFullName' => $authorFullName]);
    }

    protected function services()
    {
        return new AuthorServices();
    }

    protected function bookServices()
    {
        return new BookServices();
    }

    protected function paginate($country, $per)
    {
        $pagination = new Pagination(['totalCount' =>
            self::services()->getAuthorsCountByCountry($country),
            'pageSize' => $per,
            'defaultPageSize' => 18,
        ]);
        $pagination->pageSizeParam = false;
        return $pagination;
    }

    protected function paginateByAuthorId($id, $per)
    {
        $pagination = new Pagination(['totalCount' => (new BookServices())->getBooksCountByAuthorId($id),
            'pageSize' => $per,
            'defaultPageSize' => 18,
        ]);
        $pagination->pageSizeParam = false;
        return $pagination;
    }
}

?>