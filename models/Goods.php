<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tbl_goods".
 *
 * @property integer $id
 * @property string $name
 * @property integer $count
 * @property string $email_provider
 * @property string $create_date
 */
class Goods extends \yii\db\ActiveRecord
{
    /**
     * Validate const
     */
    const NAME_AND_EMAIL_MAX_LENGTH = 255;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_goods';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['count'], 'integer'],
            [['create_date'], 'safe'],
            [['name', 'email_provider'], 'string', 'max' => self::NAME_AND_EMAIL_MAX_LENGTH]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'name' => Yii::t('app', 'Name'),
            'count' => Yii::t('app', 'Count'),
            'email_provider' => Yii::t('app', 'Email Provider'),
            'create_date' => Yii::t('app', 'Create Date'),
        ];
    }

    /**
     * @inheritdoc
     * @return \app\models\query\GoodsQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \app\models\query\GoodsQuery(get_called_class());
    }
}
