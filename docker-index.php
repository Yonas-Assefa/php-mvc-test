<?php
// Simple script to test Docker setup without MVC framework

echo "<h1>PHP MVC Docker Test</h1>";
echo "<p>PHP version: " . phpversion() . "</p>";
echo "<p>Environment: " . (getenv('DOCKER_ENV') ? 'Docker' : 'Local') . "</p>";

// Test API connection
$apiUrl = 'https://jsonplaceholder.typicode.com/users';
echo "<h2>API Connection Test</h2>";
$json = @file_get_contents($apiUrl);

if ($json) {
    $data = json_decode($json, true);
    echo "<p>Successfully connected to API.</p>";
    echo "<p>Found " . count($data) . " users.</p>";
    
    echo "<table border='1' cellpadding='5'>";
    echo "<tr><th>ID</th><th>Name</th><th>Email</th></tr>";
    
    foreach (array_slice($data, 0, 3) as $user) {
        echo "<tr>";
        echo "<td>" . $user['id'] . "</td>";
        echo "<td>" . $user['name'] . "</td>";
        echo "<td>" . $user['email'] . "</td>";
        echo "</tr>";
    }
    
    echo "</table>";
} else {
    echo "<p>Failed to connect to API.</p>";
}

echo "<h2>Directory Structure</h2>";
echo "<pre>";
$files = scandir('.');
foreach ($files as $file) {
    if ($file != '.' && $file != '..') {
        if (is_dir($file)) {
            echo "[DIR] $file\n";
            
            if ($file == 'app') {
                $appFiles = scandir('./app');
                foreach ($appFiles as $appFile) {
                    if ($appFile != '.' && $appFile != '..') {
                        echo "   └─ $appFile\n";
                    }
                }
            }
        } else {
            echo "[FILE] $file\n";
        }
    }
}
echo "</pre>";
?> 