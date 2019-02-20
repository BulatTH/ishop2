<?php
/**
 * Created by PhpStorm.
 * User: hairutdinovbr
 * Date: 2019-02-20
 * Time: 11:08 AM
 */

namespace app\models;


use ishop\App;

class Breadcrumbs
{
    public static function getBreadcrumbs($category_id, $name = "")
    {
        $cats = App::$app->getProperty("cats");
        $breadcrumbs_arr = self::getParts($cats, $category_id);
        $breadcrumbs = "<li> <a href='".PATH."'> Главная </a> </li>";
        if ($breadcrumbs_arr) {
            foreach ($breadcrumbs_arr as $alias => $title) {
                $breadcrumbs .= "<li> <a href='" . PATH . "/category/{$alias}" . "'> {$title} </a> </li>";
            }
        }
        if ($name){
            $breadcrumbs .= "<li> {$name} </li>";
        }
        return $breadcrumbs;
    }

    public static function getParts($cats, $id)
    {
        if (!$id) return false;
        $breadcrumbs = [];
        foreach ($cats as $k => $v) {
            if ( isset($cats[$id]) ) {
                $breadcrumbs[$cats[$id]["alias"]] = $cats[$id]['title'];
                $id = $cats[$id]['parent_id'];
            } else
                break;
        }
        return array_reverse( $breadcrumbs, true );

    }

}