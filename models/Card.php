<?php
/**
 * Created by PhpStorm.
 * User: A
 * Date: 05.02.18
 * Time: 20:32
 */

namespace app\models;


use yii\base\Model;

class Card extends Model
{
    public function addToCard($product, $qty = 1)
    {
        if (isset($_SESSION['card'][$product->id])) {
            $_SESSION['card'][$product->id]['qty'] = $_SESSION['card'][$product->id]['qty'] + $qty;
        } else {
            $_SESSION['card'][$product->id] = [
                'qty' => $qty,
                'name' => $product->name,
                'price' => $product->price,
                'img' => $product->img,
            ];
        }
        $_SESSION['card.qty'] = (isset($_SESSION['card.qty'])) ? $_SESSION['card.qty'] + $qty : $qty;
        $_SESSION['card.sum'] = (isset($_SESSION['card.sum'])) ? $_SESSION['card.sum'] + $qty * $product->price : $qty * $product->price;
    }
    public function recalc($id) {
        if (!isset($_SESSION['card'][$id])) return false;
        $qtyMinus = $_SESSION['card'][$id]['qty'];
        $sumMinus = $_SESSION['card'][$id]['qty'] * $_SESSION['card'][$id]['price'];
        $_SESSION['card.qty'] -= $qtyMinus;
        $_SESSION['card.sum'] -= $sumMinus;
        unset($_SESSION['card'][$id]);
    }
}