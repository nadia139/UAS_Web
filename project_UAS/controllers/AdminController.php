<?php
// File: controllers/AdminController.php

class AdminController {
    private $db;
    private $productModel;
    
    public function __construct() {
        // Check authentication and admin role
        if (!isset($_SESSION['user_id'])) {
            header('Location: ' . BASE_URL . 'auth/login');
            exit();
        }
        
        if ($_SESSION['role'] != 'admin') {
            header('Location: ' . BASE_URL . 'user/dashboard');
            exit();
        }
        
        $database = new Database();
        $this->db = $database->getConnection();
        $this->productModel = new Product($this->db);
    }
    
    public function dashboard() {
        // Get statistics
        $stats = $this->getStats();
        
        // Get recent products
        $query = "SELECT p.*, u.username as creator_name 
                  FROM products p 
                  LEFT JOIN users u ON p.created_by = u.id 
                  ORDER BY p.created_at DESC 
                  LIMIT 5";
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        $recent_products = $stmt->fetchAll();
        
        $title = 'Admin Dashboard - Beauty Store';
        require_once 'views/admin/dashboard.php';
    }
    
    public function products() {
        // Pagination
        $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        $limit = 10;
        $search = isset($_GET['search']) ? $_GET['search'] : '';
        $category = isset($_GET['category']) ? $_GET['category'] : '';
        
        // Get products
        $products = $this->productModel->getAll($page, $limit, $search, $category);
        $total_products = $this->productModel->countAll($search, $category);
        $total_pages = ceil($total_products / $limit);
        
        // Get categories
        $categories = $this->productModel->getCategories();
        
        $title = 'Kelola Produk - Beauty Store';
        require_once 'views/admin/product_list.php';
    }
    
    public function product_create() {
        $error = '';
        
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $data = [
                'name' => $_POST['name'] ?? '',
                'description' => $_POST['description'] ?? '',
                'category' => $_POST['category'] ?? '',
                'price' => $_POST['price'] ?? 0,
                'stock' => $_POST['stock'] ?? 0,
                'image_url' => $_POST['image_url'] ?? '',
                'created_by' => $_SESSION['user_id']
            ];
            
            // Validate
            if (empty($data['name']) || empty($data['category']) || $data['price'] <= 0) {
                $error = 'Nama, kategori, dan harga harus diisi!';
            } else {
                // Handle file upload
                if (!empty($_FILES['image']['name'])) {
                    $upload_result = $this->uploadImage($_FILES['image']);
                    if ($upload_result) {
                        $data['image_url'] = $upload_result;
                    }
                }
                
                if ($this->productModel->create($data)) {
                    $_SESSION['success'] = 'Produk berhasil ditambahkan!';
                    header('Location: ' . BASE_URL . 'admin/products');
                    exit();
                } else {
                    $error = 'Gagal menambahkan produk!';
                }
            }
        }
        
        $title = 'Tambah Produk - Beauty Store';
        require_once 'views/admin/product_add.php';
    }
    
    public function product_edit($id = null) {
        if (!$id) {
            header('Location: ' . BASE_URL . 'admin/products');
            exit();
        }
        
        $product = $this->productModel->getById($id);
        
        if (!$product) {
            header('Location: ' . BASE_URL . 'admin/products');
            exit();
        }
        
        $error = '';
        
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $data = [
                'name' => $_POST['name'] ?? '',
                'description' => $_POST['description'] ?? '',
                'category' => $_POST['category'] ?? '',
                'price' => $_POST['price'] ?? 0,
                'stock' => $_POST['stock'] ?? 0,
                'image_url' => $_POST['image_url'] ?? $product['image_url']
            ];
            
            // Validate
            if (empty($data['name']) || empty($data['category']) || $data['price'] <= 0) {
                $error = 'Nama, kategori, dan harga harus diisi!';
            } else {
                // Handle file upload
                if (!empty($_FILES['image']['name'])) {
                    $upload_result = $this->uploadImage($_FILES['image']);
                    if ($upload_result) {
                        $data['image_url'] = $upload_result;
                    }
                }
                
                if ($this->productModel->update($id, $data)) {
                    $_SESSION['success'] = 'Produk berhasil diperbarui!';
                    header('Location: ' . BASE_URL . 'admin/products');
                    exit();
                } else {
                    $error = 'Gagal memperbarui produk!';
                }
            }
        }
        
        $title = 'Edit Produk - Beauty Store';
        require_once 'views/admin/product_edit.php';
    }
    
    public function product_delete($id = null) {
        if (!$id) {
            header('Location: ' . BASE_URL . 'admin/products');
            exit();
        }
        
        if ($this->productModel->delete($id)) {
            $_SESSION['success'] = 'Produk berhasil dihapus!';
        } else {
            $_SESSION['error'] = 'Gagal menghapus produk!';
        }
        
        header('Location: ' . BASE_URL . 'admin/products');
        exit();
    }
    
    private function getStats() {
        $stats = [];
        
        // Total products
        $query = "SELECT COUNT(*) as total_products FROM products";
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        $stats['total_products'] = $stmt->fetch()['total_products'];
        
        // Total stock
        $query = "SELECT SUM(stock) as total_stock FROM products";
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        $stats['total_stock'] = $stmt->fetch()['total_stock'] ?? 0;
        
        // Total value
        $query = "SELECT SUM(price * stock) as total_value FROM products";
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        $stats['total_value'] = $stmt->fetch()['total_value'] ?? 0;
        
        // Products by category
        $query = "SELECT category, COUNT(*) as count FROM products GROUP BY category";
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        $stats['by_category'] = $stmt->fetchAll();
        
        return $stats;
    }
    
    private function uploadImage($file) {
        $target_dir = "uploads/";
        if (!file_exists($target_dir)) {
            mkdir($target_dir, 0777, true);
        }
        
        $filename = time() . '_' . basename($file["name"]);
        $target_file = $target_dir . $filename;
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
        
        // Check if image file is actual image
        $check = getimagesize($file["tmp_name"]);
        if ($check === false) {
            return false;
        }
        
        // Check file size (max 2MB)
        if ($file["size"] > 2000000) {
            return false;
        }
        
        // Allow certain file formats
        if (!in_array($imageFileType, ['jpg', 'jpeg', 'png', 'gif'])) {
            return false;
        }
        
        if (move_uploaded_file($file["tmp_name"], $target_file)) {
            return $filename;
        }
        
        return false;
    }
}
?>