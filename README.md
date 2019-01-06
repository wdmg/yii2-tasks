# Yii2 Tasks Module
Task manager for Yii2

# Installation
To install the module, run the following command in the console:

`$ composer require "wdmg/yii2-tasks"`

# Migrations
To execute the migration and create the initial data, run the following command in the console:

`$ php yii migrate --migrationPath=@vendor/wdmg/yii2-tasks/migrations`

# Configure
To add a module to the project, add the following data in your configuration file:

    'modules' => [
        ...
        'tasks' => [
            'class' => 'wdmg\tasks\Module',
        ],
        ...
    ],

# Routing
`http://example.com/admin/tasks` - Module dashboard

# Status and version
v.1.0.2 - Added routing path to Bootstrap.
v.1.0.1 - Added migrations path to Bootstrap.
v.1.0.0 - Module in progress development.