# PHP MVC Data Display

A simple PHP MVC application that loads and displays JSON data in a table with filtering capabilities.

## Features

- Follows MVC architecture pattern
- Displays JSON data in a Bootstrap-styled table
- Allows filtering data by category using GET parameters
- Responsive design

## Installation

1. Clone this repository to your web server
2. Make sure you have PHP 7.0+ installed
3. Configure the app:
   - Update the `URLROOT` in `app/config/config.php` to match your server setup
   - Data is stored in `app/data/data.json`

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
  - `data/` - JSON data
  - `config/` - Configuration files
  - `helpers/` - Helper functions
- `public/` - Publicly accessible files 