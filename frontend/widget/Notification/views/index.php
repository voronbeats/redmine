<?php
use yii\widgets\Pjax;
use yii\helpers\Url;

?>



<div class="dropdown dropleft ">

  <a class="btn notif-button  notification-click" href="#" role="button" id="dropdownMenuLink"
    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
    <?php Pjax::begin(['id' => 'pjax-grid-view']); ?>
    <i data-rd-navbar-toggle=".rd-navbar-share-list" class="fa fa-lightbulb-o <? if ($flag) { ?>red<? } ?>"
      aria-hidden="true"></i>
    <?php Pjax::end(); ?>
  </a>

<div class="dropdown-menu notif" aria-labelledby="dropdownMenuLink" >
 <?php Pjax::begin(['id' => 'pjax-click']); ?>
  <? if ($models) { ?>
        <ul class="ul-notif">
          <? foreach ($models as $res) { ?>
            <li data-id="<?= $res->id ?>">
              <?= $res->text ?>
            </li>
          <? } ?>
        </ul>
 
  
  <? } else { ?>

<p>Нет сообщений</p>



  <? } ?>
  <a data-pjax="0" href="<?= Url::to(['notification/index']); ?>">Мои уведомления</a>
  <?php Pjax::end(); ?>
  </div>
  </div>