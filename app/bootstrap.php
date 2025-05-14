<?php
// Load configuration
require_once 'config/config.php';

// Load helpers
require_once 'helpers/url_helper.php';

// Autoload core classes
spl_autoload_register(function($className) {
    if (file_exists('app/core/' . $className . '.php')) {
        require_once 'app/core/' . $className . '.php';
    } elseif (file_exists('app/controllers/' . $className . '.php')) {
        require_once 'app/controllers/' . $className . '.php';
    } elseif (file_exists('app/models/' . $className . '.php')) {
        require_once 'app/models/' . $className . '.php';
    }
}); 