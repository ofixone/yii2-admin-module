<?php
/**
 * @var \yii\web\View $this
 * @var \ofixone\admin\Module $module
 * @var \ofixone\admin\interfaces\AdminInterface $user
 */

use ofixone\admin\widgets\Menu;

$module = Yii::$app->getModule('admin');
$user = Yii::$app->user->identity;
?>
<aside class="main-sidebar">
    <section class="sidebar">
        <div class="user-panel">
            <div class="pull-left image">
                <img src="<?= Yii::$app->assetManager->getPublishedUrl("@ofixone/admin/assets/src") . "/admin.png" ?>" class="img-circle"/>
            </div>
            <div class="pull-left info">
                <p>Администратор</p>
                <a href="#"><i class="fa fa-circle text-success"></i> <?=
                    $user->getStatusString()
                ?></a>
            </div>
        </div>
        <?= Menu::widget(
            [
                'options' => ['class' => 'sidebar-menu tree', 'data-widget'=> 'tree'],
                'items' => \yii\helpers\ArrayHelper::merge(
                    $module->getMenuItems(),
                    $module->getDevMenuItems()
                )
            ]
        ) ?>
    </section>
</aside>