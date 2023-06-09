<?php

namespace common\models;

use Yii;
use common\models\Task;

/**
 * This is the model class for table "labor_costs".
 *
 * @property int $id
 * @property int $user_id
 * @property string $date
 * @property string|null $comment
 * @property string $time
 * @property int $task_id
 * @property string|null $task_name
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
            [['user_id', 'task_id', 'time'], 'integer'],
            [['date'], 'safe'],
            [['comment', 'task_name'], 'string'],
        ];
    }
  

    public function beforeSave($insert) {
        if (parent::beforeSave($insert)) {
            $this->task_name = $this->task->name;
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
            'time' => 'Часы (Количество)',
            'task_id' => 'ID Задачи',
            'task_name' => 'Название задачи'
        ];
    }
    public function getTask()
    { 
        return $this->hasOne(Task::className(), ['id' => 'task_id']);
    }

    public function getUser() {
        return $this->hasOne(User::className(),['id'=>'user_id']);
    }
}