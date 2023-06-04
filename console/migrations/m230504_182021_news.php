<?php

use yii\db\Migration;

/**
 * Class m230504_182021_news
 */
class m230504_182021_news extends Migration
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

        $this->createTable('{{%news}}', [

            'id' => $this->primaryKey(),
            'title' => $this->string(200)->notNull(),
            'text' => $this->text(),
            'date' => $this->dateTime(),
            'status' => $this->integer(1)->defaultValue(0),
            'user_id' => $this->integer(11)->notNull(),
            'date_update' => $this->dateTime(),
            'category_id' => $this->integer(11)->notNull(),

        ], $tableOptions);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m230504_182021_news cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m230504_182021_news cannot be reverted.\n";

        return false;
    }
    */
}
