<?php

namespace app\controllers;

use app\models\Access;
use Yii;
use app\models\Note;
use app\models\search\NoteSearch;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\ForbiddenHttpException;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * NoteController implements the CRUD actions for Note model.
 */
class NoteController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['mynotes', 'friendnotes', 'create', 'update', 'delete'],
                'rules' => [
                    [
                        'actions' => ['mynotes', 'friendnotes', 'create', 'update', 'delete'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
        ];
    }

    /**
     * Lists my Note models.
     * @return mixed
     */
    public function actionMynotes()
    {
        $searchModel = new NoteSearch();
        $dataProvider = $searchModel->search([
            'NoteSearch'=> [
                'creator' => Yii::$app->user->id
            ]
        ]);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Lists friend Note models.
     * @param int $id
     * @return mixed
     */
    public function actionFriendnotes($id)
    {
        $searchModel = new NoteSearch();
        $dataProvider = $searchModel->search([
            'NoteSearch' => [
                'creator' => $id,
                'access' => [
                    'user_id' => Yii::$app->user->id
                ]
            ]
        ]);

        return $this->render('friendnotes', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Note model.
     * @param $id
     * @return string
     * @throws ForbiddenHttpException
     * @throws NotFoundHttpException
     */
    public function actionView($id)
    {
        $model = $this->findModel($id);

        $result = Access::checkAccess($model);

        if($result)
        {
            switch($result) {
                case Access::ACCESS_CREATOR:
                    return $this->render('viewCreator', [
                        'model' => $model,
                    ]);
                break;
                case Access::ACCESS_GUEST:
                    return $this->render('viewGuest', [
                        'model' => $model,
                    ]);
                break;
            }
        }
        throw new ForbiddenHttpException("Not allowed! ");
    }

    /**
     * Creates a new Note model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Note();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Note model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param $id
     * @return string|\yii\web\Response
     * @throws ForbiddenHttpException
     * @throws NotFoundHttpException
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if(Access::checkIsCreator($model)) {
            if ($model->load(Yii::$app->request->post()) && $model->save()) {
                return $this->redirect(['view', 'id' => $model->id]);
            } else {
                return $this->render('update', [
                    'model' => $model,
                ]);
            }
        }
        throw new ForbiddenHttpException("Not allowed change note other user");
    }

    /**
     * Deletes an existing Note model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param $id
     * @return \yii\web\Response
     * @throws ForbiddenHttpException
     * @throws NotFoundHttpException
     * @throws \Exception
     */
    public function actionDelete($id)
    {
        $model = $this->findModel($id);
        if(Access::checkIsCreator($model)) {
            $model->delete();
            return $this->redirect(['index']);
        }
        throw new ForbiddenHttpException("Not allowed delete note other user");

    }

    /**
     * Finds the Note model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Note the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Note::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
