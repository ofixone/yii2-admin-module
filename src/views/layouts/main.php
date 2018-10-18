<?php

/* @var $this \yii\web\View */

/* @var $content string */

use yii\helpers\Html;
use ofixone\admin\assets\ModuleAsset;

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
<body class="hold-transition skin-blue sidebar-mini fixed">
<?php $this->beginBody() ?>
<div class="wrapper">
    <?= $this->render('header.php') ?>
    <?= $this->render('left.php')
    ?>
    <?= $this->render(
        'content.php',
        ['content' => $content]
    ) ?>
</div>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
