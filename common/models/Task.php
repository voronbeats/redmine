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

    const STATUS = ['0' => 'Ожидает', '1' => 'В работе', '2' => 'На проверке', '3' => 'Проверка кода', '4' => 'Отклонена', '5' => 'Завершена'];
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
            [['status', 'prioritet', 'user_id', 'readliness'], 'integer'],
            [['date_add', 'date_end'], 'safe'],
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
            'prioritet' => 'Приоритет',
            'date_add' => 'Дата добавления',
            'date_end' => 'Дата окончания',
            'text' => 'Описание',
            'ocenka_truda' => 'Оценка труда',
            'user_id' => 'id Пользвателя',
            'readliness' => 'Оценка временных затрат',
        ];
    }
    
    
    public function getStatus()
    {
        $array = ['0' => 'Ожидает', '1' => 'В работе', '2' => 'На проверке', '3' => 'Проверка кода', '4' => 'Отклонена', '5' => 'Завершена'];
        return $array[$this->status];
    }

}