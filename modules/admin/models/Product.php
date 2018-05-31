<?php

namespace app\modules\admin\models;

use Yii;

/**
 * This is the model class for table "product".
 *
 * @property int $id
 * @property int $category_id
 * @property string $name
 * @property string $content
 * @property double $price
 * @property string $keywords
 * @property string $description
 * @property string $img
 * @property int $hit
 * @property int $sale
 * @property int $new
 */
class Product extends \yii\db\ActiveRecord
{
    public $image;
    public $gallery;

    public function behaviors()
    {
        return [
            'image' => [
                'class' => 'rico\yii2images\behaviors\ImageBehave',
            ]
        ];
    }

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'product';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['category_id', 'hit', 'sale', 'new'], 'integer'],
            [['name', 'content', 'price'], 'required'],
            [['content', 'keywords', 'description'], 'string'],
            [['price'], 'number'],
            [['name', 'img'], 'string', 'max' => 255],
            [['image'], 'file', 'extensions' => 'png, jpg'],
            [['gallery'], 'file', 'extensions' => 'png, jpg', 'maxFiles' => 6],
        ];
    }

    public function getCategory()
    {
        return $this->hasOne(Category::class, ['id' => 'category_id']);
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'Id товара',
            'category_id' => 'Категория',
            'name' => 'Название',
            'content' => 'Контент',
            'price' => 'Цена',
            'keywords' => 'Ключевые слова',
            'description' => 'Мета-описание',
            'image' => 'Фото',
            'gallery' => 'Галлерия',
            'hit' => 'Хит',
            'sale' => 'Распродажа',
            'new' => 'Новинка',
        ];
    }

    public function upload()
    {
        if ($this->validate()) {
            $path = Yii::getAlias('@web') . 'upload/store/' . $this->image->baseName . '.' . $this->image->extension;
            $this->image->saveAs($path, true);
            $this->attachImage($path);
            @unlink($path);
            return true;
        }
    }

    public function uploadGallery()
    {
        if ($this->validate()) {
            foreach ($this->gallery as $file) {
                $path = Yii::getAlias('@web') . 'upload/store/' . $file->baseName . '.' . $file->extension;
                $file->saveAs($path);
                $this->attachImage($path);
                @unlink($path);
            }
            return true;
        }
    }

}
