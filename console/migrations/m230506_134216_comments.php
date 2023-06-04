<?php

use yii\db\Migration;

/**
 * Class m230506_134216_comments
 */
class m230506_134216_comments extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%comments}}', [

            'id' => $this->primaryKey(),
            'text' => $this->text(),
            'date' => $this->dateTime(),
            'status' => $this->integer(1)->defaultValue(0),
            'user_id' => $this->integer(11)->notNull(),
            'news_id' => $this->integer(11)->notNull(),
            
        ], $tableOptions);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m230506_134216_comments cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m230506_134216_comments cannot be reverted.\n";

        return false;
    }
    */
}
