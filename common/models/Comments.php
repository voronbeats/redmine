<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "comments".
 *
 * @property int $id
 * @property int|null $user_id
 * @property string|null $text
 * @property string|null $date_add
 * @property int|null $task_id
 */
class Comments extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'comments';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['text'], 'required'],
            [['user_id', 'task_id'], 'integer'],
            [['text'], 'string'],
            [['date_add'], 'safe'],
        ];
    }

    public function beforeSave($insert) {
        if (parent::beforeSave($insert)) {
            $this->user_id = Yii::$app->user->id;
            if ($insert) {
                $this->user_id = Yii::$app->user->id;
            }
            return true;
        }
        return false;
    }
    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'User ID',
            'text' => 'Text',
            'date_add' => 'Date Add',
            'task_id' => 'Task ID',
        ];
    }
}
