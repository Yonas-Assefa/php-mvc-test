<?php
class Data extends Controller {
    private $dataModel;
    
    public function __construct() {
        $this->dataModel = $this->model('DataModel');
    }
    
    public function index() {
        // Get category filter from GET parameter if exists
        $category = isset($_GET['category']) ? $_GET['category'] : null;
        
        // Get data
        $data = [
            'title' => 'Data Display',
            'category' => $category,
            'categories' => $this->dataModel->getCategories(),
            'records' => $this->dataModel->getData($category)
        ];
        
        $this->view('data/index', $data);
    }
} 