<?php

use yii\helpers\Html;

$this->title = 'Crear Usuario Extension';
$this->params['breadcrumbs'][] = ['label' => 'Administrar Usuarios', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="usuario-create">
    <p>
        <?= Html::a('Registros', ['index'], ['class' => 'btn btn-primary']) ?>
    </p>

    <h1 class="text-center"><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_formeu', [
        'userextens' => $userextens,
        'departamento' => $departamento,
        'telfextension' => $telfextension,
        'arrayDepart'=>$arrayDepart,
        'arrayUbic'=>$arrayUbic
    ]) ?>

</div>
