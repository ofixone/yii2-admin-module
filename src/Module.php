<?php

namespace ofixone\admin;

use ofixone\admin\interfaces\AdminInterface;
use ofixone\admin\interfaces\ModuleInterface;
use yii\base\BootstrapInterface;
use yii\base\InvalidConfigException;
use yii\db\ActiveRecord;
use yii\filters\AccessControl;
use yii\helpers\ArrayHelper;
use yii\web\Application;
use yii\web\IdentityInterface;
use yii\web\NotAcceptableHttpException;

/**
 * Class Module
 * @property ActiveRecord|AdminInterface|string $adminModel
 * @package ofixone\admin
 */
class Module extends \yii\base\Module implements BootstrapInterface
{
    public $controllerNamespace = "ofixone\admin\controllers";
    public $layout = "main";

    public $name = 'Администрирование';
    public $shortName = 'АДМ';
    public $adminAssignment = "@";
    public $skin = 'skin-blue';

    public $adminModel;

    public function behaviors()
    {
        if(!\Yii::$app instanceof \yii\console\Application) {
            return [
                [
                    'class' => AccessControl::class,
                    'rules' => [
                        [
                            'actions' => ['login'],
                            'allow' => true,
                            'roles' => ['?']
                        ],
                        [
                            'allow' => true,
                            'roles' => [$this->adminAssignment]
                        ]
                    ]
                ]
            ];
        }
        return [];
    }

    public function bootstrap($app)
    {
        if($app instanceof \yii\console\Application) {
            $this->controllerNamespace = "ofixone\admin\console";
        } else {
            if(strpos(\Yii::$app->request->url, $this->id) !== false) {
                $this->bootstrapLoadModules();
                $this->bootstrapAddRules($app);
            }
        }
    }

    public function bootstrapLoadModules()
    {
        if(!empty($this->modules)) {
            foreach ($this->modules as $moduleId => $moduleConfig) {
                $this->getModule($moduleId, true);
            }
        }
    }

    public function bootstrapAddRules(\yii\base\Application $app)
    {
        $app->urlManager->addRules([
            ['pattern' => $this->id, 'route' => $this->id . "/module/dashboard"],
            ['pattern' => $this->id . "/<action:login|logout>", 'route' => $this->id . "/auth/<action>"]
        ], false);
        foreach($this->modules as $module) {
            if($module instanceof ModuleInterface) {
                $app->urlManager->addRules($module->addRules(), false);
            }
        }
    }

    public function getMenuItems()
    {
        $menuItems = [];
        $groups = [];
        foreach($this->modules as $module) {
            if($module instanceof ModuleInterface) {
                if(empty(($items = $module->addMenuItem())['group'])){
                    foreach($items as $item) {
                        $menuItems[] = $item;
                    }
                } else {
                    $group = ArrayHelper::remove($items, 'group');
                    if(empty($groups[$group])) {
                        $groups[$group] = [];
                    }
                    foreach($items as $item) {
                        $groups[$group][] = $item;
                    }
                }
            }
        }
        if(!empty($groups)) {
            foreach($groups as $group => $items) {
                $menuItems[] = ['label' => $group, 'options' => ['class' => ['header']]];
                $menuItems = ArrayHelper::merge($menuItems, $items);
            }
        }
        return $menuItems;
    }

    public function init()
    {
        parent::init();
        $this->checkAdminModel();
    }

    public function checkAdminModel()
    {
        if(empty($this->adminModel)) {
            throw new InvalidConfigException('Необходимо задать модель администраторов');
        }
        $test = new $this->adminModel;
        if(!$test instanceof AdminInterface) {
            throw new InvalidConfigException('Модель администраторов '. $this->adminModel . " должна " .
                'реализовывать интерфейс ' . AdminInterface::class
            );
        }
        unset($test);
    }

    public function getDevMenuItems()
    {
        return [
            ['label' => 'Разработчик', 'options' => ['class' => 'header']],
            ['label' => 'Генератор кода', 'icon' => 'file-code-o', 'url' => ['/gii']],
            ['label' => 'Панель отладки', 'icon' => 'dashboard', 'url' => ['/debug']]
        ];
    }
}