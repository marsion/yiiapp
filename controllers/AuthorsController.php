<?php

namespace app\controllers;


use yii\web\Controller;
use app\services\AuthorServices;
use app\services\BookServices;
use app\services\GenreServices;
use app\services\CountryServices;
use app\services\CommentServices;
use yii\data\Pagination;
use Yii;

class AuthorsController extends Controller
{

    public function actionList()
    {
        $sort = Yii::$app->request->get('sort', null);
        $ord = Yii::$app->request->get('ord', null);
        $per = Yii::$app->request->get('per', null);
        $c = Yii::$app->request->get('c', array());
        $byear = Yii::$app->request->get('byear', null);
        $byeq = Yii::$app->request->get('byeq', null);
        $dyear = Yii::$app->request->get('dyear', null);
        $dyeq = Yii::$app->request->get('dyeq', null);

        $pages = self::paginate($per, $c, $byear, $byeq, $dyear, $dyeq);
        $countryOptions = self::countryServices()->getFilterOptionsCountries($c);

        $authorModels = self::services()->getAllAuthors($pages, $sort, $ord, $c, $byear, $byeq, $dyear, $dyeq);
        return $this->render('list', ['authors' => $authorModels,
            'pages' => $pages, 'countryOptions' => $countryOptions]);
    }

    public function actionSingle($id)
    {
        $authorModel = self::services()->getAuthorByID($id);
        $popularBooks = self::bookServices()->getMostPopularBooksByAuthorID($id, 5);
        $usersChoiceBooks = self::bookServices()->getUsersChoiceBooksByAuthorID($id, 5);
        $pages = self::paginateComments($id);
        $comments = self::commentServices()->findCommentsForAuthor($pages, $id);
        $genres = self::genreServices()->getFilterOptionsGenres();
        return $this->render('single', ['id' => $id, 'author' => $authorModel, 'genres' => $genres,
            'popularBooks' => $popularBooks, 'usersChoiceBooks' => $usersChoiceBooks,
            'comments' => $comments, 'pages' => $pages]);
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

    protected function commentServices()
    {
        return new CommentServices();
    }

    protected function paginate($per, $c, $byear, $byeq, $dyear, $dyeq)
    {
        $pagination = new Pagination(['totalCount' =>
            self::services()->getAuthorsCountByParams($c, $byear, $byeq, $dyear, $dyeq),
            'pageSize' => $per,
            'defaultPageSize' => 30,
        ]);
        $pagination->pageSizeParam = false;
        return $pagination;
    }

    protected function paginateComments($id)
    {
        $pagination = new Pagination(
            ['totalCount' => self::commentServices()->getAuthorCommentsCount($id),
                'defaultPageSize' => 2,
            ]);
        $pagination->pageSizeParam = false;
        return $pagination;
    }
}

?>