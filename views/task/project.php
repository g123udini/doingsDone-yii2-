<?php
use yii\widgets\ActiveForm;
?>
<main class="content__main">
    <h2 class="content__main-heading">Добавление проекта</h2>

    <?php $form = ActiveForm::begin(['id' => 'add-project', 'class' => 'form']) ?>
        <div class="form__row">
            <?= $form->field($model, 'name')->textInput(['class' => 'form__input', 'labelOptions' => ['class' => 'form__label']]) ?>
        </div>

        <div class="form__row form__row--controls">
            <input class="button" type="submit" name="" value="Добавить">
        </div>
    <?php ActiveForm::end() ?>
</main>
