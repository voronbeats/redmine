<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "notification".
 *
 * @property int $id
 * @property string|null $text
 * @property string|null $date_add
 * @property int|null $flag
 * @property int|null $user_id
 */
class Notification extends \yii\db\ActiveRecord
{

    const FLAG = ['0' => 'Не прочитано', '1' => 'Прочитано'];
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'notification';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['text'], 'string'],
            [['date_add'], 'safe'],
            [['flag', 'user_id'], 'integer'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'text' => 'Название',
            'date_add' => 'Дата обновления',
            'flag' => 'Статус',
            'user_id' => 'Имя',
        ];
    }

    public function getFlag()
    {
        $array = ['0' => 'Не прочитано', '1' => 'Прочитано'];
        return $array[$this->flag];

    }

    public function getAuthor() {
        return $this->hasOne(User::className(),['id'=>'user_id']);
    }
}