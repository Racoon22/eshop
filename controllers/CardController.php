<?php
/**
 * Created by PhpStorm.
 * User: A
 * Date: 05.02.18
 * Time: 20:31
 */

namespace app\controllers;

use app\models\Card;
use app\models\Product;
use Yii;
use yii\web\Session;

class CardController extends AppController
{
    public $layout = false;
    public function actionAdd()
    {
        $id = Yii::$app->request->get('id');
        $qty = (int) Yii::$app->request->get('qty');
        $qty = !$qty ? 1 : $qty;
        $product = Product::find()->where(['id' => $id])->one();
        if (empty($product)) {
            return false;
        }
        $session = Yii::$app->session;
        $session->open();
        $card = new Card();
        $card->addToCard($product, $qty);
        if (!Yii::$app->request->isAjax) {
            return $this->redirect(Yii::$app->request->referrer);
        }
        return $this->render('card-model', compact('session'));

    }
    public function actionClearCard() {
        $session = Yii::$app->session;
        $session->open();
        $session->remove('card');
        $session->remove('card.qty');
        $session->remove('card.sum');
        $this->layout = false;
        return $this->render('card-model', compact('session'));
    }
    public function actionDelItem() {
        $id = Yii::$app->request->get('id');
        $session = Yii::$app->session;
        $session->open();
        $card = new Card();
        $card->recalc($id);
        $this->layout = false;
        return $this->render('card-model', compact('session'));
    }
    public function actionShow() {
        $session = Yii::$app->session;
        $session->open();
        $this->layout = false;
        return $this->render('card-model', compact('session'));
    }
}