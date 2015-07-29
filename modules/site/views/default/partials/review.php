<?php

/* @var $model app\models\ext\Review */
?>

<div class="well rating-<?= $model->rating ?>">
    <h4><?= $model->author ?> <small><?= date('d.m.Y',  strtotime($model->created_at)) ?></small></h4>

    <p><?= $model->message ?></p>
</div>