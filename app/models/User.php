<?php
/**
 * Created by PhpStorm.
 * User: hairutdinovbr
 * Date: 2019-02-21
 * Time: 1:20 PM
 */

namespace app\models;


class User extends AppModel
{
    public $attributes = [
        "login" => "",
        "password" => "",
        "name" => "",
        "email" => "",
        "address" => "",
    ];

    public $rules = [
        "required" => [
            ["login"],
            ["password"],
            ["name"],
            ["email"],
            ["address"],
        ],
        "email"=>[
            ['email']
        ],
        "lengthMin" => [
            ["password", 6]
        ],
    ];

}