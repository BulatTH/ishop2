<?php
/**
 * Created by PhpStorm.
 * User: hairutdinovbr
 * Date: 2019-02-20
 * Time: 8:44 AM
 */

namespace app\controllers;


use RedBeanPHP\R;

class ProductController extends AppController
{
    public function viewAction()
    {
        $alias = $this->route['alias'];
        $product = R::findOne("product", "status = '1' AND alias = ?", [$alias]);
        if (!$product) {
            throw new \Exception("Страница не найдена", 404);
        }

        // Breadcrumbs

        // Связанные товары

        $related = R::getAll("SELECT * FROM related_product JOIN product ON product.id = related_product.related_id WHERE related_product.product_id = ?", [$product->id]);

        // Запись в куки запрощенного товара

        // Получить все просмотренные товары из кук

        // Галерея

        // Все модификации товара

        $this->setMeta($product->title, $product->description, $product->keywords);
        $this->set(compact('product', 'related'));
    }
}