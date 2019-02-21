<?php
use ishop\Router;

// user routes
Router::add("^product/(?P<alias>[a-z0-9-]+)/?$", ['controller' => "Product", "action"=>"view"]); // Product alias

Router::add("^category/(?P<alias>[a-z0-9-]+)/?$", ['controller' => "Category", "action"=>"view"]); // Category alias

// default routes
Router::add("^admin$", ['controller' => "Main", "action"=>"index", "prefix"=>"admin"]); // adminka
Router::add("^admin/?(?P<controller>[a-z-]+)/?(?P<action>[a-z-]+)?$", ["prefix"=>"admin"]);

Router::add("^$", ['controller' => "Main", "action"=>"index"]); // Главная страницы (пустая строка)
Router::add("^(?P<controller>[a-z-]+)/?(?P<action>[a-z-]+)?$");