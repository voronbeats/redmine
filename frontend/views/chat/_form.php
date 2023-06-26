<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\widgets\Pjax;

/** @var yii\web\View $this */
/** @var common\models\Chat $model */
/** @var yii\widgets\ActiveForm $form */


?>
<?php Pjax::begin(); ?>

<?php $form = ActiveForm::begin([
    'options' => ['data-pjax' => true],
]) ?>

<?= $form->field($model, 'to')->hiddenInput(['class' => 'form-control'])->label(false) ?>

<<?= $form->field($model, 'to')->textInput() ?>

    <?= $form->field($model, 'from')->textInput() ?>

    <?= $form->field($model, 'date_add')->textInput() ?>

    <?= $form->field($model, 'text')->textInput() ?>

    <?= $form->field($model, 'parent_text')->textInput() ?>


    <?= Html::submitButton('Отправить', ['class' => 'btn btn-success enter']) ?>

    <?php ActiveForm::end(); ?>

    <?php Pjax::end(); ?>