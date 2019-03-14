<?php
use yii\helpers\Url;
use yii\helpers\Html;
?>

<h1>Редактирование новостройки: <a href="<?=Url::to(['admin/list', 'id' => $building->id])?>"><?=$building->title?></a></h1>

<?php if( Yii::$app->session->hasFlash('error') ): ?>
    <div class="alert alert-danger alert-dismissible" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <?php echo Yii::$app->session->getFlash('error'); ?>
    </div>
<?php endif;?>

<form method="POST" action="<?=Url::to(['admin/update', 'id' => $building->id])?>">
    <div class="form-group">
        <label for="name">Название новостройки: </label>
        <input type="text" class="form-control" id="name" name="title" placeholder="Название" value="<?=$building->title?>">
    </div>
    <div class="form-group">
        <label for="city">Город новостройки: </label>
        <input type="text" class="form-control" id="city" name="city" placeholder="Город" value="<?=$building->city?>">
    </div>
    <?=Html::hiddenInput(\Yii :: $app->getRequest()->csrfParam, \Yii :: $app->getRequest()->getCsrfToken(), [])?>
    <div class="form-group">
        <button class="btn btn-success" >Сохранить</button>
    </div>
</form>
