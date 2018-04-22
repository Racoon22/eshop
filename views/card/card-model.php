<?php if (!empty($session['card'])) : ?>
    <div class="table-responsive">
        <table class="table table-hover table-striped">
            <thead>
            <tr>
                <th>Фото</th>
                <th>Наименование</th>
                <th>Кол-во</th>
                <th>Цена</th>
                <th><span class="glyphicon glyphicon-remove"></span></p></th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($session['card'] as $id => $item) : ?>
                <tr>
                    <td><?= \yii\helpers\Html::img("{$item['img']}", ['alt'=> 'name', 'height' => 50]) ?></td>
                    <td><?= $item['name'] ?></td>
                    <td><?= $item['qty'] ?></td>
                    <td><?= $item['price'] ?></td>
                    <td><span data-id="<?= $id ?>" class="glyphicon glyphicon-remove text-danger del-item" aria-hidden="true"></span></p>
                    </td>
                </tr>
            <?php endforeach; ?>
            <tr>
                <td colspan="4">Итого:</td>
                <td><?= $session['card.qty'] ?></td>
            </tr>
            <tr>
                <td colspan="4">На сумму: </td>
                <td><?= $session['card.sum'] ?></td>
            </tr>

            </tbody>
        </table>
    </div>
<?php else : ?>
    <h3>Корзина пуста</h3>
<?php endif; ?>
