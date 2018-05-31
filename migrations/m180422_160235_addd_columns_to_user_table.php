<?php

use yii\db\Migration;

/**
 * Class m180422_160235_addd_columns_to_user_table
 */
class m180422_160235_addd_columns_to_user_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('user', 'access_token', $this->string());
        $this->addColumn('user', 'is_activated', $this->boolean());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('user', 'is_activated');
        $this->dropColumn('user', 'access_token');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m180422_160235_addd_columns_to_user_table cannot be reverted.\n";

        return false;
    }
    */
}
