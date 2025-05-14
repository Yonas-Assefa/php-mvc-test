#!/bin/bash

# Copy docker config to config.php
cp app/config/config.docker.php app/config/config.php

echo "Docker environment set up successfully!"
echo "Build and run with: docker-compose up -d"
echo "Access the application at: http://localhost:8080" 