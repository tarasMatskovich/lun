<?php

?>

<h1 class="title">Список новостроек</h1>

<?php if( Yii::$app->session->hasFlash('success') ): ?>
    <div class="alert alert-success alert-dismissible" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <?php echo Yii::$app->session->getFlash('success'); ?>
    </div>
<?php endif;?>

<a class="btn btn-success" href="<?=\yii\helpers\Url::to(['admin/add'])?>">Добавить</a>

<table class="table buildings-list">
    <thead>
    <tr>
        <th scope="col">Название</th>
        <th scope="col">Город</th>
        <th scope="col">Количество домов</th>
        <th scope="col">Действия</th>
    </tr>
    </thead>
    <tbody>
    <?php foreach ($buildings as $building):?>
        <tr>
            <td>
                <a href="<?=\yii\helpers\Url::to(['admin/show', 'id' => $building->id])?>"><?=$building->title?></a>
            </td>
            <td>
                <?=$building->city?>
            </td>
            <td>
                <?=count($building->houses)?>
            </td>
            <td class="actions">
                <a href="<?=\yii\helpers\Url::to(['admin/show', 'id' => $building->id])?>">
                    <i class="fas fa-eye"></i>
                </a>
                &nbsp;&nbsp;
                <a href="<?=\yii\helpers\Url::to(['admin/edit', 'id' => $building->id])?>">
                    <i class="fas fa-edit"></i>
                </a>
                &nbsp;&nbsp;
                <a href="<?=\yii\helpers\Url::to(['admin/delete', 'id' => $building->id])?>">
                    <i class="fas fa-trash-alt"></i>
                </a>
            </td>
        </tr>
    <?php endforeach;?>
    </tbody>
</table>
