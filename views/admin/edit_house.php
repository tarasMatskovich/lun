<?php
use yii\helpers\Url;
use yii\helpers\Html;
?>

<h1>Редактирование дома: <a href="<?=Url::to(['admin/showhouse', 'id' => $house->id])?>"><?=$house->title?></a></h1>

<?php if( Yii::$app->session->hasFlash('error') ): ?>
    <div class="alert alert-danger alert-dismissible" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <?php echo Yii::$app->session->getFlash('error'); ?>
    </div>
<?php endif;?>

<form action="<?=Url::to(['admin/updatehouse', 'id' => $house->id])?>" method="post">
    <div class="form-group">
        <label for="name">Название дома:</label>
        <input type="text" name="title" id="name" placeholder="Название" class="form-control" value="<?=$house->title?>">
    </div>
    <?=Html::hiddenInput(\Yii :: $app->getRequest()->csrfParam, \Yii :: $app->getRequest()->getCsrfToken(), [])?>
    <div class="form-group">
        <button class="btn btn-success">Сохранить</button>
    </div>
</form>
