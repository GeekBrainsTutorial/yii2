<?php
/***
 * @var $model app\models\Note
 */
?>
<div style='padding: 40px; margin: 10px; display: inline-block; background: #f5f5f5; cursor: pointer;'
      onclick='location.assign("/note/<?=$model->id?>")'>
    <?=$model->text?>
</div>