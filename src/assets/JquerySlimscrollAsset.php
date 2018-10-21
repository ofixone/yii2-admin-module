<?php

namespace ofixone\admin\assets;

use yii\web\AssetBundle;

class JquerySlimscrollAsset extends AssetBundle
{
    public $sourcePath = "@npm/jquery-slimscroll";

    public $js = [
        'jquery.slimscroll.min.js'
    ];
}