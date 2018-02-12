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
use app\models\Order;
use app\models\OrderItem;


class CardController extends AppController
{

    public function actionAdd()
    {
        $this->layout = false;
        $id = Yii::$app->request->get('id');
        $qty = (int)Yii::$app->request->get('qty');
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

    public function actionClearCard()
    {
        $this->layout = false;
        $session = Yii::$app->session;
        $session->open();
        $session->remove('card');
        $session->remove('card.qty');
        $session->remove('card.sum');
        $this->layout = false;
        return $this->render('card-model', compact('session'));
    }

    public function actionDelItem()
    {
        $id = Yii::$app->request->get('id');
        $session = Yii::$app->session;
        $session->open();
        $card = new Card();
        $card->recalc($id);
        $this->layout = false;
        return $this->render('card-model', compact('session'));
    }

    public function actionShow()
    {
        $this->layout = false;
        $session = Yii::$app->session;
        $session->open();
        $this->layout = false;
        return $this->render('card-model', compact('session'));
    }

    public function actionView()
    {
        $this->setMeta('Корзина');
        $session = Yii::$app->session;
        $session->open();
        $order = new Order();
        if ($order->load(Yii::$app->request->post())) {
            $order->qty = $session['card.qty'];
            $order->sum = $session['card.sum'];
            if ($order->save()) {
                $this->saveOrderItems($session['card'], $order->id);
                Yii::$app->session->setFlash('success', 'Ваш заказ принят. Менеджер вскоре свяжется с вами');
                $session->remove('card');
                $session->remove('card.qty');
                $session->remove('card.sum');
                return $this->refresh();
            } else {
                Yii::$app->session->setFlash('error', 'Ваш заказ принят. Менеджер вскоре свяжется с вами');
            }
        }
        return $this->render('view', compact('session', 'order'));
    }

    protected function saveOrderItems($items, $order_id) {
            foreach ($items as $id => $item) {
                $order_items = new OrderItem();
                $order_items->order_id = $order_id;
                $order_items->product_id = $id;
                $order_items->name = $item['name'];
                $order_items->price = $item['price'];
                $order_items->qty_item = $item['qty'];
                $order_items->sum_item = $item['price'] * $item['qty'];
                if (!$order_items->save()) {
                    $arr[] = $order_items->getErrors();
                }
            }
    }
}