<?php
/* @var $this yii\web\View */
?>
<h1>Административная панель</h1>

<div class="list-group">
    <a href="<?=\yii\helpers\Url::to(['admin/list'])?>" class="list-group-item list-group-item-action active">
        Список новостроек
    </a>
    <a href="<?=\yii\helpers\Url::to(['admin/add'])?>" class="list-group-item list-group-item-action">Добавить новостройку</a>
</div>
