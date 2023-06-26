<?php
use vova07\imperavi\Widget;
use yii\widgets\Pjax;
use yii\helpers\Html;
use frontend\widget\Com\Com;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var common\models\Comments $model */
/** @var yii\widgets\ActiveForm $form */
?>
<?php Pjax::begin(); ?>
<div class="comments-form">
    <? if ($save) { ?>
        <div class="alert alert-success" role="alert">Комментарий сохранен</div>
    <? } else { ?>
        <?php $form = ActiveForm::begin(['options' => ['data-pjax' => true]]); ?>
        <span class="who"></span>
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
        ])->label('') ?>

        <?= $form->field($model, 'to')->hiddenInput(['value' => $modelTask->user_id])->label(false) ?>

        <?= $form->field($model, 'task_id')->hiddenInput(['value' => $modelTask->id])->label(false) ?>
        <div class="form-group">
            <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
        </div>

        <?php ActiveForm::end(); ?>
    <? } ?>
</div>

<? if ($comments) { ?>
    <? foreach ($comments as $com) { ?>
        <? if ($com->user->id == Yii::$app->user->identity->id) { ?>
            <div class="com-container">
                <span class="user-commnets-to" data-id="<?= $com->user->id ?>"><? if ($com->user->id) { ?>Вы:<? } ?></span> 
                <i class="fa fa-pencil redact" aria-hidden="true"></i>
                <span>
                    <?= $com->text ?>
                </span>
            </div>
        <? } else { ?>
            <div class="com-container-our">
                <span class="user-commnets-to" data-id="<?= $com->user->id ?>"><?= $com->user->username ?>:</span>
                <span>
                    <?= $com->text ?>
                </span>
            </div>
        <? } ?>
    <? } ?>
<? } ?>


<?php Pjax::end(); ?>