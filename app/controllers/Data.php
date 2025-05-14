<?php
class Data extends Controller {
    private $dataModel;
    
    public function __construct() {
        log_info('Data controller initialized');
        $this->dataModel = $this->model('DataModel');
    }
    
    public function index() {
        // Get category filter from GET parameter if exists
        $category = isset($_GET['category']) ? $_GET['category'] : null;
        
        log_info('Data controller index method called', [
            'category' => $category,
            'ip' => $_SERVER['REMOTE_ADDR'] ?? 'unknown'
        ]);
        
        // Get data
        $data = [
            'title' => 'Data Display',
            'category' => $category,
            'categories' => $this->dataModel->getCategories(),
            'records' => $this->dataModel->getData($category)
        ];
        
        log_debug('Rendering data/index view', [
            'category' => $category,
            'recordCount' => count($data['records'])
        ]);
        
        $this->view('data/index', $data);
    }
} 