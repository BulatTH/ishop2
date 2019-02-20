<?php
/**
 * Created by PhpStorm.
 * User: hairutdinovbr
 * Date: 2019-02-20
 * Time: 8:44 AM
 */

namespace app\controllers;


use app\models\Product;
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
        $pModel = new Product();
        $pModel->setRecentlyViewed($product->id);

        // Получить все просмотренные товары из кук
        $r_viewed = $pModel->getRecentlyViewed();
        $recentlyViewed = null;
        if ($r_viewed) {
            $recentlyViewed = R::find("product", "id IN (". R::genSlots($r_viewed) .") LIMIT 3", $r_viewed);
        }


        // Галерея
        $gallery = R::findAll("gallery", "product_id = ?", [$product->id]);

        // Все модификации товара

        $this->setMeta($product->title, $product->description, $product->keywords);
        $this->set(compact(
            'product',
            'related',
            'gallery',
            'recentlyViewed'
        ));
    }
}