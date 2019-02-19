<?php
use ishop\Router;



// default routes
Router::add("^admin$", ['controller' => "Main", "action"=>"index", "prefix"=>"admin"]); // adminka
Router::add("^admin/?(?P<controller>[a-z-]+)/?(?P<action>[a-z-]+)?$", ["prefix"=>"admin"]);


Router::add("^$", ['controller' => "Main", "action"=>"index"]); // Главная страницы (пустая строка)
Router::add("^(?P<controller>[a-z-]+)/?(?P<action>[a-z-]+)?$");
