<?php

use common\models\Archive;
use common\models\Performance;
use yii\helpers\Html;
use yii\grid\GridView;
?>
<h2>Archive Ordering</h2>
<table id="archiveOrdering" class="table table-bordered table-striped sortableTables">
    <thead>
    <tr>
        <th scope="col">Id</th>
        <th scope="col">Archive id (Year)</th>
        <th scope="col">Performance</th>
        <th scope="col">Ordering</th>
    </tr>
    </thead>
    <tbody>
    <?php foreach ($model as $key=>$value): ?>
        <tr data-key="<?= $value->id;?>">
            <th scope="row"><?= $key + 1; ?></th>
            <td><?= Archive::find()->where(['id' => $value->archive_id])->one()['title'] ?></td>
            <td><?= Performance::find()->where(['id' => $value->performance_id])->one()['title']; ?></td>
            <td><?= $value->ordering; ?></td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>
