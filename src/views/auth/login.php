<?php
/**
 * @var $this yii\web\View
 * @var \ofixone\admin\models\forms\LoginForm $model
 * @var \ofixone\admin\Module $module;
 */

use yii\helpers\Html;
use kartik\form\ActiveForm;

$this->title = 'Административная панель';

$module = Yii::$app->controller->module;
?>

<div class="login-box">
    <div class="login-logo">
        <a href="#"><b><?= $module->name ?></b></a>
    </div>
    <div class="login-box-body">
        <p class="login-box-msg">Пожалуйста, заполните следующие поля для авторизации в приложении</p>
        <?php $form = ActiveForm::begin(['id' => 'login-form']); ?>
        <?= $form->field($model, 'login')
            ->label(false)
            ->textInput(['placeholder' => $model->getAttributeLabel('login')]) ?>
        <?= $form->field($model, 'password')
            ->label(false)
            ->passwordInput(['placeholder' => $model->getAttributeLabel('password')]) ?>
        <div class="row">
            <div class="col-xs-8">
                <?= $form->field($model, 'rememberMe')->checkbox() ?>
            </div>
            <div class="col-xs-4">
                <?= Html::submitButton('Вход',
                    ['class' => 'btn btn-primary btn-block btn-flat', 'name' => 'login-button']) ?>
            </div>
        </div>
        <?php ActiveForm::end(); ?>

    </div>
</div>
