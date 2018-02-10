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
use Yii;
use yii\data\Pagination;
use yii\web\HttpException;

class CategoryController extends AppController
{
    public function actionIndex()
    {
        $hits = Product::find()->where(['hit' => 1])->limit(6)->all();
        $this->setMeta('E-SHOPPER');
        return $this->render('index', compact('hits'));
    }

    public function actionView()
    {
        $id = Yii::$app->request->get('id');
        $category  = Category::findOne($id);
        if (empty($category)) {
            throw new HttpException(404, 'Такой категории нет');
        };
//        $products = Product::find()->where(['category_id' => $id])->all();
        $category  = Category::findOne($id);
        $query = Product::find()->where(['category_id' => $id]);
        $pages = new Pagination([
            'totalCount' => $query->count(),
            'pageSize' => 3,
            'pageSizeParam' => false,
            'forcePageParam' => false
            ]);
        $products = $query->offset($pages->offset)->limit($pages->limit)->all();
        $this->setMeta('E-SHOPPER | '. $category->name, $category->keywords, $category->description);
       return  $this->render('view', compact('products', 'pages', 'category'));
    }
    public function actionSearch()
    {
        $q = trim(Yii::$app->request->get('q'));
        if (!$q) {
            return  $this->render('search', compact('q'));
        }
        $this->setMeta('E-SHOPPER | Поиск' . $q);
        $query = Product::find()->where(['like', 'name', $q ]);
        $pages = new Pagination([
            'totalCount' => $query->count(),
            'pageSize' => 3,
            'pageSizeParam' => false,
            'forcePageParam' => false
        ]);
        $products = $query->offset($pages->offset)->limit($pages->limit)->all();
        return  $this->render('search', compact('products', 'pages', 'q'));
    }
}