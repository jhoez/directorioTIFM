<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $userextens frontend\models\Usuario */

$this->title = $userextens->nombuser;
$this->params['breadcrumbs'][] = ['label' => 'Administrar Usuarios', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="usuario-view">

    <h1 class="text-center">Usuario Extension registrado: (<?= Html::encode($this->title) ?>)</h1>

    <p>
        <?= Html::a('Registros', ['index'], ['class' => 'btn btn-primary']) ?>
    </p>

    <?= DetailView::widget([
        'model' => $userextens,
        'attributes' => [
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
                    return $data->getdepartamento()->nombdepart;
                }
            ],

            [
                'label'=>'Num. Extensión',
                'attribute'=>'numextens',
                'value'=>function($data){
                    return $data->getdepartamento()->getextension()->one()->numextens;
                }
            ],
            [
                'label'=>'Ubicación',
                'attribute'=>'ubicacion',
                'value'=>function($data){
                    return $data->getdepartamento()->getextension()->one()->ubicacion;
                }
            ],
        ],
    ]) ?>

</div>
