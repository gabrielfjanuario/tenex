<?php
class Router 
{
    private $routes = [];

    public function add(string $route, string $method, string $action) : void
    {
        $this->routes[] = [
            'route'     => $this->convertRouteToRegex($route),
            'method'    => $method,
            'action'    => $action
        ];
    }

    public function run()
    {
        $uri    = trim($_SERVER['REQUEST_URI'], '/');
        $method = $_SERVER['REQUEST_METHOD'];

        foreach ($this->routes as $route)
        {
            if (preg_match($route['route']['regex'], $uri, $matches) && $route['method'] == $method)
            {
                $params = array_slice($matches, 1);
                $action = explode('@', $route['action']);
                $controller = $action[0];
                $method = $action[1];

                require_once "../app/Controllers/{$controller}.php";
                $controllerInstance = new $controller();
                call_user_func_array([$controllerInstance, $method], $params);
                return;
            }
        }

        http_response_code(404);
        echo json_encode(['message' => 'Not Found']);
    }

    private function convertRouteToRegex(string $route) 
    {
        $pattern = preg_replace('/\{[a-zA-Z]+\}/', '([a-zA-Z0-9_-]+)', $route);
        return ['regex' => "#^{$pattern}$#", 'original' => $route];
    }
}
