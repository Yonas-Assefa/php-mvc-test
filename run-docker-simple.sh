#!/bin/bash

# Set up Docker environment configuration
./setup-docker.sh

# Stop any existing Docker container
docker compose down

# Run the simplified PHP server in Docker
docker compose -f docker-compose.php.yml up -d

echo "MVC application is running in Docker."
echo "Access the application at: http://localhost:8080"
echo "Use filters like: http://localhost:8080?category=admin" 