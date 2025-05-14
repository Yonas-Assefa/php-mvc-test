<?php
class App {
    protected $controller = 'Data';
    protected $method = 'index';
    protected $params = [];

    public function __construct() {
        // Determine environment
        $dockerEnv = getenv('DOCKER_ENV');
        
        // Set controller path based on environment
        if ($dockerEnv === 'true') {
            $controllerPath = __DIR__ . '/../controllers/';
        } else {
            $controllerPath = 'app/controllers/';
        }
        
        $url = $this->parseUrl();

        // Check for controller
        if(isset($url[0]) && file_exists($controllerPath . ucwords($url[0]) . '.php')) {
            $this->controller = ucwords($url[0]);
            unset($url[0]);
        }

        // Require the controller
        require_once $controllerPath . $this->controller . '.php';
        $this->controller = new $this->controller;

        // Check for method
        if(isset($url[1])) {
            if(method_exists($this->controller, $url[1])) {
                $this->method = $url[1];
                unset($url[1]);
            }
        }

        // Get parameters
        $this->params = $url ? array_values($url) : [];

        // Call the method with parameters
        call_user_func_array([$this->controller, $this->method], $this->params);
    }

    protected function parseUrl() {
        if(isset($_GET['url'])) {
            $url = rtrim($_GET['url'], '/');
            $url = filter_var($url, FILTER_SANITIZE_URL);
            return explode('/', $url);
        }
        return [];
    }
} 