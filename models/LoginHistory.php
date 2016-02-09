<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "evrnt_login_history".
 *
 * @property integer $id
 * @property integer $user_id
 * @property string $date_time
 *
 * @property User $user
 */
class LoginHistory extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'evrnt_login_history';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id'], 'required'],
            [['user_id'], 'integer'],
            [['date_time'], 'safe']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'user_id' => Yii::t('app', 'User ID'),
            'date_time' => Yii::t('app', 'Date Time'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }

    /**
     * @inheritdoc
     * @return \app\models\query\LoginHistoryQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \app\models\query\LoginHistoryQuery(get_called_class());
    }
}
