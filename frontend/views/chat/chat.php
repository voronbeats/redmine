<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\widgets\Pjax;

/** @var yii\web\View $this */
/** @var common\models\Chat $model */
/** @var yii\widgets\ActiveForm $form */
$this->registerJsFile('/js/site.js', ['depends' => [\yii\web\JqueryAsset::className()]]);
?>

<?php Pjax::begin(); ?>

<div class="container chat-gpt">
    <div class="col-md-12">
        <div class="col-md-2 lc-to ">
            <span class="lc-text">
                <? foreach ($users as $res => $us) { ?>
                    <span class="user">
                        <?if($us->id != Yii::$app->user->id) {?>
                            <img src="/frontend/web/images/bg-pattern-boxed.png" width="50px">
                            <span>
                                    <? $mr = mb_strimwidth($us->username, 0, 9, "..");?>
                                    <span class="client" data-client="<?=$us->id?>"><?=$mr?></span>             
                            </span>
                        <?}?>
                    </span>
                    
                <? } ?>
            </span>
        </div>
        <div class="col-md-10 lc">
            <? if ($message) { ?>
                <ul class=" ">
                    <? foreach ($message as $res => $mess) { ?>

                        <? $date = date('H:i', strtotime($mess->date_add)); ?>
                        <li class="cont-chat-gpt">
                            <div class="chat <? if ($mess->from == Yii::$app->user->id) {
                                echo 'to';
                            } ?>">
                                <div class="users-chat" ?>
                                    <? if ($mess->from) { ?>
                                        <? if ($mess->from != Yii::$app->user->id) { ?>
                                            <span>
                                                <?= $mess->users->username ?>
                                            </span>
                                        <? } else { ?>
                                            <? echo 'Вы:' ?>
                                        <? } ?>
                                        <? if ($mess->from != Yii::$app->user->id) { ?>
                                            <span class="answer" data-id="<?= $mess->from ?>"
                                                data-id-text="<?= $mess->id ?>">Ответить</span>
                                        <? } ?>
                                    <? } ?>
                                </div>
                                <div class="text-chat" ?>
                                    <span>
                                        <?= $mess->text; ?>
                                    </span>

                                    <? if ($mess->parents) { ?>
                                        <div class="parent-text">
                                            <span><?= $mess->names->username ?>:</span>
                                            <span><?= $mess->parents->text ?></span>

                                        </div>
                                    <? } ?>
                                </div>
                                <div class="date-chat">

                                    <span class="<? if ($mess->from == Yii::$app->user->id) {
                                        echo 'to-date';
                                    } else {
                                        echo 'date';
                                    } ?>">
                                        <?= $date ?>
                                    </span>

                                </div>
                            </div>
                        </li>
                    <? } ?>
                </ul>
            <? } ?>
        </div>
    </div>
</div>

<?php $form = ActiveForm::begin([
    'options' => ['data-pjax' => true],
]) ?>

<?= $form->field($model, 'to')->hiddenInput(['class' => 'form-control'])->label(false) ?>

<?= $form->field($model, 'parent')->hiddenInput()->label(false) ?>

<!-- <?= $form->field($model, 'to')->textInput() ?>

    <?= $form->field($model, 'from')->textInput() ?>

    <?= $form->field($model, 'date_add')->textInput() ?>  -->

<div class="container">
    <span class="username">

    </span>
    <div class="chat-ds">

        <?= $form->field($model, 'text', ['template' => "{label}\n{input}"])->textInput(['autocomplete' => 'off']) ?>
        <?= Html::submitButton('Отправить', ['class' => 'btn btn-success enter']) ?>

    </div>
</div>

<?php ActiveForm::end(); ?>

<?php Pjax::end(); ?>