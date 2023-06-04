<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "labor_costs".
 *
 * @property int $id
 * @property int $user_id
 * @property string $date
 * @property string|null $comment
 * @property string $time
 * @property int $task_id
 */
class LaborCosts extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'labor_costs';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['date', 'time', 'task_id'], 'required'],
            [['user_id', 'task_id'], 'integer'],
            [['date'], 'safe'],
            [['comment'], 'string'],
            [['time'], 'string', 'max' => 50],
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
            'user_id' => 'ID Пользователя',
            'date' => 'Дата',
            'comment' => 'Описание',
            'time' => 'Время',
            'task_id' => 'ID Задачи',
        ];
    }
}
