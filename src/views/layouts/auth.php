<?php
/**
 * Created by PhpStorm.
 * User: oFix
 * Date: 005 05.09.18
 * Time: 13:21
 */

/**
 * @var $this \yii\web\View
 * @var $content string
 * @var $module \ofixone\admin\Module
 */

use yii\helpers\Html;
use ofixone\admin\assets\ModuleAsset;

$module = Yii::$app->getModule('admin');

ModuleAsset::register($this);
?>
<?php $this->beginPage() ?>
    <!DOCTYPE html>
    <html lang="<?= Yii::$app->language ?>">
    <head>
        <meta charset="<?= Yii::$app->charset ?>"/>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <?= Html::csrfMetaTags() ?>
        <title><?= Html::encode($this->title) ?></title>
        <?php $this->head() ?>
    </head>
    <body class="login-page <?= $module->skin ?>">
    <?php $this->beginBody() ?>
    <?= $content ?>
    <?php $this->endBody() ?>
    </body>
    </html>
<?php $this->endPage() ?>