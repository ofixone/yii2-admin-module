<?php

namespace ofixone\admin\controllers;

use yii\web\Controller;

class ModuleController extends Controller
{
    public $defaultAction = 'dashboard';

    public function actionDashboard()
    {
        return $this->render('dashboard');
    }
}