# Yii2 Tasks Module
Task manager for Yii2

# Installation
To install the module, run the following command in the console:

`$ composer require "wdmg/yii2-tasks" --dev`

# Migrations
To execute the migration and create the initial data, run the following command in the console:

`$ yii migrate --migrationPath=@vendor/wdmg/yii2-tasks/migrations`

# Configure
To add a module to the project, add the following data in your configuration file:

    'modules' => [
        ...
        'tasks' => [
            'class' => 'wdmg\tasks\Module',
        ],
        ...
    ],

# Status
Module in progress development.