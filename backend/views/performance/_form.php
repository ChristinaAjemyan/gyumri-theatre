<?php

use common\models\Genre;
use common\models\Performance;
use common\models\Type;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;
use common\models\Main;
use mihaildev\ckeditor\CKEditor;
use mihaildev\elfinder\ElFinder;
//\mihaildev\elfinder\Assets::noConflict($this);

/* @var $this yii\web\View */
/* @var $model common\models\Performance */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="performance-form">

    <?php $form = ActiveForm::begin(); ?>

    <div class="form-row">
        <div class="col">
            <!-------------------save external id---------------------------------->
            <div class="news-index">
                <h4 class="mt-0">
                    Our performances from
                    <a href="https://haytoms.am/" target="_blank">haytoms.am</a>
                    <input type="checkbox" id="external_id" name="performance_external_id" checked>
                </h4>
                <?php
                $curl_handle=curl_init();

                $lng = "hy";
                curl_setopt($curl_handle, CURLOPT_URL,'https://api.haytoms.am/get/8a52a9c75db7a1f42c8c10fc62d397de/'.$lng);

                curl_setopt($curl_handle, CURLOPT_CONNECTTIMEOUT, 2);
                curl_setopt($curl_handle, CURLOPT_RETURNTRANSFER, 1);
                $haytoms_data = curl_exec($curl_handle);
                curl_close($curl_handle);

                $given_data = json_decode($haytoms_data, false);
                ?>
                <?php if ($given_data->data && count($given_data->data) > 0) : ?>

                <div class="hidden_external_table" style="margin-top: -5px;">
                    <table class="table table-striped table-dark">
                        <thead>
                        <tr>
                            <th scope="col"></th>
                            <th scope="col">Avatar Image</th>
                            <th scope="col">Title</th>
                            <th scope="col">Count By Date</th>
                            <th scope="col">Show Date And Time</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($given_data->data as $item) : ?>
                            <tr>
                                <td class="text-light"><?= $form->field($model, 'external_id')->radio(['value' => $item->id, 'uncheck' => null])->label(false) ?></td>
                                <td><img style="height: 65px;width: 144px;object-fit: cover;" src="<?= $item->img ?>" alt=""></td>
                                <td class="text-light"><?= $item->name ?></td>
                                <td class="text-light"><?= count($item->timeline) ?></td>
                                <td>
                                    <select class="custom-select form-control" style="background: #212529;border: 1px solid dimgray;outline: none; color: white;" size="3">
                                        <?php foreach ($item->timeline as $value) : ?>
                                            <option disabled><?= $value->time ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                        <tr>
                            <td class="text-light clear_all"><?= $form->field($model, 'external_id')->radio(['value' => '0', 'uncheck' => null])->label(false) ?> <span class="h4 text-weight-bold text-warning">unset</span></td>
                            <td class="text-light"></td>
                            <td class="text-light"></td>
                            <td class="text-light"></td>
                            <td class="text-light" align="right"><i class="fas text-warning fa-minus-circle fa-lg"></i></td>
                        </tr>
                        </tbody>
                    </table>
                </div>

                <?php endif; ?>
            </div>
            <!-------------------end save external id---------------------------------->
            <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model_genre_perform, 'genre_id')->widget(Select2::className(), [
                'data' => ArrayHelper::map(Genre::find()->all(), 'id', 'name'),
                'options' => [
                    'placeholder' => 'Select genre ...',
                    'multiple' => true
                ],
            ]) ?>

            <?= $form->field($model, 'avatar_image')->fileInput(['class' => 'imageFile']) ?>
            <?php if (isset($result_avatar)) : ?>
                <?= $result_avatar ? $result_avatar : false; ?>
            <?php endif; ?>

            <?= $form->field($model, 'author')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'show_date')->textInput(['class' => 'datepicker-here form-control', 'data-timepicker' => 'true', 'data-date-format' => 'yyyy-mm-dd','autocomplete' => 'off','readonly' => 'readonly']) ?>

            <?= $form->field($model, 'performance_length')->textInput(['type' => 'number', 'min' => 1]); ?>
        </div>
        <div class="col">
            <?= $form->field($model, 'slug')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model_stf_perform, 'staff_id')->widget(Select2::className(), [
                'data' => Performance::getFullName(),
                'options' => [
                    'placeholder' => 'Select staff ...',
                    'multiple' => true
                ],
            ]) ?>

            <?= $form->field($model, 'banner_image')->fileInput(['class' => 'imageFileBanner']) ?>

            <?php if (isset($result_banner)) : ?>
                <?= $result_banner ? $result_banner : false; ?>
            <?php endif; ?>

            <?= $form->field($model, 'mobile_banner_image')->fileInput(['class' => 'imageFileMobileBanner']) ?>

            <?php if (isset($result_mobile_banner)) : ?>
                <?= $result_mobile_banner ? $result_mobile_banner : false; ?>
            <?php endif; ?>

            <?= $form->field($model, 'trailer')->textInput(['maxlength' => true,'class' => 'form-control mb-3 w-50']) ?>
            <?= $form->field($model_videolink_perform, 'link[]')->textInput(['maxlength' => true,'class' => 'form-control mb-3 w-50'])->label('Multiple Video Link') ?>
            <a href="javascript:void(0)" class="btn btn-success addMoreInputs mb-3" title="Add more video links"><i class="fas fa-plus"></i></a>
            <?php if (isset($links_result)) : ?>
                <?= $links_result ? $links_result : false; ?>
            <?php endif; ?>
            <hr>
            <?= $form->field($model, 'age_restriction')->textInput(['type' => 'number', 'min' => 0]); ?>
            <?= $form->field($model, 'short_desc')->textarea(['rows' => 8]); ?>
        </div>
    </div>


    <?= $form->field($model_image, 'image[]')->fileInput(['multiple' => true]) ?>

    <?php if (isset($result)) : ?>
        <?= $result ? $result : false; ?>
    <?php endif; ?>

    <?= $form->field($model, 'desc')->widget(CKEditor::className(), [
        'editorOptions' => ElFinder::ckeditorOptions('elfinder',[]),
    ]); ?>

    <div class="col-4 p-0">
        <?= $form->field($model_type_perform, 'type_id')->widget(Select2::className(), [
            'data' => ArrayHelper::map(Type::find()->all(), 'id', 'title'),
            'options' => [
                'placeholder' => 'Select Type ...',
                'multiple' => true
            ],
        ]) ?>
    </div>


    <?= $form->field($model, 'hall')->radioList([0 =>'Մեծ բեմ', 1 => 'Փոքր թատրոն', 2 => 'Հյուրախաղ']) ?>

    <?= $form->field($model, 'is_new')->checkbox() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
<?php
$js = <<<JS
$( document ).ready(function() {
    
    if ($('#external_id')[0].checked){
        $('.hidden_external_table').slideDown();
    } 
    $('#external_id').on('change',function() {
        if (this.checked) {
            $('.hidden_external_table').slideDown();
        } else {
            $('.hidden_external_table').slideUp();
        }
    })
});

$('.addMoreInputs').on('click',function() {
   $('.field-videolink-link').append(`
   <input type="text" class="form-control w-50 mb-3" name="Videolink[link][]" maxlength="255" aria-invalid="false">
   `)
})

JS;
$this->registerJs($js);
?>