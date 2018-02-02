<?php
/**
 * Created by PhpStorm.
 * User: A
 * Date: 16.01.18
 * Time: 21:23
 */

namespace app\controllers;

use app\models\Category;
use app\models\Product;
use Codeception\Module\Yii2;
use Yii;
use yii\data\Pagination;

class CategoryController extends AppController
{
    public function actionIndex()
    {
        $hits = Product::find()->where(['hit' => 1])->limit(6)->all();
        $this->setMeta('E-SHOPPER');
        return $this->render('index', compact('hits'));
    }

    public function actionView($id)
    {
        $id = Yii::$app->request->get('id');
//        $products = Product::find()->where(['category_id' => $id])->all();
        $category  = Category::findOne($id);
        $query = Product::find()->where(['category_id' => $id]);
        $pages = new Pagination([
            'totalCount' => $query->count(),
            'pageSize' => 1,
            'pageSizeParam' => false,
            'forcePageParam' => false
            ]);
        $products = $query->offset($pages->offset)->limit($pages->limit)->all();
        $this->setMeta('E-SHOPPER | '. $category->name, $category->keywords, $category->description);
       return  $this->render('view', compact('products', 'pages', 'category'));
    }
}