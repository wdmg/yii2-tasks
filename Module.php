<?php

namespace wdmg\tasks;

/**
 * Yii2 Tasks
 *
 * @category        Module
 * @version         1.1.9
 * @author          Alexsander Vyshnyvetskyy <alex.vyshnyvetskyy@gmail.com>
 * @link            https://github.com/wdmg/yii2-tasks
 * @copyright       Copyright (c) 2019 - 2021 W.D.M.Group, Ukraine
 * @license         https://opensource.org/licenses/MIT Massachusetts Institute of Technology (MIT) License
 *
 */

use Yii;
use wdmg\base\BaseModule;

/**
 * tasks module definition class
 */
class Module extends BaseModule
{
    /**
     * {@inheritdoc}
     */
    public $controllerNamespace = 'wdmg\tasks\controllers';

    /**
     * {@inheritdoc}
     */
    public $defaultRoute = "list/all";

    /**
     * @var string, the name of module
     */
    public $name = "Tasks";

    /**
     * @var string, the description of module
     */
    public $description = "Support Task System";

    /**
     * @var string the module version
     */
    private $version = "1.1.9";

    /**
     * @var integer, priority of initialization
     */
    private $priority = 8;

    /**
     * {@inheritdoc}
     */
    public function init()
    {
        parent::init();

        // Set version of current module
        $this->setVersion($this->version);

        // Set priority of current module
        $this->setPriority($this->priority);

    }

    /**
     * {@inheritdoc}
     */
    public function dashboardNavItems($createLink = false)
    {
        $items = [
            'label' => $this->name,
            'url' => [$this->routePrefix . '/'. $this->id],
            'icon' => 'fa fa-fw fa-tasks',
            'active' => in_array(\Yii::$app->controller->module->id, [$this->id])
        ];



        return [
            'label' => $this->name,
            'url' => [$this->routePrefix . '/'. $this->id],
            'icon' => 'fa fa-fw fa-tasks',
            'active' => in_array(\Yii::$app->controller->module->id, [$this->id]),
            'items' => [
                [
                    'label' => Yii::t('app/modules/tasks', 'Tasks list'),
                    'url' => [$this->routePrefix . '/tasks/list/all'],
                    'active' => (in_array(\Yii::$app->controller->module->id, ['list']) &&  Yii::$app->controller->id == 'all'),
                ],
                [
                    'label' => Yii::t('app/modules/tasks', 'Subunits list'),
                    'url' => [$this->routePrefix . '/tasks/subunits/index'],
                    'active' => (in_array(\Yii::$app->controller->module->id, ['subunits']) &&  Yii::$app->controller->id == 'index'),
                ]
            ]
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function bootstrap($app)
    {
        parent::bootstrap($app);
    }
}