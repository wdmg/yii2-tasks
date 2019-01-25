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
                $prefix . '<module:tasks>/' => '<module>/list/all',
                $prefix . '<module:tasks>/<controller:(list)>/' => '<module>/<controller>',
                $prefix . '<module:tasks>/<controller:(list)>/<action:(all|my|current)>' => '<module>/<controller>/<action>',
                $prefix . '<module:tasks>/<controller:(item)>/<action:(create|view|update|delete)>' => '<module>/<controller>/<action>',
            ],
            true
        );
    }
}
