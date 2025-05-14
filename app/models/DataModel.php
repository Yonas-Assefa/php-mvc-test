<?php
class DataModel {
    private $dataPath;
    private $apiUrl = 'https://jsonplaceholder.typicode.com/users';
    private $categories = ['customer', 'admin', 'employee'];
    
    public function __construct() {
        $this->dataPath = DATA_PATH;
        log_debug('DataModel initialized', ['dataPath' => $this->dataPath]);
    }
    
    // Get all data or filtered by category
    public function getData($category = null) {
        log_info('Getting data', ['category' => $category]);
        $data = $this->fetchFromApi();
        
        // If no category filter is specified, return all data
        if (empty($category)) {
            log_debug('Returning all data', ['count' => count($data)]);
            return $data;
        }
        
        // Filter data by category
        $filteredData = array_filter($data, function($item) use ($category) {
            return $item['category'] === $category;
        });
        
        $result = array_values($filteredData); // Reindex array
        log_debug('Returning filtered data', ['category' => $category, 'count' => count($result)]);
        return $result;
    }
    
    // Get all unique categories
    public function getCategories() {
        log_debug('Getting categories');
        return $this->categories;
    }
    
    // Fetch data from the API
    private function fetchFromApi() {
        log_info('Fetching data from API', ['url' => $this->apiUrl]);
        $jsonData = @file_get_contents($this->apiUrl);
        
        // If API request fails, try to use local data
        if ($jsonData === false) {
            log_warning('API request failed, trying local data file');
            if (file_exists($this->dataPath)) {
                $jsonData = file_get_contents($this->dataPath);
                $data = json_decode($jsonData, true);
                log_info('Using local data file', ['count' => count($data)]);
                return $data;
            }
            log_error('No local data file found');
            return [];
        }
        
        $apiData = json_decode($jsonData, true);
        log_info('Data fetched from API', ['count' => count($apiData)]);
        
        // Transform API data to match our structure
        $transformedData = [];
        foreach ($apiData as $index => $user) {
            // Assign random category to each user
            $randomCategory = $this->categories[array_rand($this->categories)];
            
            $transformedData[] = [
                'id' => $user['id'],
                'name' => $user['name'],
                'email' => $user['email'],
                'category' => $randomCategory
            ];
        }
        
        // Save transformed data to local file as a backup
        $success = file_put_contents($this->dataPath, json_encode($transformedData, JSON_PRETTY_PRINT));
        if ($success) {
            log_debug('Transformed data saved to local file');
        } else {
            log_warning('Failed to save transformed data to local file');
        }
        
        return $transformedData;
    }
} 