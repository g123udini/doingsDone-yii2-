<?php

use yii\widgets\ActiveForm;

?>

<div class="page-wrapper">
    <div class="container container--with-sidebar">
        <header class="main-header">
            <a href="#">
                <img src="../img/logo.png" width="153" height="42" alt="Логитип Дела в порядке">
            </a>

            <div class="main-header__side">
                <a class="main-header__side-item button button--transparent" href="form-authorization.html">Войти</a>
            </div>
        </header>

        <div class="content">
            <section class="content__side">
                <p class="content__side-info">Если у вас уже есть аккаунт, авторизуйтесь на сайте</p>

                <a class="button button--transparent content__side-button" href="form-authorization.html">Войти</a>
            </section>

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
        </div>
    </div>
</div>