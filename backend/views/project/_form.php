<?php



use mihaildev\ckeditor\CKEditor;
use mihaildev\elfinder\ElFinder;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\Project */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="project-form">

    <?php $form = ActiveForm::begin([
        'method' => 'post',
        'options' => ['enctype' => 'multipart/form-data']
    ]); ?>
    <div class="row">
        <div class="col-6">
            <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>
            <?= $form->field($model, 'video_link')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-6">
            <div class="row">
                <div class="col-5">
                    <?= $form->field($model, 'img_path')->fileInput(['class' => 'imageFile']) ?>
                </div>
                <div class="col-7">
                    <?php if ($type == 'update'): ?>
                        <img src="<?= Yii::$app->params['backend-url'] . '/upload/avatars/project/200/' . $model->img_path; ?>"
                             alt="<?= $model->img_path; ?>" style="height: 100px;">
                    <?php endif; ?>
                </div>
            </div>
            <div class="row mt">
                <div class="col-5">
                    <?= $form->field($model, 'banner')->fileInput(['class' => 'imageFile']) ?>
                </div>
                <div class="col-7">
                    <?php if ($type == 'update'): ?>
                        <img id="projectBannerImg" class="mt-2"
                             src="<?= Yii::$app->params['backend-url'] . '/upload/banners/' . $model->banner; ?>"
                             alt="<?= $model->banner ?>" style="height: 100px;">
                    <?php endif; ?>
                </div>
            </div>
        </div>
        <div class="col-12 mb-2">
            <lable>Multiple Images</lable>
            <input type="file" name="ProjectImages[file_path][]" class="imageFile" multiple>
            <?php if ($type == 'update'){
                $images=\common\models\ProjectImages::find()->where(['project_id'=>$model->id])->asArray()->all();?>
                <div class="row">
                    <?php foreach ($images as $k=>$v): ?>
                        <div id="removeMultipleImg_<?= $k ;?>" class="col-1 mt-3">
                            <button type="button" class="btn btn-danger float-right btn-circle removeProjectMultipleImg" style="margin: 0 0 -20px 0; position: inherit;" data-id="<?= $k ;?>" data-content="<?= $v['id']; ?>"><i class="far fa-trash-alt"></i></button>
                            <img id="projectBannerImg" class="mt-2" src="<?= Yii::$app->params['backend-url'] . '/upload/avatars/project/200/' . $v['photo'] ?>" alt="<?= $v['photo']; ?>" style="height: 150px;">
                        </div>
                    <?php endforeach; ?>
                </div>
           <?php } ?>
        </div>
        <div id="videosPush" class="col-12">
            <div id="removePushVideo_" class="">
                <label for="">Videos</label><br>
                <input type="text" name="ProjectVideo[file_path][]" class="imageFile"><button type="button" class="btn btn-success btn-sm ml-1 addNewVideoInput">Add</button>
            </div>
        </div>
        <?php if ($type == 'update'): ?>
        <?php $videos=\common\models\ProjectVideos::find()->where(['project_id'=>$model->id])->asArray()->all(); ?>
            <div id="projectVidoe" class="row" data-content="<?= count($videos); ?>">
                <?php foreach ($videos as $num=> $video): ?>
                    <div id="projectVideoRemove_<?= $num; ?>" class="col-4 d-flex align-items-center m-4">
                        <iframe width="420" height="345"
                                src="https://www.youtube.com/embed/<?= $video['video_url']; ?>"></iframe>
                        <button type="button" class="btn btn-danger ml-2 removeProjectVideos" data-content="<?= $num; ?>" data-id="<?= $video['id']; ?>"><i class="far fa-trash-alt"></i></button>
                    </div>
                <?php endforeach;?>
            </div>
            <input id="removeVidoeId" type="text" name="videoRemoveId[]" style="display: none;">
        <?php endif; ?>
        <div class="col-12">
            <?= $form->field($model, 'description')->widget(CKEditor::className(), [
                'editorOptions' => ElFinder::ckeditorOptions('elfinder',[]),
            ]); ?>
        </div>
    </div>
    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>
    <input id="removeProjectImg" type="text" name="removeImgIdArray[]" style="display: none;">
    <?php ActiveForm::end(); ?>

</div>
<?php

$js = <<<JS
let removeArrayId=[];
$(document).on('click','.removeProjectMultipleImg',function() {
    let removeDivId=$(this).attr('data-id');
    let removeImgId=$(this).attr('data-content');
    let bool=confirm('Delete photo ?');
    if (bool){
        removeArrayId.push(removeImgId);
        $('#removeProjectImg').val(removeArrayId);
        $('#removeMultipleImg_'+removeDivId).hide(300);
        setTimeout(function() {
          $('#removeMultipleImg_'+removeDivId).remove();
        },500)
    } 
})


var number=1;
$(document).on('click','.addNewVideoInput',function() {
    $('#videosPush').append(`<div id="removePushVideo_`+ number +`"><input type="text" name="ProjectVideo[file_path][]" class="imageFile"><button type='button' class="btn btn-danger btn-sm ml-1 removeNewAddVideos" data-id="`+ number +`"><i class="far fa-trash-alt"></i></button></div>`)
            number=number+1;
})

$(document).on('click','.removeNewAddVideos',function() {
  let removeDivNum=$(this).attr('data-id');
  let bool=confirm('removeInput');
  if (bool){
      $('#removePushVideo_'+removeDivNum).hide(200);
      setTimeout(function() {
        $('#removePushVideo_'+removeDivNum).remove();
      },300)
  } 
})

let removeVideoArrayId=[];
$(document).on('click','.removeProjectVideos',function() {
  let removeDivId=$(this).attr('data-content');
  let removeVidoeid=$(this).attr('data-id');
  let bool=confirm('Delete Video?');
  
  if (bool){
      removeVideoArrayId.push(removeVidoeid);
      $('#removeVidoeId').val(removeVideoArrayId)
      $('#projectVideoRemove_'+removeDivId).hide(200);
      setTimeout(function() {
        $('#projectVideoRemove_'+removeDivId).remove();
      },300)
  } 
  
})
JS;
$this->registerJs($js);

?>
