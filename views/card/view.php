<?php

use \yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;

?>
<div class="container">
    <?php if (Yii::$app->session->hasFlash('success')) : ?>
        <div class="alert alert-success alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            <?= Yii::$app->session->getFlash('success'); ?>
        </div>

    <?php endif; ?>
    <?php if (Yii::$app->session->hasFlash('error')) : ?>
        <div class="alert alert-danger alert-dismissible" role="alert">
            <button type="button" class="close" data-dismis="alert" aria-label="Close">
                <span aria-hidden="true">&times</span></button>
        </div>
        <?= Yii::$app->session->getFlash('error'); ?>
    <?php endif; ?>
    <?php if (!empty($session['card'])) : ?>
        <div class="table-responsive">
            <table class="table table-hover table-striped">
                <thead>
                <tr>
                    <th>Фото</th>
                    <th>Наименование</th>
                    <th>Кол-во</th>
                    <th>Цена</th>
                    <th>Сумма</th>
                    <th><span class="glyphicon glyphicon-remove"></span></p></th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($session['card'] as $id => $item) : ?>
                    <tr>
                        <td><?= \yii\helpers\Html::img("{$item['img']}", ['alt' => 'name', 'height' => 50]) ?></td>
                        <td>
                            <a href="<?= \yii\helpers\Url::to(['product/view', 'id' => $id]) ?>"><?= $item['name'] ?></a>
                        </td>
                        <td><?= $item['qty'] ?></td>
                        <td><?= $item['price'] ?></td>
                        <td><?= $item['qty'] * $item['price'] ?></td>
                        <td><span data-id="<?= $id ?>" class="glyphicon glyphicon-remove text-danger del-item"
                                  aria-hidden="true"></span></p>
                        </td>
                    </tr>
                <?php endforeach; ?>
                <tr>
                    <td colspan="5">Итого:</td>
                    <td><?= $session['card.qty'] ?></td>
                </tr>
                <tr>
                    <td colspan="5">На сумму:</td>
                    <td><?= $session['card.sum'] ?></td>
                </tr>
                </tbody>
            </table>
        </div>
        <?php $form = ActiveForm::begin() ?>
        <?= $form->field($order, 'name') ?>
        <?= $form->field($order, 'email') ?>
        <?= $form->field($order, 'phone') ?>
        <?= $form->field($order, 'address') ?>
        <?= Html::submitButton('Заказать', ['class' => 'btn btn-success']) ?>
        <?php $form = ActiveForm::end() ?>
    <?php else : ?>
        <h3>Корзина пуста</h3>
    <?php endif; ?>
</div>