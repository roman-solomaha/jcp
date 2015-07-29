<?php
use yii\helpers\Url;
?>
{label}
{input}
<p class="help-block help-block-error">
    Неверный код.
    <br/>
    <a class="btn btn-default btn-countdown" data-finish-text="Получить новый код"
       disabled="disabled" href="<?= Url::to(['new-verify']) ?>">
        Получить новый код через
        <span id="countdown_verify" class="countdown" data-time="<?= Yii::$app->params['countdownVerify'] ?>"></span>
    </a>
</p>