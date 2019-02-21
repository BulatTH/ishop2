<?php
/**
 * Created by PhpStorm.
 * User: hairutdinovbr
 * Date: 2019-02-21
 * Time: 9:43 AM
 */

namespace app\models;


use ishop\App;

class Category extends AppModel
{
    public function getIds($id)
    {
        $cats = App::$app->getProperty("cats");
        $ids = null;
        foreach ($cats as $k => $v) {
            if ($v['parent_id'] == $id) {
                $ids .= $k . ",";
                $ids .= $this->getIds($k);
            }
        }
        return $ids;
    }


}