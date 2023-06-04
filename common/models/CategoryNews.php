<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "category_news".
 *
 * @property int $id
 * @property string $title
 * @property string|null $text
 * @property int $parent_id
 */
class CategoryNews extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'category_news';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title', 'parent_id'], 'required'],
            [['text'], 'string'],
            [['parent_id'], 'integer'],
            [['title'], 'string', 'max' => 200],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Title',
            'text' => 'Text',
            'parent_id' => 'Parent ID',
        ];
    }
}
