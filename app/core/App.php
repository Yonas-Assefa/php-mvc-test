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
        log_info('Routing request', [
            'url' => $url, 
            'method' => $_SERVER['REQUEST_METHOD'] ?? 'unknown',
            'ip' => $_SERVER['REMOTE_ADDR'] ?? 'unknown'
        ]);

        // Check for controller
        if(isset($url[0]) && file_exists($controllerPath . ucwords($url[0]) . '.php')) {
            $this->controller = ucwords($url[0]);
            unset($url[0]);
            log_debug('Controller found', ['controller' => $this->controller]);
        } else {
            log_debug('Using default controller', ['controller' => $this->controller]);
        }

        try {
            // Require the controller
            require_once $controllerPath . $this->controller . '.php';
            $this->controller = new $this->controller;

            // Check for method
            if(isset($url[1])) {
                if(method_exists($this->controller, $url[1])) {
                    $this->method = $url[1];
                    unset($url[1]);
                    log_debug('Method found', ['method' => $this->method]);
                } else {
                    log_warning('Method not found, using default', [
                        'requested' => $url[1], 
                        'using' => $this->method
                    ]);
                }
            } else {
                log_debug('Using default method', ['method' => $this->method]);
            }

            // Get parameters
            $this->params = $url ? array_values($url) : [];
            log_debug('Parameters', ['params' => $this->params]);

            // Call the method with parameters
            call_user_func_array([$this->controller, $this->method], $this->params);
            
            log_info('Request completed successfully', [
                'controller' => get_class($this->controller),
                'method' => $this->method
            ]);
        } catch (Exception $e) {
            log_error('Application error', [
                'message' => $e->getMessage(),
                'file' => $e->getFile(),
                'line' => $e->getLine()
            ]);
            
            // Display error page or message
            echo '<h1>Application Error</h1>';
            echo '<p>An error occurred while processing your request. Please try again later.</p>';
        }
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