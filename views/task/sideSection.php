<?php
use app\models\Project;
use yii\widgets\Menu;
?>
<section class="content__side">
    <h2 class="content__side-heading">Проекты</h2>

    <nav class="main-navigation">
            <?php
            $items = [];
            foreach (Project::findAll(['user_id' => Yii::$app->user->id]) as $project) {
                $items[] = ['label' => sprintf('%s <span>%d</span>', $project->name, $project->getProjectTasksCount()), 'url' => ['task/list', 'id' => $project->id]];
            }

            echo Menu::widget([
                    'items' => $items,
                'options' => ['class' => 'main-navigation__list'],
                'itemOptions' => ['class' => 'main-navigation__list-item'],
                'linkTemplate' => '<a class="main-navigation__list-item-link" href="{url}">{label}</a>',
                'activeCssClass' => 'main-navigation__list-item--active',
                'encodeLabels' => false
            ]) ?>
    </nav>

    <a class="button button--transparent button--plus content__side-button" href="<?= Yii::$app->urlManager->createUrl(['task/index']) ?>">Добавить проект</a>
</section>
