<?php
/**
 * Created by PhpStorm.
 * User: hairutdinovbr
 * Date: 2019-02-21
 * Time: 8:47 AM
 */

namespace app\controllers;


use RedBeanPHP\R;

class SearchController extends AppController
{

    public function typeaheadAction()
    {
        if ($this->isAjax()) {
            $query = !empty(trim($_GET['query'])) ? trim($_GET['query']) : null;
            if ($query) {
                $products = R::getAll("SELECT id, title FROM product WHERE title LIKE ? LIMIT 11", ["%{$query}%"]);
                echo json_encode($products);
            }
        }
        die();
    }
}