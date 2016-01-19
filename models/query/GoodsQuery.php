<?php

namespace app\models\query;

/**
 * This is the ActiveQuery class for [[\app\models\Goods]].
 *
 * @see \app\models\Goods
 */
class GoodsQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        $this->andWhere('[[status]]=1');
        return $this;
    }*/

    /**
     * This condition adding condition email_provider
     * @param $emailProvider
     * @return $this
     */
    public function withEmailProvider($emailProvider)
    {
        return $this->andWhere(
            "email_provider = :email_provider",
            [
                ":email_provider" => $emailProvider
            ]
        );
    }

    /**
     * @inheritdoc
     * @return \app\models\Goods[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return \app\models\Goods|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}