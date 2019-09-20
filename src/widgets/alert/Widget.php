<?php
/**
 * Created by PhpStorm.
 * User: oFix
 * Date: 019 19.10.18
 * Time: 15:13
 */

namespace ofixone\admin\widgets\alert;

use Yii;
use yii\bootstrap\Alert;
use yii\helpers\Json;
use yii\helpers\ArrayHelper;
use yii\web\View;

class Widget extends \yii\bootstrap\Widget
{
    const TYPE_SUCCESS = 'success';
    const TYPE_ERROR = 'danger';
    const TYPE_WARNING = 'warning';
    const TYPE_INFO = 'info';

    protected $alerts = [];
    protected $jsAlerts = [];
    protected $defaultJsConfig = [
        'position' => 'top-right',
        'showHideTransition' => 'slide',
        'hideAfter' => 6000,
    ];
    protected $alertTypes = [
        self::TYPE_ERROR => [
            'class' => 'alert-danger',
            'icon' => '<i class="icon fa fa-ban"></i>',
        ],
        self::TYPE_SUCCESS => [
            'class' => 'alert-success',
            'icon' => '<i class="icon fa fa-check"></i>',
        ],
        self::TYPE_INFO => [
            'class' => 'alert-info',
            'icon' => '<i class="icon fa fa-info"></i>',
        ],
        self::TYPE_WARNING => [
            'class' => 'alert-warning',
            'icon' => '<i class="icon fa fa-warning"></i>',
        ],
    ];

    public function init()
    {
        parent::init();
        $flashes = Yii::$app->session->getAllFlashes();
        foreach($flashes as $item) {
            if(!empty($item['js'])) {
                $this->jsAlerts[] = $item;
            } else {
                $this->alerts[] = $item;
            }
        }
    }

    public function run()
    {
        Asset::register(Yii::$app->view);
        $this->runJs();
        $this->runHtml();
    }

    public function runHtml()
    {
        foreach ($this->alerts as $data) {
            if (isset($this->alertTypes[$data['type']])) {
                $type = $data['type'];
                $this->options['class'] = $this->alertTypes[$type]['class'];
                $this->options['id'] = $this->getId() . '-' . $type;
                echo Alert::widget([
                    'body' => $this->alertTypes[$type]['icon'] . $data['text'],
                    'options' => $this->options,
                ]);
            }
        }
    }

    public function runJs() {
        foreach($this->jsAlerts as $flash) {
            $toastConfig = Json::encode(ArrayHelper::merge($this->defaultJsConfig, $flash));
            $this->view->registerJs(
                "$.toast($toastConfig)",
                View::POS_END
            );
        }
    }
}