<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

?>

<div class="row row-sm tab-content  section-wrapper"   ng-show="tab == 'company'">
    <div class="form-layout ">
        <label class="section-title"><?= Yii::t('label',"Update company main info")?></label>
        <?php $form = ActiveForm::begin(['action'=>'/companies/company-update','id'=>'company_form']); ?>

        <div class="row mg-b-25">
            <div class="col-lg-4">
                <div class="form-group">
                    <label class="form-control-label"><?= Yii::t('label','Company name')?>: <span class="tx-danger">*</span></label>
                    <input class="form-control" type="text" name="name" ng-model="company.name">
                </div>

            </div><!-- col-4 -->

            <div class="col-lg-4">
                <div class="form-group">
                    <img id="company_logo" src="<?=$model->logo?>">
                    <?= $form->field($model, 'imageFile')->fileInput() ?>

                </div>
            </div><!-- col-4 -->
            <hr>
            <div class="col-lg-4">
                <div class="form-group">
                    <label class="form-control-label"><?= Yii::t('label','Phone')?>: <span class="tx-danger">*</span></label>
                    <input class="form-control" type="text" name="name" ng-model="companySettings.phone">
                </div>
            </div><!-- col-4 -->
            <div class="col-lg-4">
                <div class="form-group">
                    <?= $form->field($companySettings, 'phone')->textInput(['maxlength' => true]);  ?>
                </div>
            </div><!-- col-4 -->

        </div><!-- row -->

        <div class="form-layout-footer">

                        <button class="btn btn-primary bd-0" ng-click="saveCompany()">Submit Form</button>
            <!--                <button class="btn btn-secondary bd-0">Cancel</button>-->
        </div><!-- form-layout-footer -->
        <?php ActiveForm::end(); ?>
    </div><!-- form-layout -->
</div>
