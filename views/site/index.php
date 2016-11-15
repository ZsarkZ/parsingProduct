<?php
/* @var $this yii\web\View */
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
//phpinfo();
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
    <?php if (!empty($dataResult)): ?>
        <?php foreach ($dataResult as $productType => $siteList) : ?>
            <table class="table table-bordered table-hover">
                <caption>
                    <?php if ($productType == 'Origin'): ?>
                        Оригинальные товары
                    <?php elseif ($productType == 'ReplacementOriginal') :?>
                        Замена от оригинального производителя
                    <?php else :?>
                        Замена не от оригинального производителя
                    <?php endif ?>
                </caption>

                <thead>
                    <tr>
                        <th>Артикул</th>
                        <th>Названия</th>
                        <th>Цена</th>
                        <th>Ссылка на товар</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($siteList as $site => $siteData) : ?>
                        <?php foreach ($siteData as $key => $data) : ?>
                            <tr>
                                <td><?=$data['number']?></td>
                                <td><?=$data['name']?></td>
                                <td><?=$data['price']?></td>
                                <td><?=$data['order_links']?></td>
                            </tr>
                        <?php endforeach; ?>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php endforeach; ?>
    <?php endif; ?>
</div>
