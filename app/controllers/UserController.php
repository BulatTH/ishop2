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
            if (!$user->validate($data) || !$user->checkUnique()) {
                $user->getErrors();
                $_SESSION['form_data'] = $data;
                // redirect();
            } else {
                $user->attributes["password"] = password_hash($user->attributes["password"], PASSWORD_DEFAULT);

                if ($user->save("user")) {
                    $_SESSION["success"] = "Вы успешно зарегистрированы";
                    // redirect();
                } else {
                    $_SESSION["error"] = "Ошибка при сохранении";
                }
            }

            redirect();
        }

        $this->setMeta("Signup");
    }

    public function loginAction()
    {
        if (!empty($_POST)) {
            $user = new User();
            $user->login();
            if ( $user->login() ) {
                $_SESSION["success"] = "Вы успешно авторизованы";
            } else {
                $_SESSION["error"] = "Логин или пароль введены неверно";
            }
            redirect();
        }

        $this->setMeta("Sign in");
    }

    public function logoutAction()
    {
        if ( isset($_SESSION['user']) ) unset($_SESSION['user']);
        redirect();
    }

}