<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "evrnt_note".
 *
 * @property integer $id
 * @property string $text
 * @property integer $creator
 * @property string $date_create
 *
 * @property Access $access
 * @property User $user
 */
class Note extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'evrnt_note';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['text'], 'required'],
            [['text'], 'string'],
            [['creator'], 'integer'],
            [['date_create'], 'safe']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'text' => Yii::t('app', 'Text'),
            'creator' => Yii::t('app', 'Creator'),
            'date_create' => Yii::t('app', 'Date Create'),
        ];
    }

    /**
     * Before save new note creator is current user
     * @param bool $insert
     * @return bool
     */
    public function beforeSave ($insert)
    {
        if ($this->getIsNewRecord())
        {
            $this->creator = Yii::$app->user->id;
        }
        parent::beforeSave($insert);
        return true;
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAccess ()
    {
        return $this->hasMany(Access::className(), ['note_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser ()
    {
        return $this->hasOne(User::className(), ['id' => 'creator']);
    }

    /**
     * @inheritdoc
     * @return \app\models\query\NoteQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \app\models\query\NoteQuery(get_called_class());
    }
}
