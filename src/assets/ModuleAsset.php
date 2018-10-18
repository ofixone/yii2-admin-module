<?php

namespace ofixone\admin\assets;

use dmstr\web\AdminLteAsset;
use yii\web\AssetBundle;

class ModuleAsset extends AssetBundle
{
    public $sourcePath = "@ofixone/admin/assets/src";

    public $js = [
        'app.js'
    ];

    public $css = [
        'app.css'
    ];

    public $depends = [
        AdminLteAsset::class
    ];
}