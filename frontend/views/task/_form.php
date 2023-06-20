<?php
use frontend\widget\Autocomplete;
use vova07\imperavi\Widget;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;
use common\models\User;

/** @var yii\web\View $this */
/** @var common\models\Task $model */
/** @var yii\widgets\ActiveForm $form */
$this->registerJsFile('/js/site.js', ['depends' => [\yii\web\JqueryAsset::className()]]);


$time = date_parse_from_format("Y-m-d H:iP ", $model->date_add);
$date = ($time['year'] . '-' . $time['month'] . '-' . $time['day'] . 'T' . $time['hour'] . ':' . $time['minute']);


$this->registerCssFile('/assest_all/calendar/jquery-ui.css');
$this->registerJsFile(
    '/assest_all/calendar/jquery-ui.js',
    ['depends' => [\yii\web\JqueryAsset::className()]]
);

?>
<div class="labor-costs-form container">
    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name_full')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'status')->dropDownList(\common\models\Task::STATUS) ?>

    <?= $form->field($model, 'prioritet')->dropDownList(\common\models\Task::PRIORITET) ?>

    <?= Autocomplete::widget(['task_id' => $model->parent_id, 'label' => 'Родительская задача']) ?>

    <?= $form->field($model, 'parent_id')->hiddenInput(['class' => 'form-control task-id'])->label(false) ?>

    <?= $form->field($model, 'date_add')->widget(\yii\widgets\MaskedInput::className(), ['mask' => '9999-99-99 99:99'])->textInput(['class' => 'form-control datepicker']) ?>

    <?= $form->field($model, 'date_end')->widget(\yii\widgets\MaskedInput::className(), ['mask' => '9999-99-99 99:99'])->textInput(['class' => 'form-control datepicker']) ?>

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

    <!-- <?= $form->field($model, 'ocenka_truda')->textInput(['maxlength' => true]) ?> -->

    <?= $form->field($model, 'user_id')->dropDownList($users) ?>

    <?= $form->field($model, 'readliness')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
    </div>
    <?php ActiveForm::end(); ?>
</div>