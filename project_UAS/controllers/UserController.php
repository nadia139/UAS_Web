<?php
// File: controllers/UserController.php

class UserController {
    private $db;
    private $productModel;
    
    public function __construct() {
        // Check authentication
        if (!isset($_SESSION['user_id'])) {
            header('Location: ' . BASE_URL . 'auth/login');
            exit();
        }
        
        $database = new Database();
        $this->db = $database->getConnection();
        $this->productModel = new Product($this->db);
    }
    
    public function dashboard() {
        // Pagination
        $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        $limit = 9;
        $search = isset($_GET['search']) ? $_GET['search'] : '';
        $category = isset($_GET['category']) ? $_GET['category'] : '';
        
        // Get products
        $products = $this->productModel->getAll($page, $limit, $search, $category);
        $total_products = $this->productModel->countAll($search, $category);
        $total_pages = ceil($total_products / $limit);
        
        // Get categories
        $categories = $this->productModel->getCategories();
        
        $title = 'Dashboard User - Beauty Store';
        require_once 'views/user/dashboard.php';
    }
}
?>