<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\Category */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="category-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

<!--    --><?php //echo  $form->field($model, 'parent_id')->textInput() ?>
    
    <div class="form-group field-category-parent_id has-success">
        <label for="category-parent_id" class="control-label">Родительская категория</label>
        <select name="Category[parent_id]" id="category-parent_id" class="form-control">
            <option value="0">Самостоятельная категория</option>
          <?= \app\components\MenuWidget::widget(['tpl' => 'select', 'model' => $model]); ?>
        </select>
    </div>

    <?= $form->field($model, 'keywords')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'description')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
