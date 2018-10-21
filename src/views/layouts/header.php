<?php
/**
 * @var \yii\web\View $this
 * @var string $content
 * @var \ofixone\admin\Module $module
 */
$module = Yii::$app->getModule('admin');
?>
<header class="main-header">
    <a class="logo" href="<?= \yii\helpers\Url::to(Yii::$app->homeUrl) ?>">
        <span class="logo-mini"><?=
            $module->shortName
        ?></span><span class="logo-lg"><?= $module->name ?></span>'
    </a>
    <nav class="navbar navbar-static-top" role="navigation">
        <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button"></a>
        <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
                <li>
                    <a href="<?= \yii\helpers\Url::to(['/admin/auth/logout']) ?>">Выйти</a>
                </li>
            </ul>
        </div>
    </nav>
</header>