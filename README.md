# PHP MVC Data Display

A simple PHP MVC application that loads and displays data from JSONPlaceholder API in a table with filtering capabilities.

## Features

- Follows MVC architecture pattern
- Fetches data from JSONPlaceholder API (with local JSON backup)
- Displays data in a Bootstrap-styled table
- Allows filtering data by category using GET parameters
- Responsive design
- Supports both local development and Docker environments

## Data Source

The application fetches user data from the JSONPlaceholder API (https://jsonplaceholder.typicode.com/users) and assigns random categories (customer, admin, employee) to each user for demonstration purposes. If the API is unavailable, it falls back to a local JSON file.

## Installation

### Local Development Environment

1. Clone this repository
2. Make sure you have PHP 7.0+ installed
3. Run the setup script:
   ```
   ./setup-local.sh
   ```
4. Run the built-in PHP server:
   ```
   php -S localhost:8000
   ```
5. Access the application at http://localhost:8000

### Docker Environment (Simple Method)

1. Clone this repository
2. Make sure you have Docker and Docker Compose installed
3. Run the simplified Docker setup script:
   ```
   ./run-docker-simple.sh
   ```
4. Access the application at http://localhost:8080

### Docker Environment (Apache Method)

**Note: This method is more complex and may require additional configuration.**

1. Clone this repository
2. Make sure you have Docker and Docker Compose installed
3. Run the setup script:
   ```
   ./setup-docker.sh
   ```
4. Build and run the Docker container:
   ```
   docker compose up -d --build
   ```
5. Access the application at http://localhost:8080

## Troubleshooting Docker Setup

If you encounter issues with the Docker setup, try these steps:

1. Verify Docker is running:
   ```
   docker --version
   docker compose version
   ```

2. Try the simpler Docker setup:
   ```
   ./run-docker-simple.sh
   ```

3. Check if the container is running:
   ```
   docker compose ps
   ```

4. View container logs:
   ```
   docker compose logs
   ```

5. If you make changes to the code, rebuild the Docker container:
   ```
   docker compose down
   docker compose up -d --build
   ```

6. Ensure proper file permissions:
   ```
   sudo chown -R $USER:$USER .
   ```

## Configuration

The application uses different configuration files based on the environment:

- `app/config/config.php` - Default configuration for Apache
- `app/config/config.local.php` - Configuration for local development with PHP built-in server
- `app/config/config.docker.php` - Configuration for Docker environment

## Usage

- Access the application through your web browser
- You can filter the data by clicking on the category buttons
- The URL will update with the category parameter (e.g., `?category=admin`)

## Structure

- `app/` - Application code
  - `controllers/` - Controller classes
  - `models/` - Model classes
  - `views/` - View files
  - `core/` - Core framework classes
  - `data/` - JSON data (backup)
  - `config/` - Configuration files
  - `helpers/` - Helper functions
- `public/` - Publicly accessible files
- `Dockerfile` - Docker configuration
- `docker-compose.yml` - Docker Compose configuration for Apache setup
- `docker-compose.php.yml` - Simplified Docker Compose using PHP built-in server 