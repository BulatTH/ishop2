<?php
/**
 * Created by PhpStorm.
 * User: hairutdinovbr
 * Date: 2019-02-21
 * Time: 1:19 PM
 */

namespace app\controllers;


use app\models\User;

class UserController extends AppController
{
    public function signupAction()
    {
        if (!empty($_POST)) {
            $user = new User();
            $data = $_POST;
            $user->load($data);

            debug($user);
            die;
        }

        $this->setMeta("Signup");
    }

    public function loginAction()
    {

    }

    public function logoutAction()
    {

    }

}