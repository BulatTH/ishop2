<?php
/**
 * Created by PhpStorm.
 * User: hairutdinovbr
 * Date: 2019-02-20
 * Time: 10:09 AM
 */

namespace app\models;


class Product extends AppModel
{
    protected $recentlyViewedCookieTime = 7;

    public function setRecentlyViewed($id)
    {
        $recentlyViewed = $this->getAllRecentlyViewed();
        if (!$recentlyViewed) {
            setcookie("recentlyViewed", $id, time() + 3600 * 24 * $this->recentlyViewedCookieTime, "/");
        } else {
            $recentlyViewed = explode(".", $recentlyViewed);
            if ( !in_array($id, $recentlyViewed) ) {
                $recentlyViewed[] = $id;
                $recentlyViewed = implode(".", $recentlyViewed);
                setcookie("recentlyViewed", $recentlyViewed, time() + 3600 * 24 * $this->recentlyViewedCookieTime, "/");
            }
        }
    }

    public function getRecentlyViewed()
    {
        if (!empty($_COOKIE['recentlyViewed'])) {
            $recentlyViewed = $_COOKIE['recentlyViewed'];
            $recentlyViewed = explode(".", $recentlyViewed);
            return array_slice($recentlyViewed, -3);
        }
        return false;
    }

    public function getAllRecentlyViewed()
    {
        if (!empty($_COOKIE['recentlyViewed'])) {
            return $_COOKIE['recentlyViewed'];
        }
        return false;
    }


}