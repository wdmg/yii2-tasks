<?php

namespace wdmg\tasks\controllers;

use yii\web\Controller;

/**
 * Default controller for the `tasks` module
 */
class AdminController extends Controller
{
    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index');
    }
}
