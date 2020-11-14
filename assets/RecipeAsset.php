<?php

namespace nofikoff\supercook\assets;

use yii\web\AssetBundle;

class RecipeAsset extends AssetBundle
{
//    // the alias to your assets folder in your file system
    public $sourcePath = '@recipe-assets';
//    // finally your files..
    public $js = [
        'js/main-page.js',
    ];
//    // that are the dependecies, for makeing your Asset bundle work with Yii2 framework
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}
