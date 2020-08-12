<?php

use yii\helpers\Html;

use yii\widgets\ActiveForm;
/* @var $this yii\web\View */
/* @var $model backend\models\Companies */

//$this->title = Yii::t('app', 'Update Companies: {name}', [
//    'name' => $model->name,
//]);
//$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Companies'), 'url' => ['index']];
//$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
//$this->params['breadcrumbs'][] = Yii::t('app', 'Update');

?>
<div class="" ng-app="CompanyUpdateModel"  ng-controller="CompanyUpdateController" ng-cloak>
    <h1><?= Html::encode($this->title) ?></h1>
    <div class="manager-wrapper">
        <div class="manager-right">
            <?= $this->render('tabs/main_tab', [
                'model' => $model,
                'companySettings'=>$companySettings
            ]) ?>
            <?= $this->render('tabs/workers_tab', [
                'model' => $model,
            ]) ?>
        </div>
        <div class="manager-left">
            <nav class="nav">
                <a href="" id="nav_company" ng-click="opentab('company')" class="nav-link active">

                    <span><?=Yii::t('label','Company')?></span>
                    <span>120</span>
                </a>
                <a href="" id="nav_workers" ng-click="opentab('workers')" class="nav-link">
                    <span><?=Yii::t('label','Workers')?></span>
                    <span>16</span>
                </a>
                <a href="" class="nav-link">
                    <span>Friends</span>
                    <span>68</span>
                </a>
                <a href="" class="nav-link">
                    <span>Co-workers</span>
                    <span>38</span>
                </a>
                <a href="" class="nav-link">
                    <span>Favorites</span>
                    <span>9</span>
                </a>
            </nav>

<!--            <label class="section-label-sm mg-t-25">Location</label>-->
<!--            <nav class="nav">-->
<!--                <a href="" class="nav-link">-->
<!--                    <span>San Francisco</span>-->
<!--                    <span>10</span>-->
<!--                </a>-->
<!--                <a href="" class="nav-link">-->
<!--                    <span>Los Angeles</span>-->
<!--                    <span>16</span>-->
<!--                </a>-->
<!--                <a href="" class="nav-link">-->
<!--                    <span>New York</span>-->
<!--                    <span>15</span>-->
<!--                </a>-->
<!--                <a href="" class="nav-link">-->
<!--                    <span>Las Vegas</span>-->
<!--                    <span>4</span>-->
<!--                </a>-->
<!--                <a href="" class="nav-link">-->
<!--                    <span>Sacramento</span>-->
<!--                    <span>4</span>-->
<!--                </a>-->
<!--            </nav>-->
<!---->
<!--            <label class="section-label-sm mg-t-25">Job Position</label>-->
<!--            <nav class="nav">-->
<!--                <a href="" class="nav-link">-->
<!--                    <span>Software Engineer</span>-->
<!--                    <span>4</span>-->
<!--                </a>-->
<!--                <a href="" class="nav-link">-->
<!--                    <span>UI Designer</span>-->
<!--                    <span>6</span>-->
<!--                </a>-->
<!--                <a href="" class="nav-link">-->
<!--                    <span>Sales Representative</span>-->
<!--                    <span>5</span>-->
<!--                </a>-->
<!--                <a href="" class="nav-link">-->
<!--                    <span>Mechanical Engineer</span>-->
<!--                    <span>4</span>-->
<!--                </a>-->
<!--                <a href="" class="nav-link">-->
<!--                    <span>Nurse</span>-->
<!--                    <span>4</span>-->
<!--                </a>-->
<!--            </nav>-->
        </div>
    </div>




</div>
<?php $this->registerJsFile(Yii::$app->request->baseUrl.'/js/angular/controllers/CompanyUpdateController.js'); ?>
