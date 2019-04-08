<?php

namespace wdmg\tasks;

/**
 * @author          Alexsander Vyshnyvetskyy <alex.vyshnyvetskyy@gmail.com>
 * @copyright       Copyright (c) 2019 W.D.M.Group, Ukraine
 * @license         https://opensource.org/licenses/MIT Massachusetts Institute of Technology (MIT) License
 */

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
                $prefix . '<module:tasks>/' => '<module>/tasks/index',
                $prefix . '<module:tasks>/view' => '<module>/tasks/view',
                $prefix . '<module:tasks>/<controller:(list|item)>/' => '<module>/<controller>',
                $prefix . '<module:tasks>/<controller:(list|item)>/<action:\w+>' => '<module>/<controller>/<action>',
                [
                    'pattern' => $prefix . '<module:tasks>/',
                    'route' => '<module>/tasks/index',
                    'suffix' => '',
                ], [
                    'pattern' => $prefix . '<module:tasks>/view',
                    'route' => '<module>/tasks/view',
                    'suffix' => '',
                ], [
                    'pattern' => $prefix . '<module:tasks>/<controller:(list|item)>/',
                    'route' => '<module>/<controller>',
                    'suffix' => '',
                ], [
                    'pattern' => $prefix . '<module:tasks>/<controller:(list|item)>/<action:\w+>',
                    'route' => '<module>/<controller>/<action>',
                    'suffix' => '',
                ],
            ],
            true
        );
    }
}
