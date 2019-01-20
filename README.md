[![Progress](https://img.shields.io/badge/required-Yii2_v2.0.13-blue.svg)](https://packagist.org/packages/yiisoft/yii2) [![Github all releases](https://img.shields.io/github/downloads/wdmg/yii2-tasks/total.svg)](https://GitHub.com/wdmg/yii2-tasks/releases/) [![GitHub version](https://badge.fury.io/gh/wdmg%2Fyii2-tasks.svg)](https://github.com/wdmg/yii2-tasks) ![Progress](https://img.shields.io/badge/progress-in_development-red.svg) [![GitHub license](https://img.shields.io/github/license/wdmg/yii2-tasks.svg)](https://github.com/wdmg/yii2-tasks/blob/master/LICENSE) 

# Yii2 Tasks Module
Task manager for Yii2

# Requirements 
* PHP 5.6 or higher
* Yii2 v.2.0.13 and newest
* [Yii2 Tickets](https://github.com/wdmg/yii2-tickets) module (optionaly)
* [Yii2 Users](https://github.com/wdmg/yii2-users) module (optionaly)

# Installation
To install the module, run the following command in the console:

`$ composer require "wdmg/yii2-tasks"`

After configure db connection, run the following command in the console:

`$ php yii tasks/init`

And select the operation you want to perform:
  1) Apply all module migrations
  2) Revert all module migrations

# Migrations
In any case, you can execute the migration and create the initial data, run the following command in the console:

`$ php yii migrate --migrationPath=@vendor/wdmg/yii2-tasks/migrations`

# Configure
To add a module to the project, add the following data in your configuration file:

    'modules' => [
        ...
        'tasks' => [
            'class' => 'wdmg\tasks\Module',
            'routePrefix' => 'admin'
        ],
        ...
    ],

and Bootstrap section:

`
$config['bootstrap'][] = 'wdmg\tasks\Bootstrap';
`

# Routing
`http://example.com/admin/tasks` - Module dashboard

# Status and version
* v.1.0.3 - Added base CRUD interface
* v.1.0.2 - Added routing path to Bootstrap.
* v.1.0.1 - Added migrations path to Bootstrap.
* v.1.0.0 - Module in progress development.