
<?php if (!empty($actors) && isset($actors)): ?>
<div class="container">
    <section class="actors_lists">
        <?php foreach ($actors as $item): ?>
        <a href="/staff/view?id=<?= $item->id; ?>">
            <div class="actor">
                <img src="<?= Yii::$app->params['backend-url'].'/upload/avatars/staff/200/'.$item->img_path; ?>" alt="Photo">
                <h6 class="actor_name"><?= $item->first_name.' '.$item->last_name; ?></h6>
                <span class="actor_type">Դերասան</span>
            </div>
        </a>
        <?php endforeach; ?>


    </section>

    <div>
        <ul class="pagination actros_list_pag">
            <li class="page-item">
                <a class="page-link" href="#" aria-label="Previous">
                    <span aria-hidden="true">
                        <i class="fas fa-chevron-left"></i>
                    </span>

                </a>
            </li>
            <li class="page-item "><a class="page-link" href="#">1</a></li>
            <li class="page-item"><a class="page-link" href="#">2</a></li>
            <li class="page-item active"><a class="page-link" href="#">3</a></li>
            <li class="page-item"><a class="page-link" href="#">4</a></li>
            <li class="page-item"><a class="page-link" href="#">5</a></li>

            <li class="page-item">
                <a class="page-link" href="#" aria-label="Next">
                    <span aria-hidden="true">
                        <i class="fas fa-chevron-right"></i>
                    </span>
                </a>
            </li>
        </ul>
    </div>
</div>

<?php endif; ?>
