<?php
/**
 * Created by PhpStorm.
 * User: hairutdinovbr
 * Date: 2019-02-20
 * Time: 2:18 PM
 */

namespace app\controllers;


use app\models\Cart;
use RedBeanPHP\R;

class CartController extends AppController
{
    public function addAction()
    {
        $id = (int)$_GET['id'] ?? null;
        $qty = (int)$_GET['qty'] ?? null;
        $mod_id = (int)$_GET['mod'] ?? null;
        $mod = null;
        if ($id) {
            $product = R::findOne("product", "id = ?", [$id]);

            if (!$product) return false;

            if ($mod_id) {
                $mod = R::findOne("modification", "id = :mod_id AND product_id = :prod_id", [
                    ":mod_id" => $mod_id,
                    ":prod_id" => $id
                ]);
            }
        }
        $cart = new Cart();
        $cart->addToCart($product, $qty, $mod);
        if ($this->isAjax()) {
            $this->loadView("cart_modal");
        }
        redirect();

    }
}