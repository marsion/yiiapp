<?php

namespace app\controllers;

use yii\web\Controller;
use Yii;
use app\services\GenreServices;
use app\models\LoginForm;

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

    public function actionPublishhouses()
    {
        $genres = self::genreServices()->getFilterOptionsGenres();
        return $this->render('publishhouses', ['genres' => $genres]);
    }

    public function actionGenres()
    {
        $genres = self::genreServices()->getFilterOptionsGenres();
        return $this->render('genres', ['genres' => $genres]);
    }

    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        } else {
            return $this->render('login', [
                'model' => $model,
            ]);
        }
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