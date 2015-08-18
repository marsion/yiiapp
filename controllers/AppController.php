<?php

namespace app\controllers;

use yii\web\Controller;
use Yii;
use app\services\GenreServices;

class AppController extends Controller
{

    public function actionIndex()
    {
        $genres = self::genreServices()->getFilterOptionsGenres();
        return $this->render('index', ['genres' => $genres]);
    }

    public function actionAbout()
    {
        $genres = self::genreServices()->getFilterOptionsGenres();
        return $this->render('about', ['genres' => $genres]);
    }

    public function actionContact()
    {
        $genres = self::genreServices()->getFilterOptionsGenres();
        return $this->render('contact', ['genres' => $genres]);
    }

    public function actionLogin()
    {
        $genres = self::genreServices()->getFilterOptionsGenres();
        return $this->render('login', ['genres' => $genres]);
    }

    public function actionLogout()
    {
        Yii::$app->user->logout();
        return $this->goHome();
    }

    protected function genreServices()
    {
        return new GenreServices();
    }
}

?>