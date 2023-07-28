<?php
  require_once '../controller/productController.php';
  require_once '../controller/cartController.php';
  require_once '../controller/transportController.php';
  require_once '../controller/userController.php';
  require_once '../controller/commentController.php';
  require_once '../controller/warehouseController.php';
  class Router
  {
    const GET = 'GET';
    const POST = 'POST';
    const ANY = 'ANY';
    private $routes = [];
  
    public function get($uri, $controller, $method)
    {
      $this->routes[self::GET][$uri] = [$controller, $method];
    }
  
    public function post($uri, $controller, $method)
    {
      $this->routes[self::POST][$uri] = [$controller, $method];
    }
  
    public function run()
    {
      $method = $_SERVER['REQUEST_METHOD'];
      $uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
      $routes = $this->routes[$method];
      $subPath = substr($uri, strlen('/api'));

      foreach ($routes as $route => $handler) {
          // Replace any placeholders with a regular expression
          $route = preg_replace('/:\w+/', '(\w+)', $route);
          if (preg_match("#^$route$#", $subPath, $matches)) {
              // Remove the first match, which is the entire matched string
              array_shift($matches);
              // Call the handler with any matched parameters
              list($controller, $method) = $handler;
              $controller = new $controller();
              call_user_func_array([$controller, $method], $matches);
              return;
          }
      }

      echo '404 Not Found';
    }


  }
?>