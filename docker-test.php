<?php
// This is a simple test file to check if PHP is working in Docker
echo "<h1>PHP Docker Test</h1>";
echo "<p>PHP version: " . phpversion() . "</p>";
echo "<p>Docker environment variable: " . (getenv('DOCKER_ENV') ? 'true' : 'false') . "</p>";
echo "<pre>";
echo "Current working directory: " . getcwd() . "\n";
echo "Directory listing:\n";
print_r(scandir('.'));
echo "</pre>";
?> 