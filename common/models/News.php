<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "news".
 *
 * @property int $id
 * @property string $title
 * @property string|null $text
 * @property string|null $date
 * @property int|null $status
 * @property int $user_id
 * @property string|null $date_update
 * @property int $category_id
 */
class News extends \yii\db\ActiveRecord
{
    public $test;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'news';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title', 'user_id', 'category_id', 'test'], 'required'],
            [['text'], 'string'],
            [['date', 'date_update'], 'safe'],
            [['status', 'user_id', 'category_id'], 'integer'],
            [['title'], 'string', 'max' => 200],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'test' => 'Тест',
            'id' => 'ID',
            'title' => 'Название',
            'text' => 'Текст',
            'date' => 'Дата',
            'status' => 'Статус',
            'user_id' => 'ID пользователя',
            'date_update' => 'Дата обновления',
            'category_id' => 'ID категории',
        ];
    }
}
