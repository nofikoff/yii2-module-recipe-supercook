<?php

namespace nofikoff\supercook;

/**
 * recipe module definition class
 */
class Recipe extends \yii\base\Module
{
    /**
     * {@inheritdoc}
     */
    public $controllerNamespace = 'nofikoff\supercook\controllers';

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
