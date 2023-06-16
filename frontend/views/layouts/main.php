<?php

/** @var \yii\web\View $this */
/** @var string $content */

use frontend\widget\Notification\Notif;
use common\widgets\Alert;
use frontend\assets\AppAsset;
use yii\bootstrap4\Breadcrumbs;
use yii\bootstrap4\Html;
use yii\bootstrap4\Nav;
use yii\bootstrap4\NavBar;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>" class="h-100">

<head>
  <meta charset="<?= Yii::$app->charset ?>">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <?php $this->registerCsrfMetaTags() ?>
  <title>
    <?= Html::encode($this->title) ?>
  </title>
  <?php $this->head() ?>
</head>

<body class="d-flex flex-column h-100">
  <?php $this->beginBody() ?>


  <header class="section page-header">
    <!-- RD Navbar-->
    <div class="rd-navbar-wrap">
      <nav class="rd-navbar rd-navbar-classic" data-layout="rd-navbar-fixed" data-sm-layout="rd-navbar-fixed"
        data-md-layout="rd-navbar-fixed" data-md-device-layout="rd-navbar-fixed" data-lg-layout="rd-navbar-static"
        data-lg-device-layout="rd-navbar-fixed" data-xl-layout="rd-navbar-static"
        data-xl-device-layout="rd-navbar-static" data-xxl-layout="rd-navbar-static"
        data-xxl-device-layout="rd-navbar-static" data-lg-stick-up-offset="46px" data-xl-stick-up-offset="46px"
        data-xxl-stick-up-offset="46px" data-lg-stick-up="true" data-xl-stick-up="true" data-xxl-stick-up="true">
        <div class="rd-navbar-main-outer">
          <div class="rd-navbar-main">
            <!-- RD Navbar Panel-->
            <div class="rd-navbar-panel">
              <!-- RD Navbar Toggle-->
              <button class="rd-navbar-toggle" data-rd-navbar-toggle=".rd-navbar-nav-wrap"><span></span></button>
              <!-- RD Navbar Brand-->
              <div class="rd-navbar-brand ">
                  <a class="brand" href="/">
                    <i class="fa fa-cube" aria-hidden="true"></i>
                  </a>
              </div>
              </div>
            <div class="rd-navbar-main-element">
              <div class="rd-navbar-nav-wrap">
                <!-- RD Navbar Share-->

                <ul class="rd-navbar-nav">
                  <li class="rd-nav-item">
                     <a class="rd-nav-link" href="/"><i class="fa fa-home" aria-hidden="true"></i>  Список задач</a></li>
                  <li class="rd-nav-item">
                    <a class="rd-nav-link" href="/labor-costs/statics"><i class="fa fa-line-chart" aria-hidden="true"></i> Статистика</a>
                  </li>
                  <? if (!Yii::$app->user->isGuest) { ?>
                  <li class="rd-nav-item">
                        <a style="margin-left: 5px; margin-right: 5px;" class="rd-nav-link" href="/task/user"><i class="fa fa-user"></i>  Мои задачи</a>
                  </li>
                  <? } ?>
                  <li class="rd-nav-item"> <a class="rd-nav-link" href="/labor-costs"><i class="fa fa-book" aria-hidden="true"></i> Трудозатраты</a>
                  </li>
                  <li class="rd-nav-item">
                    <? if (!Yii::$app->user->isGuest) { ?>
                    
                        <?= Html::a(
                          '<i class="fa fa-times" aria-hidden="true"></i> Выход',
                          ['/site/logout'],
                          ['data-method' => 'post', 'class' => 'rd-nav-link']
                        ) ?>
                    <? } else { ?>
                      <a class="rd-nav-link" href="/site/login">Войти</a>
                    <? } ?>
                  </li>
                </ul>
                
              </div>
              <? if (!Yii::$app->user->isGuest) { ?>
                <div class="add-adaptive">
                      <div class="not-div-class">
                         <?= Notif::widget() ?>
                      </div>
                      <div class="not-a">
                         <a class="btn btn-success success" href="/task/create">
                          <i class="fa fa-pencil " aria-hidden="true"></i> Создание задачи</a>
                      </div>
              </div>
              <? } ?>
            </div>
          </div>
        </div>
      </nav>
     
    </div>

  </header>
  
    <?= Breadcrumbs::widget([
      'homeLink' => ['label' => 'Главная', 'url' => '/'],
      'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
    ]) ?>
    <main role="main" class="flex-shrink-0 padding-20">
    <?= Alert::widget() ?>
    <?= $content ?>
  </main>
  <footer class="footer mt-auto py-3 text-muted">
    <div class="container">
      <!--<p class="float-left">&copy; <?= Html::encode(Yii::$app->name) ?> <?= date('Y') ?></p>
        <p class="float-right"><?= Yii::powered() ?></p>-->
    </div>
  </footer>
  <?php $this->endBody() ?>
</body>

</html>
<?php $this->endPage();