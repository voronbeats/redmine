<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\Progul $model */

$this->title = 'Объявить Прогул';
$this->params['breadcrumbs'][] = ['label' => 'Прогулы', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="progul-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'users' => $users
    ]) ?>

</div>
