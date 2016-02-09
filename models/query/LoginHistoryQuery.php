<?php

namespace app\models\query;

/**
 * This is the ActiveQuery class for [[\app\models\LoginHistory]].
 *
 * @see \app\models\LoginHistory
 */
class LoginHistoryQuery extends \yii\db\ActiveQuery
{
    /**
     * Condition with user_id
     * @param $user_id
     * @return $this
     */
    public function withUser($user_id)
    {
        return $this->andWhere(
            'user_id='.$user_id
        );
    }

    /**
     * @inheritdoc
     * @return \app\models\LoginHistory[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return \app\models\LoginHistory|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}