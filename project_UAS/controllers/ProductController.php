<?php
require_once __DIR__ . '/../models/Database.php';
require_once __DIR__ . '/../models/Product.php';

class ProductController {
    private $db;
    private $product;
    
    public function __construct() {
        $database = new Database();
        $this->db = $database->connect();
        $this->product = new Product($this->db);
    }
    
    public function adminIndex() {
        $category = $_GET['category'] ?? '';
        $search = $_GET['search'] ?? '';
        $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        $limit = 10;
        
        $products = $this->product->getAll($page, $limit, $search, $category);
        $totalProducts = $this->product->countAll($search, $category);
        $totalPages = ceil($totalProducts / $limit);
        $categories = $this->product->getCategories();
        
        include 'views/admin/products.php';
    }
    
    public function create() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $this->product->name = $_POST['name'];
            $this->product->brand = $_POST['brand'] ?? '';
            $this->product->category = $_POST['category'];
            $this->product->price = $_POST['price'];
            $this->product->stock = $_POST['stock'];
            $this->product->description = $_POST['description'] ?? '';
            $this->product->image = $_POST['image'] ?? '';
            
            if ($this->product->create()) {
                $_SESSION['success'] = 'Produk berhasil ditambahkan';
                header('Location: index.php?route=admin/products');
                exit;
            } else {
                $error = 'Gagal menambahkan produk';
            }
        }
        
        $categories = $this->product->getCategories();
        include 'views/admin/product_form.php';
    }
    
    public function edit() {
        if (!isset($_GET['id'])) {
            header('Location: index.php?route=admin/products');
            exit;
        }
        
        $this->product->id = (int)$_GET['id'];
        $product_data = $this->product->getById();
        
        if (!$product_data) {
            header('Location: index.php?route=admin/products');
            exit;
        }
        
        // Set properties dari data yang didapat
        foreach ($product_data as $key => $value) {
            if (property_exists($this->product, $key)) {
                $this->product->{$key} = $value;
            }
        }
        
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $this->product->name = $_POST['name'];
            $this->product->brand = $_POST['brand'] ?? '';
            $this->product->category = $_POST['category'];
            $this->product->price = $_POST['price'];
            $this->product->stock = $_POST['stock'];
            $this->product->description = $_POST['description'] ?? '';
            $this->product->image = $_POST['image'] ?? '';
            
            if ($this->product->update()) {
                $_SESSION['success'] = 'Produk berhasil diupdate';
                header('Location: index.php?route=admin/products');
                exit;
            } else {
                $error = 'Gagal mengupdate produk';
            }
        }
        
        $categories = $this->product->getCategories();
        include 'views/admin/product_form.php';
    }
    
    public function delete() {
        if (isset($_GET['id'])) {
            $this->product->id = (int)$_GET['id'];
            
            if ($this->product->delete()) {
                $_SESSION['success'] = 'Produk berhasil dihapus';
            } else {
                $_SESSION['error'] = 'Gagal menghapus produk';
            }
        }
        
        header('Location: index.php?route=admin/products');
        exit;
    }
    
    public function userIndex() {
        $category = $_GET['category'] ?? '';
        $search = $_GET['search'] ?? '';
        $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        $limit = 12;
        
        $products = $this->product->getAll($page, $limit, $search, $category);
        $totalProducts = $this->product->countAll($search, $category);
        $totalPages = ceil($totalProducts / $limit);
        $categories = $this->product->getCategories();
        
        include 'views/user/products.php';
    }
}
?>