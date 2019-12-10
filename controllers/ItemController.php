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
 * ItemController implements the CRUD actions for Tasks model.
 */
class ItemController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        $behaviors = [
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
            'access' => [
                'class' => AccessControl::class,
                'rules' => [
                    [
                        'roles' => ['admin'],
                        'allow' => true
                    ],
                ],
            ],
        ];

        // If auth manager not configured use default access control
        if(!Yii::$app->authManager) {
            $behaviors['access'] = [
                'class' => AccessControl::class,
                'rules' => [
                    [
                        'roles' => ['@'],
                        'allow' => true
                    ],
                ]
            ];
        }

        return $behaviors;
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

        parent::setViewPath('@vendor/wdmg/yii2-tasks/views/tasks');

        return parent::beforeAction($action);
    }

    /**
     * Go back to all Tasks models from /tasks/list/all.
     * @return mixed
     */
    public function actionIndex()
    {
        return $this->goBack(['tasks/list/all']);
    }

    /**
     * Displays a single Tasks model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Tasks model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Tasks();

        if ($model->load(Yii::$app->request->post())) {

            if($model->save())
                Yii::$app->getSession()->setFlash(
                    'success',
                    Yii::t('app/modules/tasks', 'Task has been successfully created!')
                );
            else
                Yii::$app->getSession()->setFlash(
                    'danger',
                    Yii::t('app/modules/tasks', 'An error occurred while creating the task.')
                );

            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Tasks model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post())) {

            if($model->save())
                Yii::$app->getSession()->setFlash(
                    'success',
                    Yii::t('app/modules/tickets', 'Ticket has been successfully updated!')
                );
            else
                Yii::$app->getSession()->setFlash(
                    'danger',
                    Yii::t('app/modules/tickets', 'An error occurred while updating the ticket.')
                );

            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Tasks model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Update some fields in existing Tasks model.
     * If updating is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionSet($id)
    {
        $model = $this->findModel($id);
        $params = \Yii::$app->request->get();
        $fields = $model->getAttributes();

        if(is_array($params)) {
            foreach ($params as $param => $value) {
                if(array_key_exists($param, $fields))
                    $model->setAttribute($param, $value);
            }
        }

        if($model->update())
            Yii::$app->getSession()->setFlash(
                'success',
                Yii::t('app/modules/tasks', 'Task has been successfully updated!')
            );
        else
            Yii::$app->getSession()->setFlash(
                'danger',
                Yii::t('app/modules/tasks', 'An error occurred while updating the task.')
            );

        return $this->redirect(['view', 'id' => $model->id]);
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
