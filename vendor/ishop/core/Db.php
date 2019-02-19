<?php
/**
 * Created by PhpStorm.
 * User: hairutdinovbr
 * Date: 2019-02-16
 * Time: 6:53 AM
 */

namespace ishop;

use \RedBeanPHP\R as R;
use ishop\traits\TSingleton;

class Db
{
    use TSingleton;

    protected function __construct()
    {
        $db = require_once CONF . "/config_db.php";
        R::setup($db['dsn'], $db['user'], $db['password']);

        if ( !R::testConnection() ) {
            throw new \Exception("Нет соединения с БД", 500);
        }
        R::freeze(true);
        if (DEBUG){
            R::debug(true, 1);
        }

    }
}