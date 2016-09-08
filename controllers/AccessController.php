<?php

namespace app\controllers;

use app\models\Note;
use app\models\User;
use Yii;
use app\models\Access;
use app\models\search\AccessSearch;
use yii\filters\AccessControl;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\web\ForbiddenHttpException;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * AccessController implements the CRUD actions for Access model.
 */
class AccessController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['index', 'friendslist', 'create', 'update', 'delete'],
                'rules' => [
                    [
                        'actions' => ['index', 'friendslist', 'create', 'update', 'delete'],
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
     * Lists all Access models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new AccessSearch();
        $dataProvider = $searchModel->searchIndex(
            Yii::$app->request->queryParams
        );

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Lists all Access models.
     * @return mixed
     */
    public function actionFriendslist()
    {
        $searchModel = new AccessSearch();
        $dataProvider = $searchModel->searchFriends(
            Yii::$app->request->queryParams
        );

        return $this->render('friendslist', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Access model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Access model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @param $id
     * @return string|\yii\web\Response
     * @throws BadRequestHttpException
     * @throws ForbiddenHttpException
     */
    public function actionCreate($id)
    {
        $note = Note::findOne($id);
        if(!$note)
            throw new BadRequestHttpException("Not exists note!");

        if($note->creator == Yii::$app->user->id) {

            $model = new Access();

            $usersForAutocomplete = User::find()
                ->selectForAutocomplite()
                ->notCurrent()
                ->asArray()
                ->all();

            $model->load(Yii::$app->request->post());
            $model->note_id = $id;

            if ($model->validate() && $model->save()) {
                return $this->redirect(['view', 'id' => $model->id]);
            } else {
                return $this->render('create', [
                    'model' => $model,
                    'usersForAutocomplete' => $usersForAutocomplete
                ]);
            }
        }
        throw new ForbiddenHttpException("Not allowed share notes other people!");
    }

    /**
     * Updates an existing Access model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        $usersForAutocomplete = User::find()
            ->selectForAutocomplite()
            ->notCurrent()
            ->asArray()
            ->all();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
                'usersForAutocomplete' => $usersForAutocomplete
            ]);
        }
    }

    /**
     * Deletes an existing Access model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Access model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Access the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Access::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
