<?php

namespace common\models;

use Yii;
use common\models\Tgram;

/**
 * This is the model class for table "chat".
 *
 * @property int $id
 * @property string|null $text
 * @property int|null $to
 * @property int|null $from
 * @property string|null $date_add
 */
class Chat extends \yii\db\ActiveRecord
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
        return 'chat';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['text'], 'required'],
            [['text'], 'string'],
            [['to', 'from', 'parent'], 'integer'],
            [['date_add'], 'safe'],
            ['date_add','default','value'=> date('Y-m-d H:i:s')]
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'text' => 'Введите сообщение:',
            'to' => 'To',
            'from' => 'From',
            'date_add' => 'Date Add',
            'parent' => 'Parent'
        ];
    }

    public function getUsers() {
        return $this->hasOne(User::className(),['id'=>'from']);
    }

    public function getParents() {
        return $this->hasOne(Chat::className(), ['id' => 'parent']);
    }

    public function getNames() {
        return $this->hasOne(User::className(), ['id' => 'to']);
    }

    public function beforeSave($insert) {
        if (parent::beforeSave($insert)) {
            $this->from = Yii::$app->user->id;
            return true;
        }
        return false;
    }

    public function afterSave($insert, $changedAttributes)
    {
        parent::afterSave($insert, $changedAttributes);
        $tex_strim_parent = mb_strimwidth($this->parents->text, 0, 30, "...");
        $text_strim = mb_strimwidth($this->text, 0, 30, "...");
            $tgm = new Tgram();
            $notif = new Notification();
            if ($this->parent) {
                $text ='На ваше сообщение:' ;
                $text .= "\n";
                $text .= $tex_strim_parent;
                $text .= "\n";
                $text .= 'Ответил: '.$this->users->username.':';
            }else{
                $text = 'У вас появилось новое сообщение от '.$this->users->username.':' ;
            }
            $text .= "\n";
            $text .= '<a href="https://redmine.dumz.ru/chat">'.$text_strim.'</a>';
            $notif->text = $text;
            $notif->date_add = date('Y-m-d h:i:s');
            $notif->user_id = $this->from;
            if(!$this->to) {
                foreach($this->userArrayTgm as $res){
                    $tgm->sendTelegram($text, $res);
                }
            }
            $tgm->sendTelegram($text, $this->userArrayTgm[$this->to]);
            $notif->flag = '0';
            $notif->save();
    }
}
