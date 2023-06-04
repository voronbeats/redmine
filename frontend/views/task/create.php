<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\Task $model */

$this->title = 'Создание задачи';
$this->params['breadcrumbs'][] = ['label' => 'Tasks', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="task-create container">

    <h1 style="font-weight: 400;"><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
         'users' => $users,
        'model' => $model,
    ]) ?>

</div>
