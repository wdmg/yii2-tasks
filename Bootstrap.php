<?php

namespace wdmg\tasks;

use yii\base\BootstrapInterface;
use Yii;


class Bootstrap implements BootstrapInterface
{
    public function bootstrap($app)
    {
        // Get the module instance
        $module = Yii::$app->getModule('tasks');

        // Get URL path prefix if exist
        $prefix = (isset($module->routePrefix) ? $module->routePrefix . '/' : '');

        // Add module URL rules
        $app->getUrlManager()->addRules(
            [
                $prefix.'<controller:(tasks|subunits)>/' => 'tasks/<controller>/index',
                $prefix.'tasks/<controller:(tasks|subunits)>/<action:\w+>' => 'tasks/<controller>/<action>',
                $prefix.'<controller:(tasks|subunits)>/<action:\w+>' => 'tasks/<controller>/<action>',
            ],
            false
        );
    }
}
