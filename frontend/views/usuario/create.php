<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\Usuario */

$this->title = 'Crear Usuario';
$this->params['breadcrumbs'][] = ['label' => 'Administrar Usuarios', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="usuario-create">
    <p>
        <?= Html::a('Registros', ['index'], ['class' => 'btn btn-primary']) ?>
    </p>

    <h1 class="text-center"><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'user' => $user,
    ]) ?>

</div>
