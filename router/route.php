<?php
require_once '../config/configRoute.php';
$router = new Router();
$router->get('/products', 'ProductController', 'getAll');
$router->get('/products/type', 'ProductController', 'getType');
$router->get('/products/laptop', 'ProductController', 'getLap');
$router->get('/products/access', 'ProductController', 'getAccess');
$router->get('/products/new', 'ProductController', 'getNew');
$router->get('/products/view', 'ProductController', 'getView');
$router->get('/products/detail/:id', 'ProductController', 'detail');
$router->post('/products/image','ProductController','image');
$router->post('/products/delete', 'ProductController', 'deleteProduct');
$router->post('/products/updateview', 'ProductController', 'updateViewProduct');

$router->get('/transport', 'TransController', 'getAll');
$router->post('/transport/update', 'TransController', 'updateStatusTransport');
$router->post('/transport/delete', 'TransController', 'deleteItem');
$router->post('/transport/switch', 'TransController', 'switchDataToBill');
$router->post('/transport/insert', 'TransController', 'switchToTransport');

$router->get('/comment', 'CommentController', 'getAll');
$router->get('/comment/:id', 'CommentController', 'commentByIdProduct');
$router->post('/comment/insert', 'CommentController', 'commentInsert');
$router->post('/comment/delete', 'CommentController', 'commentDelete');

$router->post('/cart', 'CartController', 'index');

$router->get('/user/:idUser','UserController','getUser');
$router->post('/user/update','UserController','updateUser');
$router->post('/user/image','UserController','updateImage');
$router->get('/user/transport/:idUser', 'TransController', 'viewTransportByUser');
$router->get('/user/bought/:idUser', 'UserController', 'viewBought');

$router->get('/ware/total', 'WareHouseController', 'getTotalProduct');
$router->get('/ware', 'WareHouseController', 'getAll');

$router->get('/statistics/type', 'ProductController', 'typeStatistics');
$router->get('/statistics/staff', 'UserController', 'staffStatistics');

$router->run();

?>
