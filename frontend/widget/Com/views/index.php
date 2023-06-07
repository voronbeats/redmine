<?php
use vova07\imperavi\Widget;
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
    <?= $form->field($model, 'text')->widget(Widget::className(), [
        'settings' => [
            'lang' => 'ru',
            'minHeight' => 200,
            'formatting' => [
                'h1',
                'h2',
                'p',
                'blockquote'
            ],
            'plugins' => [
                'clips',
                'fullscreen',
                'video',
                'fontcolor',
                'fontfamily',
                'fontsize',
            ],
            'imageUpload' => \yii\helpers\Url::to(['/ajax/save-redactor-img', 'sub' => 'article']),
            'imageDelete' => \yii\helpers\Url::to(['/ajax/save-img-del']),
            'clips' => [
                ['Красный', '<span class="label-red">Здесь вставить текст</span>'],
                ['Зеленый', '<span class="label-green">Здесь вставить текст</span>'],
                ['Голубой', '<span class="label-blue">Здесь вставить текст</span>'],
            ],
        ],
    ])->label('Текст') ?>
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
        <?}?>
    <? }?>
<?php Pjax::end(); ?>
