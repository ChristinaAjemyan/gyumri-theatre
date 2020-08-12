<?php
use yii\widgets\ActiveForm;
use yii\helpers\Html;
?>
<div class=" " ng-controller="verification" ng-app="myApp">
<!--    <section class="section-wrapper mb-4 mt-0" >-->
<!--    <label class="section-title">--><?//=Yii::t('text','please follow by this steps')?><!--</label>-->
<!--    <div class="progress mg-b-5">-->
<!--        <div class="progress-bar bg-{{progressColor}} progress-bar-striped  wd-{{progress}}p" role="progressbar" aria-valuenow="150" aria-valuemin="0" aria-valuemax="100">{{progress}}%</div>-->
<!--    </div>-->
<!--    </section>-->
    <section id="coose_type" class="section-wrapper p-4"  >
            <h3><?=Yii::t('text','Welcome to ')?>Autotech- <?=Yii::t('text','Please choose your company type')?></h3>
            <div class="">
                <div class="row">
                    <div class="col-lg">
                        <div class="pricing-item">
                            <div class="pricing-icon"><i class="icon ion-model-s"></i></div>
                            <h5 class="pricing-title"><?=Yii::t('label','Auto parts shop')?></h5>
                            <p class="pricing-text" style="height: 130px"><?=Yii::t('text','Here you can create your own shop, where you can manage your parts, sales and sale your products on our shop site')?> </p>
                            <h1 class="pricing-price" style="font-size: 15px"><?=Yii::t('label','Free for 30 days')?></h1>
                            <a href="" ng-click="chooseType('shop')" class="btn btn-primary btn-pricing"><?=Yii::t('label','Choose Plan')?></a>
                        </div><!-- pricing-item -->
                    </div><!-- col -->
                    <div class="col-lg mg-t-10 mg-lg-t-0">
                        <div class="pricing-item">
                            <div class="pricing-icon"><i class="icon ion-settings"></i></div>
                            <h5 class="pricing-title"><?=Yii::t('label','Auto service')?></h5>
                            <p class="pricing-text" style="min-height: 130px"><?=Yii::t('text','Here you can manage your service managment, your company can be shown on map when someone will search service , others...')?></p>
                            <h1 class="pricing-price" style="font-size: 15px"><?=Yii::t('label','Free for 30 days')?></h1>
                            <a href="#" ng-click="chooseType('service')" class="btn btn-primary btn-pricing" ng-click="choose();"><?=Yii::t('label','Choose Plan')?>{{}}</a>
                        </div><!-- pricing-item -->
                    </div>
                    <div class="col-lg mg-t-10 mg-lg-t-0">
                        <div class="pricing-item " >
                            <div class="pricing-icon"><i class="icon ion-model-s"></i><i class="icon ion-settings"></i></i></div>
                            <h5 class="pricing-title"><?=Yii::t('label','Full plan')?></h5>
                            <p class="pricing-text" style="min-height: 130px"><?=Yii::t('text','This plan for companies wich has shop and service too')?></p>
                            <h1 class="pricing-price" style="font-size: 15px"><?=Yii::t('label','Free for 30 days')?></h1>
                            <a href="" ng-click="chooseType('all')" class="btn btn-primary btn-pricing"><?=Yii::t('label','Choose Plan')?></a>
                        </div><!-- pricing-item -->
                    </div>
                </div><!-- row -->
            </div>
    </section>
    <section id="company_form" class="section-wrapper p-4" style="display: none" >
        <div class="company-settings-form">
            <div class="form-layout">
                <?php $form = ActiveForm::begin(); ?>
                <input type="hidden" id="company_id" name="company_id" value="<?=$model->id?>">
                <div class="row mg-b-25">
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label class="form-control-label"><?= Yii::t('label','Email')?>: <span class="tx-danger">*</span></label>
                            <?= $form->field($settings, 'email')->textInput(['maxlength' => true])->label(false) ?>
                        </div>
                    </div><!-- col-4 -->
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label class="form-control-label">Lastname: <span class="tx-danger">*</span></label>
                            <input class="form-control" type="text" name="lastname" value="McDoe" placeholder="Enter lastname">
                        </div>
                    </div><!-- col-4 -->
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label class="form-control-label">Email address: <span class="tx-danger">*</span></label>
                            <input class="form-control" type="text" name="email" value="johnpaul@yourdomain.com" placeholder="Enter email address">
                        </div>
                    </div><!-- col-4 -->
                    <div class="col-lg-8">
                        <div class="form-group mg-b-10-force">
                            <label class="form-control-label">Mail Address: <span class="tx-danger">*</span></label>
                            <input class="form-control" type="text" name="address" value="Market St. San Francisco" placeholder="Enter address">
                        </div>
                    </div><!-- col-8 -->
                    <div class="col-lg-4">
                        <div class="form-group mg-b-10-force">
                            <label class="form-control-label">Country: <span class="tx-danger">*</span></label>
                            <select class="form-control select2" data-placeholder="Choose country">
                                <option label="Choose country"></option>
                                <option value="USA">United States of America</option>
                                <option value="UK">United Kingdom</option>
                                <option value="China">China</option>
                                <option value="Japan">Japan</option>
                            </select>
                        </div>
                    </div><!-- col-4 -->
                </div><!-- row -->
                <div class="form-layout-footer">
                    <button class="btn btn-primary bd-0"><?= Yii::t('label','Save')?></button>

                </div><!-- form-layout-footer -->
                <?php ActiveForm::end(); ?>

            </div>

        </div>
    </section>



</div>
<?php $this->registerJsFile(Yii::$app->request->baseUrl.'/js/angular/controllers/verification-steps.js'); ?>


