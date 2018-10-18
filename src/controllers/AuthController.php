<?php

namespace ofixone\admin\controllers;

use ofixone\admin\models\forms\LoginForm;
use yii\web\Controller;
use Yii;

class AuthController extends Controller
{
    public $layout = 'auth';

    public function actionLogin() {
        if (!Yii::$app->user->isGuest) {
            return $this->redirect(['module/dashboard']);
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->redirect(['module/dashboard']);
        } else {
            return $this->render('login', [
                'model' => $model
            ]);
        }
    }

    public function actionLogout()
    {
        Yii::$app->user->logout();
        return $this->redirect(['login']);
    }
}