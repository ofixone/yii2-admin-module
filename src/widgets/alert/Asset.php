<?php

namespace ofixone\admin\widgets\alert;

use yii\web\AssetBundle;
use yii\web\JqueryAsset;

class Asset extends AssetBundle
{
    public $sourcePath = '@npm/jquery-toast-plugin/dist';

    public $css = [
        'jquery.toast.min.css'
    ];

    public $js = [
        'jquery.toast.min.js'
    ];

    public $depends = [
        JqueryAsset::class
    ];
}