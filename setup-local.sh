#!/bin/bash

# Copy local config to config.php
cp app/config/config.local.php app/config/config.php

echo "Local environment set up successfully!"
echo "Run the application with: php -S localhost:8000" 