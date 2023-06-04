<?php

use yii\db\Migration;

/**
 * Class m230506_131224_categoryNews
 */
class m230506_131224_categoryNews extends Migration
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

        $this->createTable('{{%category_news}}', [

            'id' => $this->primaryKey(),
            'title' => $this->string(200)->notNull(),
            'text' => $this->text(),
            'parent_id' => $this->integer(11)->notNull(),
        ], $tableOptions);
    }
    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m230506_131224_categoryNews cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m230506_131224_categoryNews cannot be reverted.\n";

        return false;
    }
    */
}
