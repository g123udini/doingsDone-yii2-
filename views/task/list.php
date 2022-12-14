<?php

use yii\grid\GridView;
use yii\helpers\Html; ?>
<main class="content__main">
    <h2 class="content__main-heading">Список задач</h2>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'tableOptions' => [
            'class' => 'tasks'
        ],
        'summary' => false,
        'emptyCell' => 'Отсутствует',
        'rowOptions' => ['class' => 'tasks__item'],
        'columns' => [

            [
                'attribute' => 'name',
                'contentOptions' => function ($model, $key, $index, $column) {
                    return ['class' => 'task__select'];
                },
                'enableSorting' => true
            ],
            [
                'attribute' => 'dt_add',
                'format' => ['date', 'php:d.m.Y'],
                'contentOptions' => function ($model, $key, $index, $column) {
                    return ['class' => 'task__select'];
                },
            ],
            [
                'attribute' => 'deadline',
                'format' => ['date', 'php:d.m.Y'],
                'contentOptions' => function ($model, $key, $index, $column) {
                    return ['class' => 'task__select'];
                },

            ],
            [
                'attribute' => 'file',
                'contentOptions' => function ($model, $key, $index, $column) {
                    return ['class' => 'task__select'];
                },
            ],

            [
                'class' => 'yii\grid\ActionColumn',
                'header' => 'Действие',
                'headerOptions' => ['width' => '80'],
                'template' => '{download} {delete}',
                'buttons' => [
                    'download' => function ($url, $model, $key) {
                        if ($model->file) {
                            return Html::a('', $url, ['class' => 'download-link']);
                        }
                    },
                    'delete' => function ($url, $model, $key) {
                        return '<a href="' . $url . '"><svg aria-hidden="true" style="display:inline-block;font-size:inherit;height:1em;overflow:visible;vertical-align:-.125em;width:.875em" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><path fill="currentColor" d="M32 464a48 48 0 0048 48h288a48 48 0 0048-48V128H32zm272-256a16 16 0 0132 0v224a16 16 0 01-32 0zm-96 0a16 16 0 0132 0v224a16 16 0 01-32 0zm-96 0a16 16 0 0132 0v224a16 16 0 01-32 0zM432 32H312l-9-19a24 24 0 00-22-13H167a24 24 0 00-22 13l-9 19H16A16 16 0 000 48v32a16 16 0 0016 16h416a16 16 0 0016-16V48a16 16 0 00-16-16z"></path></svg></a> ';

                    }
                ],
                'contentOptions' => function ($model, $key, $index, $column) {
                    return ['class' => 'task__select'];
                },
            ],
        ],
    ]); ?>
</main>
