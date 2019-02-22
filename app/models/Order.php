<?php
/**
 * Created by PhpStorm.
 * User: hairutdinovbr
 * Date: 2019-02-22
 * Time: 8:29 AM
 */

namespace app\models;


use ishop\App;
use RedBeanPHP\R;

class Order extends AppModel
{
    public static function saveOrder($data)
    {
        $order = R::dispense('order');

        $order->user_id = $data['user_id'];
        $order->note = $data['note'];
        $order->currency = $_SESSION['cart.currency']['code'];

        $order_id = R::store($order);
        self::saveOrderProduct($order_id);

        return $order_id;
    }

    public static function saveOrderProduct($order_id)
    {
        return $order_id;
    }

    public static function mailOrder($order_id, $email)
    {
        
    }
    
}