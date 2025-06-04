<?php
class Router {
    private $routes = [];
    
    public function addRoute($url, $controller, $method, $action) {
        $this->routes[$url] = [
            'controller' => $controller,
            'method' => $method,
            'action' => $action
        ];
    }
    
    public function dispatch($requestUrl, $requestMethod) {
        $requestUrl = parse_url($requestUrl, PHP_URL_PATH);
        
        // Check for exact matches first
        if (isset($this->routes[$requestUrl])) {
            $route = $this->routes[$requestUrl];
            if ($route['method'] === $requestMethod) {
                $this->callAction(
                    $route['controller'],
                    $route['action']
                );
                return;
            }
        }
        
        // Check for dynamic routes (simplified)
        foreach ($this->routes as $pattern => $route) {
            if (strpos($pattern, ':') !== false) {
                $regex = str_replace(':id', '(\d+)', $pattern);
                $regex = "@^" . preg_replace('/\//', '\\/', $regex) . "$@D";
                
                if (preg_match($regex, $requestUrl, $matches) && 
                    $route['method'] === $requestMethod) {
                    array_shift($matches);
                    $this->callAction(
                        $route['controller'],
                        $route['action'],
                        $matches
                    );
                    return;
                }
            }
        }
        
        // Route not found
        header("HTTP/1.0 404 Not Found");
        echo "Page not found";
        exit;
    }
    
    private function callAction($controller, $action, $params = []) {
        require_once __DIR__ . '/../controllers/HomeController.php';
        $controllerInstance = new $controller();
        call_user_func_array([$controllerInstance, $action], $params);
    }
}