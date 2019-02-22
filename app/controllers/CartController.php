<?php
/**
 * Created by PhpStorm.
 * User: hairutdinovbr
 * Date: 2019-02-20
 * Time: 2:18 PM
 */

namespace app\controllers;


use app\models\Cart;
use app\models\Order;
use app\models\User;
use RedBeanPHP\R;

class CartController extends AppController
{
    public function addAction()
    {
        $id = (int)$_GET['id'] ?? null;
        $qty = (int)$_GET['qty'] ?? null;
        $mod_id = (isset($_GET['mod'])) ? (int)$_GET['mod'] : null;

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

    public function showAction()
    {
        $this->loadView("cart_modal");
    }

    public function deleteAction()
    {
        $id = isset($_GET['id']) ? $_GET["id"] : null;
        if (isset( $_SESSION['cart'][$id] )) {
            $cart = new Cart();
            $cart->deleteItem($id);
        }

        if ($this->isAjax()) {
            $this->loadView("cart_modal");
        }
        redirect();
    }

    public function clearAction()
    {
        unset($_SESSION['cart']);
        unset($_SESSION['cart.qty']);
        unset($_SESSION['cart.sum']);
        unset($_SESSION['cart.currency']);

        if ($this->isAjax()) {
            $this->loadView("cart_modal");
        }
        redirect();
    }

    public function viewAction()
    {
        $this->setMeta("Корзина", "","");

    }

    public function checkoutAction()
    {
        if (!empty($_POST)) {
            // Регистрация пользователя, если не авторизован
            if ( !User::checkAuth() ) {

                $user = new User();
                $data = $_POST;
                $user->load($data);
                if (!$user->validate($data) || !$user->checkUnique()) {
                    $user->getErrors();
                    $_SESSION['form_data'] = $data;
                     redirect();
                } else {
                    $user->attributes["password"] = password_hash($user->attributes["password"], PASSWORD_DEFAULT);

                    if (!$user_id = $user->save("user")) {
                        $_SESSION["error"] = "Ошибка при сохранении";
                        redirect();
                    }
                }

            }

            //Сохранение заказа
            $data["user_id"] = ( isset($user_id) ? $user : $_SESSION["user"]["id"] );
            $data["note"] = !empty( $_POST["note"] ) ? h($_POST["note"]) : "";
            $user_email = isset($_SESSION["user"]["email"]) ? $_SESSION["user"]["email"] : $_POST["email"];

            $order_id = Order::saveOrder($data);
            Order::mailOrder($order_id, $user_email);
        }

        redirect();
    }

}