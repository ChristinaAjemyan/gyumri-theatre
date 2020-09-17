<?php


use app\models\StaffImage;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use app\models\Main;

/* @var $this yii\web\View */
/* @var $model app\models\Staff */

$this->title = 'Update Staff: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Staff', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';

$images = ArrayHelper::map(StaffImage::find()->where(['staff_id' => $model->attributes['id']])->all(), 'id', 'image');

$table_name = $model->tableName();
$column_name = array_keys($model->attributes);
$arrColumnName = "column_name[]=$column_name[1]&column_name[]=$column_name[2]&column_name[]=$column_name[5]&column_name[]=$column_name[6]&column_name[]=$column_name[7]";
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
<div class="staff-update">

    <div class="d-flex justify-content-between">
        <h1><?= Html::encode($this->title) ?></h1>
        <div class="mt-5 mr-5">
            <?= Html::a('HY', "?id=$model->id"); ?>
            <?= Html::a('RU', Main::createTranslationUrlRU($table_name, $model->id, $arrColumnName)); ?>
            <?= Html::a('EN', Main::createTranslationUrlEN($table_name, $model->id, $arrColumnName)); ?>
        </div>
    </div>

    <?= $this->render('_form', [
        'model' => $model, 'model_image' => $model_image, 'result' => $result
    ]) ?>

</div>


<?php
$js = <<<JS
    $('.file-thumbnail-footer').css('display', 'none');
    $('.file-drop-zone').css('min-height', '202px');
    $('#staff-avatar_image').on('click', function() {
        let footer_none = setInterval(function() {
            if ($('.file-thumbnail-footer').length === 1 && $('.file-thumbnail-footer').attr('style') !== 'display: none;'){
                $('.file-thumbnail-footer').css('display', 'none');
                setTimeout(function() {
                  clearInterval(footer_none);
                }, 1500);
            }
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
