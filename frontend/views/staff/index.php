<?php
use yii\widgets\LinkPager;
?>

<?php if (!empty($model) && isset($model)): ?>
<div class="container">
    <section class="row actors_lists">
        <?php foreach ($model as $item): ?>
        <div class="col-3">
            <a href="/staff/view?id=<?= $item->id; ?>">
                <div class="actor">
                    <img src="<?= Yii::$app->params['backend-url'].'/upload/avatars/staff/200/'.$item->img_path; ?>" alt="Photo">
                    <h6 class="actor_name"><?= $item->first_name.' '.$item->last_name; ?></h6>
                    <span class="actor_type">Դերասան</span>
                </div>
            </a>
        </div>

        <?php endforeach; ?>
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


