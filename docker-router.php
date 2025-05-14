<?php
// This is a router for PHP's built-in web server

// Enable environment variable for Docker
putenv('DOCKER_ENV=true');

// For static files, serve them directly
if (preg_match('/\.(?:css|js|png|jpg|jpeg|gif|ico)$/', $_SERVER['REQUEST_URI'])) {
    return false;
}

// For test pages, serve them directly
if (preg_match('/^\/docker-/', $_SERVER['REQUEST_URI'])) {
    return false;
}

// Parse the URL for our MVC framework
if ($_SERVER['REQUEST_URI'] !== '/' && $_SERVER['REQUEST_URI'] !== '') {
    $uri = trim($_SERVER['REQUEST_URI'], '/');
    $_GET['url'] = $uri;
}

// Load the main MVC application
require __DIR__ . '/index.php';
?> 