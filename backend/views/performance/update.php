<?php


use app\models\Image;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Performance */

$this->title = 'Update Performance: ' . $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Performances', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';

$images = ArrayHelper::map(Image::find()->where(['performance_id' => $model->attributes['id']])->all(), 'id', 'image');
?>

<?php if (!empty($images) && isset($images)): ?>
<?php $result = "<div class=\"card mb-4\">
    <div class=\"card-body\">
        <div class=\"scrolling-wrapper row flex-row flex-nowrap mt-4 pb-4\">";?>
            <?php foreach ($images as $image): ?>
            <?php $result.= "<div class=\"col-2\">
                <div class=\"card card-block my-card-block\">
                    <img src=\"/upload/galleries/250/$image\" alt=\"$image\">
                    <button type=\"button\" class=\"file_remove\"><i class=\"fas fa-times\"></i></button>
                </div>
            </div>"; ?>
            <?php endforeach; ?>
<?php $result.= "</div>
    </div>
</div>"; ?>
<?php endif; ?>


<div class="performance-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model, 'model_image' => $model_image, 'model_stf_perform' => $model_stf_perform,
        'result' => $result, 'model_genre_perform' => $model_genre_perform
    ]) ?>

</div>


<?php
$js = <<<JS
    $('.file-thumbnail-footer').css('display', 'none');
    $('.file-drop-zone').css('min-height', '202px');
    $('#performance-avatar_image, #performance-banner_image').on('click', function() {
        let footer_none = setInterval(function() {
            $.each($('.file-thumbnail-footer'), function(i, item) {
            if ($(item).length === 1 && $(item).attr('style') !== 'display: none;'){
                $(item).css('display', 'none');
                setTimeout(function() {
                  clearInterval(footer_none);
                }, 1500);
            }
            })
        }, 30);
    });

   

    $('.file_remove').on('click', function() {
        let img_src = $(this).prev().attr('src');
        let index = img_src.lastIndexOf("/");
        Swal.fire({
          title: 'Are you sure?',
          text: "You won't be able to revert this!",
          icon: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
          if (result.value) {
            Swal.fire(
              'Deleted!',
              'Your file has been deleted.',
              'success'
            );
            let result = img_src.substr(index + 1);
            $.ajax({
                url: window.location.href,
                type: 'post',
                data: {src: result}
            });
            $(this).closest('.col-2').remove();
          }
        })   
});
        

JS;
$this->registerJs($js);
?>
