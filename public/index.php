<?php

define('ROOT', dirname(__DIR__));

require_once ROOT.'/vendor/altorouter/altorouter/AltoRouter.php';
require_once ROOT.'/vendor/autoload.php';

$uri = $_SERVER['REQUEST_URI'];


$router = new AltoRouter();

$router->map('GET|POST', '/', 'produits','produits');


$match = $router->match();

if (is_array($match)) {
    if (is_callable($match['target'])) {
        call_user_func_array($match['target'], $match['params']);
    } else {
        $params = $match['params'];
        ob_start();
        require ROOT."/src/views/{$match['target']}.php";
        $pageContent = ob_get_clean();
    }
    require_once ROOT.'/src/views/elements/layout.php';
} else {
    require ROOT."/src/views/produits.php";
    echo 'Erreur 404';
}
