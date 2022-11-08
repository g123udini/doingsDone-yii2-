<?php

namespace app\widgets;

use Yii;
use yii\base\Widget;
use yii\helpers\Html;

class EnterButtonWidget extends Widget
{
    public $type;
    public $url;
    public $word;

    public function init()
    {
        $this->url = Yii::$app->urlManager->createUrl('login');
        $this->word = 'Войти';

        if ($this->type === 'login/index') {
            $this->url = Yii::$app->urlManager->createUrl('login/registration');
            $this->word = 'Регистрация';
        }
    }

    public function run()
    {
        return Html::a($this->word, $this->url, ['class' => 'button button--transparent content__side-button']);
    }
}