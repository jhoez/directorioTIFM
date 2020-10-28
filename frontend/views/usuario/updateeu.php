<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\Usuario */

$this->title = 'Actualizar Usuario extensión: ' . $userextens->nombuser;
$this->params['breadcrumbs'][] = ['label' => 'Usuarios', 'url' => ['index']];
$this->params['breadcrumbs'][] = 'Actualizar';
?>
<div class="usuario-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'userextens' => $userextens,
        'departamento' => $departamento,
        'telfextension' => $telfextension,
    ]) ?>

</div>
