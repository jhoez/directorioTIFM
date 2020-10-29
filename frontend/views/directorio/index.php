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

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Departamento', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php //echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            [
                'label'=>'Usuario',
                'attribute'=>'nombuser',
                'value'=>function($data){
                    return $data->user;
                },
            ],
            [
                'label'=>'Departamento',
                'attribute'=>'nombdepart',
                //'filter'=>ArrayHelper::map($modelArray, 'id', 'campo'),
                'value'=>function($data){
                    return $data->nombdepart;
                },
            ],
            [
                'label'=>'Ubicacion',
                'attribute'=>'ubicacion',
                'filter'=>[
                    0=>'Isla',
                    1=>'Caracas',
                ],
                'value'=>function($data){
                    return $data->ubicacion;
                },
            ],
            [
                'label'=>'Extension',
                'attribute'=>'numextens',
                'value'=>function($data){
                    return $data->numextens;
                },
            ],
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
