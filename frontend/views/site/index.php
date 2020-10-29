<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\DepartamentoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Directorio';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-index">

    <?php //echo $this->render('_search', ['model' => $searchModel]); ?>

    <h1 class="text-center">Usuarios y extensión</h1>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            [
                'label'=>'Usuario',
                'attribute'=>'nombuser',
                'value'=>function($data){
                    return $data->getuser()->nombuser;
                },
            ],
            [
                'label'=>'Departamento',
                'attribute'=>'nombdepart',
                'filter'=>ArrayHelper::map($arrayDepart, 'nombcata', 'nombcata'),
                'value'=>function($data){
                    return $data->nombdepart;
                },
            ],
            [
                'label'=>'Ubicación',
                'attribute'=>'ubicacion',
                'filter'=>ArrayHelper::map($arrayUbic, 'nombcata', 'nombcata'),
                'value'=>function($data){
                    return $data->getextension()->one()->ubicacion;
                },
            ],
            [
                'label'=>'Extensión',
                'attribute'=>'numextens',
                'value'=>function($data){
                    return $data->getextension()->one()->numextens;
                },
            ],
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]);?>


</div>
