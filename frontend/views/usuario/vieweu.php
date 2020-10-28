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

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Registros', ['index'], ['class' => 'btn btn-primary']) ?>
    </p>

    <?= DetailView::widget([
        'model' => $userextens,
        'attributes' => [
            [
                'attribute'=>'nombuser',
                'value'=>function($data){
                    return $data->nombuser;
                }
            ],
        ],
    ]) ?>

</div>
