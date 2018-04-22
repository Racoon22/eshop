<div class="table-responsive">
    <table class="table table-hover table-striped" style="width: 100%; border: 1px solid #ddd; border-collapse: collapse;">
        <thead>
        <tr style="background: #f9f9f9">
            <th style="padding: 8px; border: 1px solid #ddd;">Наименование</th>
            <th style="padding: 8px; border: 1px solid #ddd;">Кол-во</th>
            <th style="padding: 8px; border: 1px solid #ddd;">Цена</th>
            <th style="padding: 8px; border: 1px solid #ddd;">Сумма</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($session['card'] as $id => $item) : ?>
            <tr>
                <td style="padding: 8px; border: 1px solid #ddd;"><?= $item['name'] ?></td>
                <td style="padding: 8px; border: 1px solid #ddd;"><?= $item['qty'] ?></td>
                <td style="padding: 8px; border: 1px solid #ddd;"><?= $item['price'] ?></td>
                <td style="padding: 8px; border: 1px solid #ddd;"><?= $item['qty'] * $item['price'] ?></td>
            </tr>
        <?php endforeach; ?>
        <tr>
            <td colspan="3" style="padding: 8px; border: 1px solid #ddd;">Итого:</td>
            <td style="padding: 8px; border: 1px solid #ddd;"><?= $session['card.qty'] ?></td>
        </tr>
        <tr>
            <td colspan="3" style="padding: 8px; border: 1px solid #ddd;">На сумму:</td>
            <td style="padding: 8px; border: 1px solid #ddd;"><?= $session['card.sum'] ?></td>
        </tr>

        </tbody>
    </table>
</div>
