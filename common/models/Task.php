<?php

namespace common\models;

use Yii;

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

    const STATUS = ['0' => 'Ожидает', '1' => 'В работе', '2' => 'На проверке', '3' => 'Проверка кода', '4' => 'Отклонена', '5' => 'Завершена', '6' => 'К релизу'];
    const PRIORITET = ['0' => 'Нормальный', '1' => 'Срочный', '2' => 'Очень срочно'];
    /**
     * {@inheritdoc}
     */
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
            [['status', 'prioritet', 'user_id', 'readliness', 'author_id', 'parent_id'], 'integer'],
            [['date_add', 'date_end'], 'safe'],
            ['date_add','default','value'=>date('Y-m-d H:i:s')],
            [['text'], 'string'],
            [['name', 'ocenka_truda'], 'string', 'max' => 200],
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
            return true;
        }
        return false;
    }
    public function getStatus()
    {
        $array = ['0' => 'Ожидает', '1' => 'В работе', '2' => 'На проверке', '3' => 'Проверка кода', '4' => 'Отклонена', '5' => 'Завершена', '6' => 'К релизу'];
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

    public function getCustomer() {
        return $this->hasOne(User::className(),['id'=>'author_id']);
    }
    public function getParent() {
        return $this->hasMany(Task::className(),['parent_id'=>'id']);
    }
}