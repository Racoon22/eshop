<?php

use yii\db\Migration;

/**
 * Handles the creation of table `product`.
 */
class m180116_151243_create_product_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('product', [
            'id' => $this->primaryKey(),
            'category_id' => $this->integer(),
            'name' => $this->string()->notNull(),
            'content' => $this->text()->notNull(),
            'price' => $this->double('3')->notNull(),
            'keywords' => $this->text(),
            'description' => $this->text(),
            'img' => $this->string()->defaultValue('no-image.png'),
            'hit' => $this->smallInteger('1')->defaultValue(0),
            'sale' => $this->smallInteger('1')->defaultValue(0),
            'new' => $this->smallInteger('1')->defaultValue(0),

        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('product');
    }
}
