<?php



require_once '../../vendor/altorouter/altorouter/AltoRouter.php';
require_once '../../vendor/autoload.php';


$uri = $_SERVER['REQUEST_URI'];



$router = new AltoRouter();

$router->map('GET|POST', '/API/', 'accueil');
$router->map('GET|POST', '/API/afficher/[i:y]-[i:id]', 'afficher', 'afficher');
$router->map('GET|POST', '/API/supprimer/[i:y]-[i:id]', 'supprimer', 'supprimer');
$router->map('GET|POST', '/API/categorie/[*:categorie]', 'categorie','categorie'); 
            //methode,          url,          nomfichier,     nommap
$router->map('GET|POST', '/API/annonces', 'annonces', 'annonces');

$router->map('GET|POST', '/API/[*:categorie]','accueil'); //le slug s'utilise dans l'url


$match = $router->match();
if (is_array($match)) {
   // require_once '../app/views/elements/header.php';

    if (is_callable($match['target'])) {
        call_user_func_array($match['target'], $match['params']);
    } else {
        $params = $match['params'];
        require "../../views/{$match['target']}.php";
    }

   // require_once '../app/views/elements/footer.php';
} else {
    echo 'Erreur 404';
}
// print_r($params);