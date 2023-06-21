<?php

namespace common\models;

use common\models\Tgram;
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

    public $userArrayTgm = array(
        '1' => '401681157',
        '2' => '1058780968',
        '3' => '1890429333',
        '4' => '1502076419',
        '6' => '1215251289',
        '8' => '6070325005'
       );
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
            [['text', 'to'], 'required'],
            [['user_id', 'task_id', 'to'], 'integer'],
            [['text'], 'string'],
            [['date_add'], 'safe'],
            ['to', 'validateTo']
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

    public function validateTo($attribute, $params, $validator)
    {
       if(!User::findOne($this->$attribute)) {
            $this->addError('to', 'Нет такого юзера');
       }
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
            'to' => 'To'
        ];
    }

    public function afterSave($insert, $changedAttributes) {

            $tgm = new Tgram();
            $text = 'Появился комментарий у задачи: <a href="' . 'http://redmine.dumz.ru/task/view?id='.$this->task_id . '">'.$this->task->name.'</a>';
            $notif = new Notification();
            $notif->text = $text;
            $notif->date_add = date('Y-m-d h:i:s');
            $notif->user_id =  $this->to;      
            $notif->flag = '0';
            $notif->save();
            $tgm->sendTelegram($text, $this->userArrayTgm[$this->to]);
           
    }

    public function getTask() {
        return $this->hasOne(Task::className(),['id'=>'task_id']);
    }

    public function getUser() {
        return $this->hasOne(User::className(),['id'=>'user_id']);
    }
}
