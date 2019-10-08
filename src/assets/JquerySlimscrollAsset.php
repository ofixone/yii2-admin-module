<?php

namespace ofixone\admin\assets;

use yii\web\AssetBundle;
use yii\web\JqueryAsset;

class JquerySlimscrollAsset extends AssetBundle
{
    public $sourcePath = "@npm/jquery-slimscroll";

    public $js = [
        'jquery.slimscroll.min.js'
    ];

    public $depends = [
        JqueryAsset::class
    ];
}