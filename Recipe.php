<?php

namespace app\modules\recipe;

/**
 * recipe module definition class
 */
class Recipe extends \yii\base\Module
{
    /**
     * {@inheritdoc}
     */
    public $controllerNamespace = 'app\modules\recipe\controllers';

    /**
     * {@inheritdoc}
     */
    public function init()
    {
        parent::init();
        // initialize the module with the configuration loaded from config.php
        \Yii::configure($this, require(__DIR__ . '/config.php'));
        $this->setAliases([
            '@recipe-assets' => __DIR__ . '/assets'
        ]);
    }
}
