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
        $sql_part = [];
        foreach ($_SESSION["cart"] as $product_id => $product) {
            $product_id = (int)$product_id;
            $sql_part[] =  "({$order_id}, {$product_id}, {$product['qty']}, '{$product['title']}', {$product['price']})";
        }
        $query = "INSERT INTO `order_product`(`order_id`, `product_id`, `qty`, `title`, `price`) VALUES " . implode(",", $sql_part);
        R::exec($query);
    }

    public static function mailOrder($order_id, $email)
    {
        
    }
    
}