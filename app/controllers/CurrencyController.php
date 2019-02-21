<?php
/**
 * Created by PhpStorm.
 * User: hairutdinovbr
 * Date: 2019-02-19
 * Time: 2:10 PM
 */

namespace app\controllers;


use app\models\Cart;
use RedBeanPHP\R;

class CurrencyController extends AppController
{
    public function changeAction()
    {
        $currency = $_GET["curr"] ?? null;
        if ($currency) {
            $curr = R::findOne("currency", " code = ?", [$currency]);
            if (!empty($curr)) {
                setcookie("currency", $currency, time() + 3600 * 24 * 7, "/");
                Cart::recalc($curr);
            }
        }
        redirect();
    }
}