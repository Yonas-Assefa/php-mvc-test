<?php
class DataModel {
    private $dataPath;
    
    public function __construct() {
        $this->dataPath = DATA_PATH;
    }
    
    // Get all data or filtered by category
    public function getData($category = null) {
        // Check if file exists
        if (!file_exists($this->dataPath)) {
            return [];
        }
        
        // Get data from JSON file
        $jsonData = file_get_contents($this->dataPath);
        $data = json_decode($jsonData, true);
        
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
        if (!file_exists($this->dataPath)) {
            return [];
        }
        
        $jsonData = file_get_contents($this->dataPath);
        $data = json_decode($jsonData, true);
        
        $categories = array_map(function($item) {
            return $item['category'];
        }, $data);
        
        return array_unique($categories);
    }
} 