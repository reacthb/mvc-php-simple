<?php

require __DIR__ . '/../src/controller/HomeController.php';
require __DIR__ . '/../src/controller/CrudController.php';
require __DIR__ . '/../src/controller/ErrorController.php';

$parseUrl = parse_url($_SERVER['REQUEST_URI']);
if (!$parseUrl) {
    $route = 'notFound';
    $query = null;
} else {
    $route = $parseUrl['path'];
    parse_str($_SERVER['QUERY_STRING'], $query);
}
$route = strtolower($route);
//var_dump($route);

switch ($route) {
    case '/' :
    case '/home' :
        homeController();
        break;
    case '/create' :
        createController();
        break;
    case '/read' :
        readController();
        break;
    case '/update' :
        updateController();
        break;
    case '/update-single' :
        if (isset($_GET['id'])) {
            updateSingleController($_GET['id']);
        } else {
            updateController();
        }
        break;
    case '/delete' :
        deleteController();
        break;
    default:
        errorController('Page introuvable');
}