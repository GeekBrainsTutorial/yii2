<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\web\JsExpression;

/* @var $this yii\web\View */
/* @var $model app\models\Access */
/* @var $usersForAutocomplete app\models\User */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="access-form">

    <?php $form = ActiveForm::begin(); ?>

    <label for="autocomplete_user_id">
        Выберите пользователя
    </label>
        <?= \yii\jui\AutoComplete::widget([
                    'id' => 'autocomplete_user_id',
                    'name' => 'user_id',
                    'clientOptions' => [
                        'source' => $usersForAutocomplete,
                        'select' => new JsExpression("function( event, ui ) {
                            $('#access-user_id').val(ui.item.id);
                         }")
                    ],
                    'options' => [
                        'class' => 'form-control'
                    ]
                ])
        ?>

    <?= Html::activeHiddenInput($model, 'user_id')?>
    <br>
    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
