<?php

namespace frontend\controllers;

use Yii;
use frontend\models\Usuario;
use frontend\models\UsuarioSearch;
use frontend\models\Userextens;
use frontend\models\UserextensSearch;
use frontend\models\Departamento;
use frontend\models\DepartamentoSearch;
use frontend\models\Telfextension;
use frontend\models\Catalogo;
use frontend\models\TelfextensionSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\base\ErrorException;

/**
 * UsuarioController implements the CRUD actions for Usuario model.
 */
class UsuarioController extends Controller
{
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
        ];
    }

    /**
     * Lists all Usuario models.
     * @return mixed
     */
    public function actionIndex()
    {

        $searchModel = new UsuarioSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $extsearchModel = new UserextensSearch();
        $extdataProvider = $extsearchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'extsearchModel' => $extsearchModel,
            'extdataProvider' => $extdataProvider,
        ]);
    }

    /**
     * Displays a single Usuario model.
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
     * Creates a new Usuario model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreateuserextens()
    {
        $userextens = new Userextens;
        $departamento = new Departamento;
        $telfextension = new Telfextension;
        $arrayDepart = Catalogo::find()->asArray()->where(['idpadre'=>1])->all();
        $arrayUbic = Catalogo::find()->asArray()->where(['idpadre'=>42])->all();

        if (
            $userextens->load(Yii::$app->request->post()) &&
            $departamento->load(Yii::$app->request->post()) &&
            $telfextension->load(Yii::$app->request->post())
        ) {
            //echo "<pre>";var_dump( Yii::$app->request->post() );die;
            if (
                $userextens->validate() &&
                $departamento->validate() &&
                $telfextension->validate()
            ) {
                $transaction = $telfextension->db->beginTransaction();
                try {

                    if ( $userextens->save() ) {
                        $departamento->fkuser = $userextens->iduserextens;
                        if ( $departamento->save() ) {
                            $telfextension->fkdepart = $departamento->iddepart;
                            if ( $telfextension->save() ) {
                                $transaction->commit();
                                return $this->redirect(['vieweu', 'id' => $userextens->iduserextens]);
                            }
                        }
                    }
                } catch (ErrorException $e) {
                    echo "<pre>";var_dump($e);die;
                    $transaction->rollBack();
                }

            }
        }

        return $this->render('createeu', [
            'userextens' => $userextens,
            'departamento' => $departamento,
            'telfextension' => $telfextension,
            'arrayDepart'=>$arrayDepart,
            'arrayUbic'=>$arrayUbic
        ]);
    }

    /**
     * Creates a new Usuario model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $user = new Usuario;

        if ( $user->load(Yii::$app->request->post()) ) {
            if ( $user->validate() ) {
                $user->generateAuthKey();
                $user->generatePasswordResetToken();
                $user->created_at = date( "Y-m-d h:i:s",time() );//strftime("%Y-%m-%d %I:%M:%S")
                $user->generateEmailVerificationToken();

                /*
                // se asigna por defecto el role tutor al usuario creado.
                $auth = Yii::$app->authManager;
                $tutorRole = $auth->getRole('tutor');
                $auth->assign($tutorRole, $user->getId());
                */
                if ( $user->save() ) {
                    return $this->redirect(['view', 'id' => $user->iduser]);
                }
            }
        }

        return $this->render('create', [
            'user' => $user,
        ]);
    }

    /**
     * Updates an existing Usuario model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->iduser]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Usuario model.
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
     * Finds the Usuario model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Usuario the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Usuario::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
