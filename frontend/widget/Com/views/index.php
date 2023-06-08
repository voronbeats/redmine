<?php
use yii\widgets\Pjax;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
/** @var yii\web\View $this */
/** @var common\models\Comments $model */
/** @var yii\widgets\ActiveForm $form */
?>
<?php Pjax::begin(); ?>
<div class="comments-form">
<?if($save) {?>
    <div class="alert alert-success" role="alert">Комментарий сохранен</div>
<?}else{?>
    <?php $form = ActiveForm::begin(['options' => ['data-pjax' => true]]); ?>
    <?= $form->field($model, 'text')->textarea(['rows' => 6]) ?>
    <?= $form->field($model, 'task_id')->hiddenInput(['value' => Yii::$app->request->get('id')])->label(false) ?>
    <div class="form-group">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>
<?}?>
</div>
    <? if($comments) {?>
        <?foreach ($comments as $com) {?>
            <?=$com->text?><br>
            <?=$com->author->username?><br>
        <?}?>
    <? }?>
<?php Pjax::end(); ?>
