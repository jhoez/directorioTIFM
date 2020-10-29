<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\jui\DatePicker;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\UsuarioSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Administrar Usuarios';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="usuario-index">

    <h1 class="text-center"><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Crear Usuario', ['create'], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Crear Usuario extension', ['createuserextens'], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Roles y Permisos', ['/admin'], ['class' => 'btn btn-primary']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <h3 class="text-center">Usuario Registrados</h3>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            [
                'label'=>'Usuario',
                'attribute'=>'username',
                'value'=>function($data){
                    return $data->username;
                }
            ],
            [
                'label'=>'Password',
                'attribute'=>'password',
                'value'=>function($data){
                    return $data->password;
                }
            ],
            [
                'label'=>'Email',
                'attribute'=>'email',
                'value'=>function($data){
                    return $data->email;
                }
            ],
            [
                'label'=>'Status Usuario',
                'attribute'=>'status',
                'filter'=>[
                    0=>'Inactivo',
                    1=>'Activo'
                ],
                'value'=>function($data){
                    return $data->status == 1 ? 'Usuario Activo' : 'Usuario Inactivo';
                }
            ],
            [
                'label'=>'F. creado',
                'attribute'=>'created_at',
                'filter'=> DatePicker::widget([
                    'model' => $searchModel,
                    'attribute' => 'created_at',
                    'language' => 'es',
                    'dateFormat' => 'yyyy-MM-dd',
                ]),
                'value'=>function($data){
                    return $data->created_at;
                }
            ],
            [
                'class' => 'yii\grid\ActionColumn',
                'header'=>'Acción',
                'headerOptions'=>['width'=>'70'],
                'template'=>'{view}{update}{delete}',
                'buttons'=> [
                    'view' => function($url,$model){
                        return Html::a(
                            '<span class="glyphicon glyphicon-eye-open"></span>',
                            $url
                        );
                    },
                    'update' => function($url,$model){
                        if ( \Yii::$app->user->can('administrador') ) {
                            return Html::a(
                                '<span class="glyphicon glyphicon-pencil"></span>',
                                $url
                            );
                        }else {
                        }
                    },
                    'delete' => function($url,$model){
                        if ( \Yii::$app->user->can('administrador') ) {
                            return Html::a(
                                '<span class="glyphicon glyphicon-remove"></span>',
                                $url
                            );
                        }else {
                        }
                    },
                ],
            ],
        ],
    ]); ?>

    <h3 class="text-center">Usuarios de extension registrados</h3>
    <?=Html::beginForm(['/site/generarpdf'],'post');?>
    <?=Html::submitButton(
        "Generar PDF",
        ['class' => 'btn btn-primary']
    );?>
    <?= GridView::widget([
        'dataProvider' => $extdataProvider,
        'filterModel' => $extsearchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            [
                'label'=>'Usuario Extensión',
                'attribute'=>'nombuser',
                'value'=>function($data){
                    return $data->nombuser;
                }
            ],
            [
                'label'=>'Nomb. Departamento',
                'attribute'=>'nombdepart',
                'value'=>function($data){
                    return $data->getdepartamento()->one()->nombdepart;
                }
            ],

            [
                'label'=>'Num. Extensión',
                'attribute'=>'numextens',
                'value'=>function($data){
                    return $data->getdepartamento()->one()->getextension()->one()->numextens;
                }
            ],
            [
                'label'=>'Ubicación',
                'attribute'=>'ubicacion',
                'value'=>function($data){
                    return $data->getdepartamento()->one()->getextension()->one()->ubicacion;
                }
            ],
            [
                'class' => 'yii\grid\ActionColumn',
                'header'=>'Acción',
                'headerOptions'=>['width'=>'70'],
                'template'=>'{vieweu}{updateeu}{deleteeu}',
                'buttons'=> [
                    'vieweu' => function($url,$model){
                        return Html::a(
                            '<span class="glyphicon glyphicon-eye-open"></span>',
                            $url
                        );
                    },
                    'updateeu' => function($url,$model){
                        if ( Yii::$app->user->can('administrador') ) {
                            return Html::a(
                                '<span class="glyphicon glyphicon-pencil"></span>',
                                $url
                            );
                        }else {
                        }
                    },
                    'deleteeu' => function($url,$model){
                        if ( Yii::$app->user->can('administrador') ) {
                            return Html::a(
                                '<span class="glyphicon glyphicon-remove"></span>',
                                $url
                            );
                        }else {
                        }
                    },
                ],
            ],
        ],
    ]); ?>
</div>
