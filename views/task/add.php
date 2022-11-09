<?php

use app\models\Project;
use yii\widgets\ActiveForm;
?>

<main class="content__main">
    <h2 class="content__main-heading">Добавление задачи</h2>

        <?php $form = ActiveForm::begin(['id' => 'task-form', 'class' => 'form']); ?>
        <div class="form__row">
            <?= $form->field($model, 'name')->textInput(['class' => 'form__input', 'placeholder' => 'Введите название...', 'labelOptions' => ['class' => 'form__label']]) ?>
        </div>

        <div class="form__row">
            <?= $form->field($model, 'project_id')->dropDownList(Project::getProjectsList(), ['class' => 'form__input form__input--select']) ?>
        </div>

        <div class="form__row">
           <?= $form->field($model, 'deadline')->input('date', ['class' => 'form__input']) ?>
        </div>

        <div class="form__row">
            <label class="form__label" for="file">Файл</label>
            <div class="form__input-file">
                <?= $form->field($model, 'files[]')->fileInput(['multiple' => true, 'class' => 'button', 'style' => 'width: 300px;'])->label(false) ?>
            </div>
        </div>

        <div class="form__row form__row--controls">
            <input class="button" type="submit" name="" value="Добавить">
        </div>
    <?php ActiveForm::end() ?>
</main>
