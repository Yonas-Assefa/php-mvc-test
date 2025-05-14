<?php
// Determine environment
$dockerEnv = getenv('DOCKER_ENV');

// Adjust paths for Docker environment
if ($dockerEnv === 'true') {
    // When in Docker, we might be in the root directory
    $appPath = __DIR__ . '/'; // For includes within the app directory
    $corePath = __DIR__ . '/core/';
    $controllerPath = __DIR__ . '/controllers/';
    $modelPath = __DIR__ . '/models/';
    
    // Load Docker configuration
    require_once __DIR__ . '/config/config.docker.php';
} else if (file_exists('app/config/config.local.php') && php_sapi_name() === 'cli-server') {
    // For PHP built-in server, use local config and paths
    $appPath = 'app/';
    $corePath = 'app/core/';
    $controllerPath = 'app/controllers/';
    $modelPath = 'app/models/';
    
    require_once 'config/config.local.php';
} else {
    // Default config for Apache
    $appPath = 'app/';
    $corePath = 'app/core/';
    $controllerPath = 'app/controllers/';
    $modelPath = 'app/models/';
    
    require_once 'config/config.php';
}

// Load Logger class first as other classes may depend on it
require_once $corePath . 'Logger.php';

// Initialize the global logger instance
$GLOBALS['logger'] = new Logger();

// Load helpers
require_once $appPath . 'helpers/url_helper.php';
require_once $appPath . 'helpers/logger_helper.php';

// Log application start
log_info('Application started', ['environment' => $dockerEnv === 'true' ? 'docker' : 'local']);

// Autoload core classes
spl_autoload_register(function($className) use ($corePath, $controllerPath, $modelPath) {
    if (file_exists($corePath . $className . '.php')) {
        require_once $corePath . $className . '.php';
    } elseif (file_exists($controllerPath . $className . '.php')) {
        require_once $controllerPath . $className . '.php';
    } elseif (file_exists($modelPath . $className . '.php')) {
        require_once $modelPath . $className . '.php';
    }
}); 