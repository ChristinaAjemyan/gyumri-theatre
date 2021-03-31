<?php


use common\models\Image;
use common\models\Main;
use common\models\Videolink;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model common\models\Performance */

$this->title = 'Update Performance: ' . Main::uppercaseFirstLetter($model->title);
$this->params['breadcrumbs'][] = ['label' => 'Performances', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';

$video_links = ArrayHelper::map(Videolink::find()->where(['performance_id' => $model->attributes['id']])->all(), 'id', 'link');
$images = ArrayHelper::map(Image::find()->where(['performance_id' => $model->attributes['id']])->all(), 'id', 'image');
$table_name = $model->tableName();
$column_name = array_keys($model->attributes);

$column[] = $column_name[1];
$column[] = $column_name[14];
$column[] = $column_name[9];
$column[] = $column_name[11];
$column[] = $column_name[12];
?>
<?php $result_avatar = "
<div class=\"card-body my_card-body\" style='padding: 0 14px;'>
    <div class=\"scrolling-wrapper row flex-row flex-nowrap mt-4 pb-4\">";?>
<?php $result_avatar.= "<div class=\"p=0\">
            <div class=\"card card-block my-card-block\" style='width: 200px'>
                <img id='userEditProfileImg' src=\"/upload/avatars/performance/200/$model->img_path\" alt=\"$model->img_path\">
            </div>
        </div>"; ?>
<?php $result_avatar.= "</div>
</div>
"; ?>

<?php $result_banner = "
<div class=\"card-body my_card-body\" style='padding: 0 14px;'>
    <div class=\"scrolling-wrapper row flex-row flex-nowrap mt-4 pb-4\">";?>
<?php $result_banner.= "<div class=\"p=0\">
            <div class=\"card card-block my-card-block\" style='width: 200px'>
                <img id='editBannerImg' src=\"/upload/banners/$model->banner\" alt=\"$model->banner\">
            </div>
        </div>"; ?>
<?php $result_banner.= "</div>
</div>
"; ?>

<?php $result_mobile_banner = "
<div class=\"card-body my_card-body\" style='padding: 0 14px;'>
    <div class=\"scrolling-wrapper row flex-row flex-nowrap mt-4 pb-4\">";?>
<?php $result_mobile_banner.= "<div class=\"p=0\">
            <div class=\"card card-block my-card-block\" style='width: 200px'>
                <img id='editMobileBannerImg' src=\"/upload/mobile_banners/$model->mobile_banner\" alt=\"$model->mobile_banner\">
            </div>
        </div>"; ?>
<?php $result_mobile_banner.= "</div>
</div>
"; ?>

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

<?php if (!empty($video_links) && isset($video_links)): ?>
    <?php $links_result = "<div class=\"card mb-4\">
    <div class=\"card-body pt-0 pb-0\">
        <div class=\"scrolling-wrapper row flex-row flex-nowrap mt-4 pb-4\">";?>
    <?php foreach ($video_links as $link): ?>
        <?php $links_result.= "<div class='rem mr-4'>
                <div class=\"card card-block my-card-block\">
                    <iframe width='175' height=\"135\" src=\"https://www.youtube.com/embed/$link\"></iframe>
                    <button type=\"button\" class=\"link_remove\"><i class=\"fas fa-times\"></i></button>
                </div>
            </div>"; ?>
    <?php endforeach; ?>
    <?php $links_result.= "</div>
    </div>
</div>"; ?>
<?php endif; ?>


<div class="performance-update">
    <div class="d-flex justify-content-between">
        <h1><?= Html::encode($this->title) ?></h1>
        <div class="mt-5 mr-5 language_flag_disabled">
            <?= Html::a(Html::img(Url::to('/image/flag_am.png'), ['style' => 'width:30px; height:25px;', 'class' => 'flag_am']), "?id=$model->id"); ?>
            <?= Html::a(Html::img(Url::to('/image/flag_ru.png'), ['style' => 'width:30px; height:25px;', 'class' => 'flag_ru']), Main::createTranslationUrlRU($model->id, $table_name, $column)); ?>
            <?= Html::a(Html::img(Url::to('/image/flag_en.png'), ['style' => 'width:30px; height:25px;', 'class' => 'flag_en']), Main::createTranslationUrlEN($model->id, $table_name, $column)); ?>
        </div>
    </div>
    <?= $this->render('_form', [
        'model' => $model, 'model_image' => $model_image, 'model_stf_perform' => $model_stf_perform,
        'result' => isset($result) ? $result : '', 'model_genre_perform' => $model_genre_perform, 'model_type_perform' => $model_type_perform,
        'result_avatar'=>isset($result_avatar) ? $result_avatar : '','result_banner'=>isset($result_banner) ? $result_banner : '',
        'result_mobile_banner' => isset($result_mobile_banner)?$result_mobile_banner:'','model_videolink_perform' => $model_videolink_perform,'links_result'=>isset($links_result) ? $links_result : ''
    ]) ?>
</div>


<?php
$js = <<<JS

  $(".imageFile").on('change', function() {
      $('#userEditProfileImg').attr('src', URL.createObjectURL(this.files[0]))
  });
  $(".imageFileBanner").on('change', function() {
      $('#editBannerImg').attr('src', URL.createObjectURL(this.files[0]))
  });
    $(".imageFileMobileBanner").on('change', function() {
      $('#editMobileBannerImg').attr('src', URL.createObjectURL(this.files[0]))
  });

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
    
        $('.link_remove').on('click', function() {
        let link_src = $(this).prev().attr('src');
        let index = link_src.lastIndexOf("/");
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
            let result = link_src.substr(index + 1);
            $.ajax({
                url: '/performance/delete-videolink',
                type: 'post',
                data: {link: result}
            });
            $(this).closest('.rem').remove();
          }
        })   
});
        

JS;
$this->registerJs($js);
?>