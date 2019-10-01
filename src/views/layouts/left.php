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
                <p><?= $user->getStatusName() ?></p>
                <a href="#"><i class="fa fa-circle <?= $user->getStatusClass() ?: 'text-success' ?>"></i> <?=
                    $user->getStatusString()
                ?></a>
            </div>
        </div>
        <?= Menu::widget(
            [
                'options' => ['class' => 'sidebar-menu tree', 'data-views'=> 'tree', 'data-widget'=> 'tree'],
                'items' => \yii\helpers\ArrayHelper::merge(
                    call_user_func($module->menuItemsCallback, Yii::$app),
                    $module->getDevMenuItems()
                )
            ]
        ) ?>
    </section>
</aside>