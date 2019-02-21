<?php
/**
 * Created by PhpStorm.
 * User: hairutdinovbr
 * Date: 2019-02-16
 * Time: 6:45 AM
 */

namespace ishop\base;


use ishop\Db;

abstract class Model
{
    public $attributes = [];
    public $errors = [];
    public $rules = [];

    public function __construct()
    {
        Db::instance();
    }

    public function load($data)
    {
        foreach ($this->attributes as $attrName => $v) {
            if ( isset($data[$attrName]) ) {
                $this->attributes[$attrName] = $data[$attrName];
            }
        }
    }
    
}