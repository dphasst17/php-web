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
$router->get('/products/detail/:idType/:idProduct', 'ProductController', 'getProductDifferentId');
$router->get('/products/search/:keyword', 'ProductController', 'searchProduct');

$router->post('/products/add', 'ProductController', 'addNewProduct');
$router->post('/products/update', 'ProductController', 'updateProduct');
$router->post('/products/image','ProductController','image');
$router->post('/products/delete/:idProduct', 'ProductController', 'deleteProduct');
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

$router->get('/user/all','UserController','getALlUser');
$router->get('/user/info/:idUser','UserController','getIdAdmin');
$router->get('/user','UserController','getUser');
$router->post('/user/update','UserController','updateUser');
$router->post('/user/image','UserController','updateImage');
$router->get('/user/transport', 'TransController', 'viewTransportByUser');
$router->get('/user/bought', 'UserController', 'viewBought');
$router->post('/staff/change', 'UserController', 'changeRole');

$router->post('/login', 'UserController', 'userLogin');
$router->get('/new/token','TokenController','getNewToken');

$router->get('/ware/total', 'WareHouseController', 'getTotalProduct');
$router->get('/ware', 'WareHouseController', 'getAll');
$router->post('/ware/insert', 'WareHouseController', 'insertWare');

$router->get('/statistics/type', 'ProductController', 'typeStatistics');
$router->get('/statistics/staff', 'UserController', 'staffStatistics');

$router->run();

?>
