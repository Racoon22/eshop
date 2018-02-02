<?php
/**
 * Created by PhpStorm.
 * User: A
 * Date: 14.01.18
 * Time: 21:02
 */

namespace app\models;

use yii\db\ActiveRecord;

class Product extends ActiveRecord
{
    public static function tableName()
    {
        return 'product';
    }

    public function  getCategory()
    {
        return $this->hasOne(Category::className(), ['category_id' => 'id']);
    }
}