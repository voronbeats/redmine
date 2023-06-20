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

    public function afterSave($insert, $changedAttributes) {

        $ispoln = $this->task->user_id;     
        $authorId = $this->task->author_id;

        if(Yii::$app->user->identity->id == $ispoln) {
            $recipient = $authorId;
        }else{
            $recipient = $ispoln;
        }
            $tgm = new Tgram();
            $text = 'Появился комментарий у задачи: <a href="' . 'http://redmine.dumz.ru/task/view?id='.$this->task_id . '">'.$this->task->name.'</a>';
            $notif = new Notification();
            $notif->text = $text;
            $notif->date_add = date('Y-m-d h:i:s');
            $notif->user_id =  $recipient;      
            $notif->flag = '0';
            $notif->save();
            $tgm->sendTelegram($text, $this->userArrayTgm[$recipient]);
           
    }

    public function getTask() {
        return $this->hasOne(Task::className(),['id'=>'task_id']);
    }
}
