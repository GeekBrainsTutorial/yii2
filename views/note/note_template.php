<?php

use yii\helpers\Html;

/***
 * @var $model app\models\Note
 */
?>
<div style='padding: 40px; margin: 10px; display: inline-block; background: #f5f5f5; cursor: pointer;'
      onclick='location.assign("/note/<?=$model->id?>")'>
    <?=$model->text?>
    <br>
    <?php
        if($model->creator == Yii::$app->user->id)
        {
            echo Html::a('Расшарить заметку', ['/access/create/'.$model->id], ['class'=>'btn btn-primary']);
        }
    ?>
</div>