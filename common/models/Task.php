<?php

namespace common\models;

use Yii;
use yii\helpers\Html;
use common\models\Notification;

/**
 * This is the model class for table "task".
 *
 * @property int $id
 * @property string|null $name
 * @property int|null $status
 * @property int|null $prioritet
 * @property string|null $date_add
 * @property string|null $date_end
 * @property string|null $text
 * @property string|null $ocenka_truda
 * @property int|null $user_id
 * @property int|null $readliness
 */
class Task extends \yii\db\ActiveRecord
{

    const STATUS = ['0' => 'Ожидает', '1' => 'В работе', '2' => 'На проверке', '3' => 'Проверка кода', '4' => 'Отклонена', '5' => 'Завершена', '6' => 'К релизу', '7' => 'Возобновлена'];
    const PRIORITET = ['0' => 'Нормальный', '1' => 'Срочный', '2' => 'Очень срочно'];
    /**
     * {@inheritdoc}
     */
     public $userArrayTgm = array(
      '1' => '401681157',
      '2' => '1058780968',
      '3' => '1890429333',
      '4' => '1502076419',
      '6' => '1215251289',
      '8' => '6070325005'
     );

    public static function tableName()
    {
        return 'task';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['status', 'prioritet', 'user_id', 'readliness', 'author_id', 'parent_id'], 'integer'],
            [['date_add', 'date_end'], 'safe'],
            ['date_add','default','value'=>date('Y-m-d H:i:s')],
            [['text'], 'string',],          
            [['name', 'ocenka_truda'], 'string', 'max' => 200], 
            ['date_add','default','value'=> date('Y-m-d h:i:s')],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Тема задачи',
            'status' => 'Статус',
            'Status' =>'Статус',
            'Prioritet' => 'Приоритет',
            'prioritet' => 'Приоритет',
            'date_add' => 'Дата добавления',
            'date_end' => 'Дата окончания',
            'text' => 'Описание',
            'ocenka_truda' => 'Время выполнения в часах',
            'user_id' => 'Исполнитель',
            'author_id' => 'Имя автора задачи',
            'readliness' => 'Оценка временных затрат',
            'author' => 'Исполнитель',
            'customer' => 'Автор задачи',
            'parent_id' => 'Родительская задача',

        ];
    }
    
    public function beforeSave($insert) {
        if (parent::beforeSave($insert)) {
            if ($insert) {
                $this->author_id = Yii::$app->user->id;
            }
            if (!$this->text) {
                $this->text = $this->name;
            }
            return true;

        }
        return false;
    }

    public function afterSave($insert, $changedAttributes)
    {
        parent::afterSave($insert, $changedAttributes);
            if ($insert) {
               $text = 'Здравствуйте, у вас есть новая задача:' ;
            }else{
               $text = 'Здравствуйте, у вас обновлена задача:' ;
            }
            $text .= "\n";
            $text .= '<a href="' . 'http://redmine.dumz.ru/task/view?id='.$this->id . '">'.$this->name.'</a>';
/* Записываем в таблицу Notification */
            $notif = new Notification();
            $notif->text = ($text);
            $notif->date_add = date('Y-m-d h:i:s');
            $notif->user_id = $this->user_id;
            $notif->flag = '0';
            $notif->save();
 /* отправляем в телегу */
            $tgm = new Tgram();
            $tgm->sendTelegram($text, $this->userArrayTgm[$this->user_id]);
           
      
    }


    public function getStatus()
    {
        $array = ['0' => 'Ожидает', '1' => 'В работе', '2' => 'На проверке', '3' => 'Проверка кода', '4' => 'Отклонена', '5' => 'Завершена', '6' => 'К релизу', '7' => 'Возобновлена'];
        return $array[$this->status];
    }

    public function getPrioritet()
    {
        $array = ['0' => 'Нормальный', '1' => 'Срочный', '2' => 'Очень срочно'];
        return $array[$this->prioritet];
    }
    //Связь с Автором
	public function getAuthor() {
        return $this->hasOne(User::className(),['id'=>'user_id']);
    }
    public function getLaborcost() {
        return $this->hasMany(LaborCosts::className(),['task_id'=>'id']);
    }

    public function getCustomer() {
        return $this->hasOne(User::className(),['id'=>'author_id']);
    }
    public function getParent() {
        return $this->hasMany(Task::className(),['parent_id'=>'id']);
    }
}