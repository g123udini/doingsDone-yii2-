<?php

use yii\widgets\ActiveForm;

?>

<main class="content__main">
    <h2 class="content__main-heading">Регистрация аккаунта</h2>

    <?php $form = ActiveForm::begin(['id' => 'registration-form', 'class' => 'form']) ?>
    <div class="form__row">
        <?= $form->field($model, 'email')->textInput(['class' => 'form__input', 'autocomplete' => 'off', 'labelOptions' => ['class' => 'form__label']]) ?>
    </div>

    <div class="form__row">
        <?= $form->field($model, 'login')->textInput(['class' => 'form__input', 'autocomplete' => 'off', 'labelOptions' => ['class' => 'form__label']]) ?>
    </div>

    <div class="form__row">
        <?= $form->field($model, 'password')->input('password', ['class' => 'form__input', 'labelOptions' => ['class' => 'form__label']]) ?>
    </div>

    <div class="form__row">
        <?= $form->field($model, 'passwordRepeat')->input('password', ['class' => 'form__input', 'labelOptions' => ['class' => 'form__label']]) ?>
    </div>

    <input class="button" type="submit" name="" value="Зарегистрироваться">
    <?php ActiveForm::end() ?>
</main>
