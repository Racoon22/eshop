<?php if (Yii::$app->session->getFlash('activateSuccess')) : ?>
    <div class="alert alert-success alert-dismissible" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        <?= Yii::$app->session->getFlash('activateSuccess'); ?>
    </div>
<?php else: ?>
    Упс, что-то пошло не так. Наверное вы уже прошли регистрацию или ошиблись при копировании ссылки
<?php endif; ?>