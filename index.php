<?php
// Determine if we're in Docker environment
$dockerEnv = getenv('DOCKER_ENV');

// Choose the appropriate bootstrap path based on environment
if ($dockerEnv === 'true') {
    require_once __DIR__ . '/app/bootstrap.php';
} else {
    require_once 'app/bootstrap.php';
}

// Initialize the application
$app = new App(); 