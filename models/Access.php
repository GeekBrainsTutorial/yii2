<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "evrnt_access".
 *
 * @property integer $id
 * @property integer $note_id
 * @property integer $user_id
 */
class Access extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'evrnt_access';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['note_id', 'user_id'], 'required'],
            [['note_id', 'user_id'], 'integer']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'note_id' => Yii::t('app', 'Note ID'),
            'user_id' => Yii::t('app', 'User ID'),
        ];
    }

    /**
     * @inheritdoc
     * @return \app\models\query\AccessQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \app\models\query\AccessQuery(get_called_class());
    }
}
