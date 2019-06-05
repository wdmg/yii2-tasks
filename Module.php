<?php

namespace wdmg\tasks;

/**
 * Yii2 Tasks
 *
 * @category        Module
 * @version         1.1.3
 * @author          Alexsander Vyshnyvetskyy <alex.vyshnyvetskyy@gmail.com>
 * @link            https://github.com/wdmg/yii2-tasks
 * @copyright       Copyright (c) 2019 W.D.M.Group, Ukraine
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
    private $version = "1.1.3";

    /**
     * @var integer, priority of initialization
     */
    private $priority = 8;

    public function bootstrap($app)
    {
        parent::bootstrap($app);
    }
}