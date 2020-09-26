<?php
use yii\widgets\LinkPager;
?>

<?php if (!empty($model) && isset($model)): ?>
<div class="container">
    <section class="actors_lists">
        <div class="row row-cols-xl-5 row-cols-lg-4 row-cols-md-3 row-cols-sm-2 row-cols-2 w-100">
        <?php foreach ($model as $item): ?>
        <div class="col">
            <a href="/staff/view?id=<?= $item->id; ?>">
                <div class="actor">
                    <img src="<?= Yii::$app->params['backend-url'].'/upload/avatars/staff/200/'.$item->img_path; ?>" alt="Photo">
                    <h6 class="actor_name"><?= $item->first_name.' '.$item->last_name; ?></h6>
                    <span class="actor_type">Դերասան</span>
                </div>
            </a>
        </div>
        <?php endforeach; ?>
        </div>
    </section>

    <div>
        <?= LinkPager::widget([
            'pagination' => $pages,
            'maxButtonCount' => 6,
            'prevPageLabel' => "<i class=\"fas fa-chevron-left\"></i>",
            'nextPageLabel' => "<i class=\"fas fa-chevron-right\"></i>",
            'options' => [
                'class' => 'pagination actros_list_page'
            ]
        ]);?>
    </div>


</div>

<?php endif; ?>


