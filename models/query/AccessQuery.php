<?php

namespace app\models\query;

/**
 * This is the ActiveQuery class for [[\app\models\Access]].
 *
 * @see \app\models\Access
 */
class AccessQuery extends \yii\db\ActiveQuery
{
    /**
     * Condition with note_id
     * @param $note_id
     * @return $this
     */
    public function withNote($note_id)
    {
        return $this->andWhere(
            'note_id = :note_id',
            [
                ":note_id" => $note_id
            ]
        );
    }

    /**
     * Condition with user_id
     * @param $user_id
     * @return $this
     */
    public function withUser($user_id)
    {
        return $this->andWhere(
            'user_id = :user_id',
            [
                ":user_id" => $user_id
            ]
        );
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