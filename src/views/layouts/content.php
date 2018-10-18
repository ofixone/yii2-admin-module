<?php
/**
 * @var \yii\web\View $this
 * @var string $content
 */

use yii\widgets\Breadcrumbs;

?>
<div class="content-wrapper">
    <section class="content-header">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
    </section>
    <section class="content">
        <?= $content ?>
    </section>
</div>