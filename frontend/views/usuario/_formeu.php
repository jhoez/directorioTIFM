<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $user frontend\models\Usuario */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="row clearfix">
    <div class="col-md-offset-3 col-md-6">
        <div class="usuario-form">
            <?php $form = ActiveForm::begin(); ?>
            <div class="form-group">
                <div class="">
                    <?= $form->field($userextens, 'nombuser')->textInput(['maxlength' => true]) ?>
                </div>
            </div>
            <div class="form-group">
                <?= Html::label('Departamento', 'nombdepart', ['class' => ''])?>
                <div class="">
                    <?= Html::activeDropDownList(
                        $departamento,'nombdepart',
                        ArrayHelper::map($arrayDepart, 'nombcata', 'nombcata'),
                        [
                            'prompt' => '---- Seleccione ----',
                            'class' => 'form-control imput-md',
                        ]
                    )?>
                </div>
            </div>
            <div class="form-group">
                <div class="">
                    <?= $form->field($telfextension, 'numextens')->textInput(['maxlength' => true]) ?>
                </div>
            </div>
            <div class="form-group">
                <?= Html::label('Ubicación', 'ubicacion', ['class' => ''])?>
                <div class="">
                    <?= Html::activeDropDownList(
                        $telfextension,'ubicacion',
                        ArrayHelper::map($arrayUbic, 'nombcata', 'nombcata'),
                        [
                            'prompt' => '---- Seleccione ----',
                            'class' => 'form-control imput-md',
                        ]
                    )?>
                </div>
            </div>
            <div class="form-group">
                <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
            </div>
            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>
