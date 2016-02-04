<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "evrnt_access".
 *
 * @property integer $id
 * @property integer $note_id
 * @property integer $user_id
 *
 * @property int $noteCount
 *
 * @property Note $note
 * @property User $user
 */
class Access extends \yii\db\ActiveRecord
{
    const ACCESS_CREATOR = 1;
    const ACCESS_GUEST = 2;

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
            'noteCreator' => Yii::t('app', 'Note creator'),
            'noteCount' => Yii::t('app', 'Note count'),
        ];
    }

    /**
     * Check access current user by note
     * @param Note $model
     * @return bool|int
     */
    public static function checkAccess($model)
    {
        if($model->creator == Yii::$app->user->id)
        {
            return self::ACCESS_CREATOR;
        }
        $accessNote = self::find()
            ->withNote($model->id)
            ->withUser(Yii::$app->user->id)
            ->exists();
        if($accessNote)
            return self::ACCESS_GUEST;

        return false;
    }

    /**
     * Check current user is creator
     * @param Note $model
     * @return bool
     */
    public static function checkIsCreator ($model)
    {
        return self::checkAccess($model) == self::ACCESS_CREATOR;
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getNote ()
    {
        return $this->hasOne(Note::className(), ['id' => 'note_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser ()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
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
