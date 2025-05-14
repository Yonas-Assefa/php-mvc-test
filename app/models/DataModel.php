<?php
class DataModel {
    private $dataPath;
    private $apiUrl = 'https://jsonplaceholder.typicode.com/users';
    private $categories = ['customer', 'admin', 'employee'];
    
    public function __construct() {
        $this->dataPath = DATA_PATH;
    }
    
    // Get all data or filtered by category
    public function getData($category = null) {
        $data = $this->fetchFromApi();
        
        // If no category filter is specified, return all data
        if (empty($category)) {
            return $data;
        }
        
        // Filter data by category
        $filteredData = array_filter($data, function($item) use ($category) {
            return $item['category'] === $category;
        });
        
        return array_values($filteredData); // Reindex array
    }
    
    // Get all unique categories
    public function getCategories() {
        return $this->categories;
    }
    
    // Fetch data from the API
    private function fetchFromApi() {
        $jsonData = @file_get_contents($this->apiUrl);
        
        // If API request fails, try to use local data
        if ($jsonData === false) {
            if (file_exists($this->dataPath)) {
                $jsonData = file_get_contents($this->dataPath);
                $data = json_decode($jsonData, true);
                return $data;
            }
            return [];
        }
        
        $apiData = json_decode($jsonData, true);
        
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
        file_put_contents($this->dataPath, json_encode($transformedData, JSON_PRETTY_PRINT));
        
        return $transformedData;
    }
} 