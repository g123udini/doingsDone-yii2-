<?php
use app\models\Project;
use yii\widgets\Menu;
?>
<section class="content__side">
    <h2 class="content__side-heading">Проекты</h2>

    <nav class="main-navigation">
            <?php
            echo Menu::widget([
                    'items' => Project::getProjectsMenu(),
                'options' => ['class' => 'main-navigation__list'],
                'itemOptions' => ['class' => 'main-navigation__list-item'],
                'linkTemplate' => '<a class="main-navigation__list-item-link" href="{url}">{label}</a>' . "<span class='main-navigation__list-item-count'>" . Project::getProjectCount('Работа') . "</span>",
                'activeCssClass' => 'main-navigation__list-item--active'
            ]) ?>
    </nav>

    <a class="button button--transparent button--plus content__side-button" href="<?= Yii::$app->urlManager->createUrl(['task/index']) ?>">Добавить проект</a>
</section>
