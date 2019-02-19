<?php
/**
 * Created by PhpStorm.
 * User: hairutdinovbr
 * Date: 2019-02-15
 * Time: 4:53 PM
 */

namespace app\controllers;


use ishop\App;
use ishop\base\Controller;
use ishop\Cache;
use RedBeanPHP\R as R;

class MainController extends AppController
{


    public function indexAction()
    {
        // App::$app->getProperty('shop_name')
        $brands = R::find('brand', " LIMIT 3");
        $hits = R::find('product', "hit = '1' AND status = '1' LIMIT 8");

        $this->setMeta( 'Главная страница', "Описание", "Ключи");

        $this->set(compact('brands', 'hits'));
    }
}