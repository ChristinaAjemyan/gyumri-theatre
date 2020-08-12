<?php
use yii\helpers\Html;
//var_dump(Yii::$app->session['language']);die;
?>



<div class="dropdown dropdown-c">
    <a href="#" class="" data-toggle="dropdown">
        <?=Html::img('@web/images/flags/'.$current->url.'.png');?>
        <?= $current->name;?>
        <i class="fa fa-angle-down"></i>
    </a>
    <div class="dropdown-menu dropdown-menu-right">
        <nav class="nav">
            <?php foreach ($langs as $lang):?>
                <a href="/<?=$lang->url.Yii::$app->getRequest()->getLangUrl($lang->url)?>" class="nav-link"><i class="icon"><?=Html::img('@web/images/flags/'.$lang->url.'.png');?></i> <?=$lang->name?></a>

            <?php endforeach;?>

        </nav>
    </div><!-- dropdown-menu -->
</div><!-- dropdown -->
