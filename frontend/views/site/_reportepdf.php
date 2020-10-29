<?php if($departamento !== null):?>
<div class="">
    <img class="imgheader" src="<?=Yii::$app->request->baseUrl.'/img/cintillotifm.jpg'?>" alt="">
</div>
<br>
<div class="text-right"><b>Reporte Fecha: </b><?=date("d/m/Y");?></div>
<br>
<div class="">
    <table class="table table-bordered">
        <thead>
            <tr>
                <th style="background-color:#28a745;">Usuario Extension</th>
                <th>Departamento</th>
                <th>Ubicación</th>
                <th>Extensión</th>
            </tr>
        </thead>
        <?php foreach($departamento as $data): ?>
            <tbody>
                <tr>
                    <td><?=$data->getuser()->nombuser;?></td>
                    <td><?=$data->nombdepart;?></td>
                    <td><?=$data->getextension()->one()->ubicacion;?></td>
                    <td><?=$data->getextension()->one()->numextens;?></td>
                </tr>
            </tbody>
        <?php endforeach; ?>
    </table>
</div>
<?php endif;?>
