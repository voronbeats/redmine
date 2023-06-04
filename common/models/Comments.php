<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "comments".
 *
 * @property int $id
 * @property string|null $text
 * @property string|null $date
 * @property int|null $status
 * @property int $user_id
 * @property int $news_id
 */
class Comments extends \yii\db\ActiveRecord
{
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
            [['text'], 'string'],
            [['date'], 'safe'],
            [['status', 'user_id', 'news_id'], 'integer'],
            [['user_id', 'news_id'], 'required'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'text' => 'Text',
            'date' => 'Date',
            'status' => 'Status',
            'user_id' => 'User ID',
            'news_id' => 'News ID',
        ];
    }
}
