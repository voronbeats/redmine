<? if($models) {?>
    <ul>
        <? foreach($models as $res) {?>
            <li><span class="click-search" data-id="<?=$res->id?>">[<?=$res->id?>] <?=$res->name?> (<?=$res->author->username?>)</span></li>
        <? } ?>
    </ul>
<? }else{ ?>
  Ничего не найдено
<? } ?>