<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\Progul $model */

$this->title = 'Обновить Прогул: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Прогулы', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Объявить';
?>
<div class="progul-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
