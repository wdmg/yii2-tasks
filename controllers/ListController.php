<?php

namespace wdmg\tasks\controllers;

use Yii;
use wdmg\tasks\models\Tasks;
use wdmg\tasks\models\TasksSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;

/**
 * ListController implements the CRUD actions for Tasks model.
 */
class ListController extends Controller
{

    /**
     * {@inheritdoc}
     */
    public $defaultAction = 'all';

    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['@']
                    ],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function beforeAction($action)
    {
        $viewed = array();
        $modules = array();
        $session = Yii::$app->session;

        if(!isset(Yii::$app->modules['users']))
            $modules[] = '«Users»';

        if(!isset(Yii::$app->modules['tickets']))
            $modules[] = '«Tickets»';

        if(isset($session['viewed-flash']) && is_array($session['viewed-flash']))
            $viewed = $session['viewed-flash'];

        if(count($modules) > 0 && !in_array('tasks-need-modules', $viewed) && is_array($viewed)) {
            Yii::$app->getSession()->setFlash(
                'warning',
                Yii::t(
                    'app/modules/tasks',
                    'Some fields may contain limited information. We recommend installing the {modules} {count, plural, =1{module} one{module} few{modules} many{modules} other{modules}} for complete compatibility.',
                    [
                        'modules' => implode(', ', $modules),
                        'count' => count($modules)
                    ]
                )
            );
            $session['viewed-flash'] = array_merge(array_unique($viewed), ['tasks-need-modules']);
        }

        // Set custom view path
        parent::setViewPath('@vendor/wdmg/yii2-tasks/views/tasks');

        return parent::beforeAction($action);
    }

    /**
     * Lists all Tasks models.
     * @return mixed
     */
    public function actionAll()
    {
        $searchModel = new TasksSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('all', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Lists only current user Tasks models.
     * @return mixed
     */
    public function actionCurrent($id)
    {
        $model = new Tasks();
        $searchModel = new TasksSearch();
        $user = $model->getUser(intval($id));
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams, intval($id));

        return $this->render('current', [
            'username' => $user->username,
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Lists only auth user Tasks models.
     * @return mixed
     */
    public function actionMy()
    {
        $searchModel = new TasksSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams, Yii::$app->user->id);

        return $this->render('my', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Finds the Tasks model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Tasks the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Tasks::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app/modules/tasks', 'The requested page does not exist.'));
    }
}
