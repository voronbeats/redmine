<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "progul".
 *
 * @property int $id
 * @property int $user_id
 * @property string $date
 * @property string $text
 */
class Progul extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'progul';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id'], 'integer'],
            [['date'], 'safe'],
            [['text'], 'required'],
            [['text'], 'string'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'User ID',
            'date' => 'Date',
            'text' => 'Text',
        ];
    }
}
