<?php

use yii\grid\GridView; ?>
<main class="content__main">
    <h2 class="content__main-heading">Список задач</h2>

    <form class="search-form" action="index.php" method="GET" autocomplete="off">
        <input class="search-form__input" type="text" name="search" value="" placeholder="Поиск по задачам">

        <input class="search-form__submit" type="submit" name="" value="Искать">
    </form>

    <div class="tasks-controls">
        <nav class="tasks-switch">
            <a href="index.php" class="tasks-switch__item tasks-switch__item--active">Все задачи</a>
            <a href="index.php?filter=today" class="tasks-switch__item tasks-switch__item--active">Повестка дня</a>
            <a href="index.php?filter=tomorrow" class="tasks-switch__item tasks-switch__item--active">Завтра</a>
            <a href="index.php?filter=overdue" class="tasks-switch__item tasks-switch__item--active">Просроченные</a>
        </nav>

        <label class="checkbox">
            <input class="checkbox__input visually-hidden show_completed" type="checkbox" checked>
            <span class="checkbox__text">Показывать выполненные</span>
        </label>
    </div>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'tableOptions' => [
            'class' => 'tasks'
        ],
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'name',
            'dt_add',
            'deadline',
            'file',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
    <table class="tasks">
            <tr class="tasks__item task task--completed task--important">
                <td class="task__select">
                    <label class="checkbox task__checkbox">
                        <input class="checkbox__input visually-hidden task__checkbox" type="checkbox" value="" checked>
                        <span class="checkbox__text"></span>
                    </label>
                </td>
                <td class="task__file">
                        <a class="download-link" href="uploads/</a>
                </td>
                <td class="task__date">
                </td>
            </tr>
            <span class=""></span>
    </table>
</main>
