<?php
use yii\widgets\ActiveForm;
?>

<main class="content__main">
    <h2 class="content__main-heading">Вход на сайт</h2>

        <?php $form = ActiveForm::begin(['id' => 'login-form', 'class' => 'form']) ?>
        <div class="form__row">
            <?= $form->field($model, 'email')->textInput(['class' => 'form__input', 'labelOptions' => ['class' => 'form__label']]) ?>
        </div>

        <div class="form__row">
            <?= $form->field($model, 'password')->passwordInput(['class' => 'form__input', 'labelOptions' => ['class' => 'form__label']]) ?>
        </div>

        <div class="form__row form__row--controls">
            <input class="button" type="submit" name="" value="Войти">
        </div>
        <?php ActiveForm::end(); ?>
</main>


