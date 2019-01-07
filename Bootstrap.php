<?php

namespace wdmg\tasks;

use yii\base\BootstrapInterface;


class Bootstrap implements BootstrapInterface
{
    public function bootstrap($app)
    {
        // Get the module instance
        $module = Yii::$app->getModule('tasks');

        // Add module URL rules.
        $prefix = (isset($module->routePrefix) ? $module->routePrefix . '/' : '');

        $app->getUrlManager()->addRules(
            [
                $prefix.'<_m>' => '<_m>/admin/index',
            ],
            false
        );

        /*$app->controllerMap["migrate"]["class"] = 'yii\console\controllers\MigrateController';
        $app->controllerMap["migrate"]["migrationNamespaces"][] = 'wdmg\tasks\migrations';*/
    }
}
