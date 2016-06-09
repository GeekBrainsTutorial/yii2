<?php

namespace app\models\query;

/**
 * This is the ActiveQuery class for [[\app\models\User]].
 *
 * @see \app\models\User
 */
class UserQuery extends \yii\db\ActiveQuery
{
    /**
     * @return $this
     */
    public function selectForAutocomplite()
    {
        return $this->select([
            'CONCAT(`name`, \' \', `surname`) as value',
            'CONCAT(`name`, \' \', `surname`) as label',
            'id'
        ]);
    }

    /**
     * @return $this
     */
    public function notCurrent()
    {
        return $this->andWhere("id != " . \Yii::$app->user->id);
    }

    /**
     * @inheritdoc
     * @return \app\models\Access[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return \app\models\Access|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}