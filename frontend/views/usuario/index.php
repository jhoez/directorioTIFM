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
        <?= Html::a('Administrar Usuario', ['/admin'], ['class' => 'btn btn-primary']) ?>
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
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

    <h3 class="text-center">Usuarios de extension registrados</h3>
    <?= GridView::widget([
        'dataProvider' => $extdataProvider,
        'filterModel' => $extsearchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            [
                'label'=>'Usuario Extension',
                'attribute'=>'nombuser',
                'value'=>function($data){
                    return $data->nombuser;
                }
            ],
            [
                'label'=>'Departamento',
                'attribute'=>'nombdepart',
                'value'=>function($data){
                    return $data->getdepartamento()->nombdepart;
                }
            ],
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
