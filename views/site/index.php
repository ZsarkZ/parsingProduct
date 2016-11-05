<?php
/* @var $this yii\web\View */
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
$this->title = 'My Yii Application';
?>
<div class="site-index">
    <p>Please fill out the following fields to search:</p>

    <div class="row">
        <div>
            <?php $form = ActiveForm::begin(['id' => 'search-form', 'layout' => 'inline']); ?>
                <?= $form->field($searchModel, 'article')->textInput(['autofocus' => true, 'placeholder'=>'Input article']) ?>

                <?= $form->field($searchModel, 'brand')->textInput(['placeholder'=>'Input brand']) ?>

                <div class="form-group">
                    <?= Html::submitButton('Search', ['class' => 'btn btn-primary', 'name' => 'searh-button']) ?>
                </div>

            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>
