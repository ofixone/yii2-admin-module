<?php
/**
 * @var \yii\web\View $this
 * @var string $content
 */

use yii\widgets\Breadcrumbs;
use ofixone\admin\widgets\alert\Widget as Alert;
?>
<div class="content-wrapper">
    <section class="content-header">
        <h1><?= $this->title ?></h1>
        <?= Breadcrumbs::widget([
            'homeLink' => [
                'encode' => false,
                'label' => '<i class="fa fa-dashboard"></i>  Главная',
                'url' => ['admin/module/dashboard']
            ],
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
    </section>
    <section class="content">
        <?= Alert::widget() ?>
        <?= $content ?>
    </section>
</div>