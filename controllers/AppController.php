<?php

namespace app\controllers;

use yii\web\Controller;
use Yii;

class AppController extends Controller
{

    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionAbout()
    {
        return $this->render('about');
    }

    public function actionContact()
    {
        return $this->render('contact');
    }

    public function actionLogin()
    {
        return $this->render('login');
    }

    public function actionLogout()
    {
        Yii::$app->user->logout();
        return $this->goHome();
    }
}

?>