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
use yii\filters\AccessControl;
use yii\base\ErrorException;
use yii\helpers\HtmlPurifier;

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
                    'delete' => ['GET'],
                ],
            ],
            'access'=>[
                'class'=> AccessControl::className(),
                'only'=> ['index','create','update','updateeu','delete','deleteeu','view','vieweu','create','createuserextens'],
                'rules'=>[
                    [
                        'allow'=>true,
                        'actions'=>['index','create','update','updateeu','delete','deleteeu','view','vieweu','create','createuserextens'],
                        'roles'=>['@'],
                        /*'denyCallback' => function ($rule, $action) {
                            throw new \Exception('No tienes los suficientes permisos para acceder a esta página');
                        }*/
                    ],
                ],
            ]
        ];
    }

    /**
     * Lists all Usuario models.
     * @return mixed
     */
    public function actionIndex()
    {
        $arrayDepart = Catalogo::find()->asArray()->where(['idpadre'=>1])->all();
        $arrayUbic = Catalogo::find()->asArray()->where(['idpadre'=>2])->all();
        $searchModel = new UsuarioSearch;
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $extsearchModel = new DepartamentoSearch;
        $extdataProvider = $extsearchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'extsearchModel' => $extsearchModel,
            'extdataProvider' => $extdataProvider,
            'arrayDepart' => $arrayDepart,
            'arrayUbic' => $arrayUbic
        ]);
    }

    /**
     * Displays a single Usuario model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView()
    {
        $purifier = new HtmlPurifier;
        $resultado = $purifier->process( Yii::$app->request->get('id') );
        return $this->render('view', [
            'model' => $this->findModel($resultado),
        ]);
    }

    /**
     * Displays a single Usuario model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionVieweu($id)
    {
        $purifier = new HtmlPurifier;
        $resultado = $purifier->process( Yii::$app->request->get('id') );
        return $this->render('vieweu', [
            'userextens' => Userextens::findOne($resultado),
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
        $arrayDepart = Catalogo::find()->asArray()->where(['idpadre'=>1])->all();// departamento
        $arrayUbic = Catalogo::find()->asArray()->where(['idpadre'=>2])->all();// ubicacion

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
                $user->status=1;
                $user->created_at = date( "Y-m-d h:i:s",time() );//strftime("%Y-%m-%d %I:%M:%S")

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
    public function actionUpdate()
    {
        $purifier = new HtmlPurifier;
        $result = (integer)$purifier->process(Yii::$app->request->get('id'));
        $user = Usuario::findOne($result);

        if ( $user->load(Yii::$app->request->post()) ) {
            if ( $user->validate() ) {
                $user->updated_at = date( "Y-m-d h:i:s",time() );//strftime("%Y-%m-%d %I:%M:%S")
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
    public function actionUpdateeu()
    {
        $purifier = new HtmlPurifier;
        $result = (integer)$purifier->process(Yii::$app->request->get('id'));
        $userextens = Userextens::findOne($result);
        $departamento = Departamento::find()->where(['fkuser'=>$userextens->iduserextens])->one();
        $telfextension = Telfextension::find()->where(['fkdepart'=>$departamento->iddepart])->one();
        $arrayDepart = Catalogo::find()->asArray()->where(['idpadre'=>1])->all();
        $arrayUbic = Catalogo::find()->asArray()->where(['idpadre'=>2])->all();

        if (
            $userextens->load(Yii::$app->request->post()) &&
            $departamento->load(Yii::$app->request->post()) &&
            $telfextension->load(Yii::$app->request->post())
        ) {
            //*echo "<pre>";var_dump( Yii::$app->request->post() );die;
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

        return $this->render('updateeu', [
            'userextens' => $userextens,
            'departamento' => $departamento,
            'telfextension' => $telfextension,
            'arrayDepart'=>$arrayDepart,
            'arrayUbic'=>$arrayUbic
        ]);
    }

    /**
     * Deletes an existing Usuario model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete()
    {
        $purifier = new HtmlPurifier;
        $result = (integer)$purifier->process(Yii::$app->request->get('id'));
        $this->findModel($result)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Deletes an existing Usuario model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDeleteeu()
    {
        $purifier = new HtmlPurifier;
        $result = (integer)$purifier->process(Yii::$app->request->get('id'));
        $userextens = Userextens::findOne($result);
        $departamento = Departamento::find()->where(['fkuser'=>$userextens->iduserextens])->one();
        $telfextension = Telfextension::find()->where(['fkdepart'=>$departamento->iddepart])->one();

        if ($userextens !== null) {
            $telfextension->delete();
            $departamento->delete();
            $userextens->delete();
        }

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
