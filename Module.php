<?php

namespace wdmg\tasks;

use Yii;

/**
 * tasks module definition class
 */
class Module extends \yii\base\Module
{
    /**
     * {@inheritdoc}
     */
    public $controllerNamespace = 'wdmg\tasks\controllers';

    /**
     * {@inheritdoc}
     */
    public function init()
    {
        parent::init();
        if (Yii::$app instanceof \yii\console\Application) {
            $this->controllerNamespace = 'wdmg\tasks\commands';
        }
    }
}
