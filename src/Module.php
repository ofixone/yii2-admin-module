<?php

namespace ofixone\admin;

use ofixone\admin\interfaces\AdminInterface;
use yii\base\BootstrapInterface;
use yii\base\InvalidConfigException;
use yii\db\ActiveRecord;
use yii\filters\AccessControl;
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
        }
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
}