<?php
// File: models/Product.php

class Product {
    private $conn;
    private $table = 'products';
    
    public function __construct($db) {
        $this->conn = $db;
    }
    
    // Get all products with pagination and search
    public function getAll($page = 1, $limit = 10, $search = '', $category = '') {
        $offset = ($page - 1) * $limit;
        
        $query = "SELECT p.*, u.username as creator_name 
                  FROM " . $this->table . " p 
                  LEFT JOIN users u ON p.created_by = u.id 
                  WHERE 1=1";
        
        $params = [];
        
        if (!empty($search)) {
            $query .= " AND (p.name LIKE :search OR p.description LIKE :search)";
            $params[':search'] = '%' . $search . '%';
        }
        
        if (!empty($category)) {
            $query .= " AND p.category = :category";
            $params[':category'] = $category;
        }
        
        $query .= " ORDER BY p.created_at DESC LIMIT :limit OFFSET :offset";
        
        $stmt = $this->conn->prepare($query);
        
        // Bind parameters
        foreach ($params as $key => $val) {
            $stmt->bindValue($key, $val);
        }
        
        $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
        $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
        $stmt->execute();
        
        return $stmt;
    }
    
    // Count total products
    public function countAll($search = '', $category = '') {
        $query = "SELECT COUNT(*) as total FROM " . $this->table . " WHERE 1=1";
        $params = [];
        
        if (!empty($search)) {
            $query .= " AND (name LIKE :search OR description LIKE :search)";
            $params[':search'] = '%' . $search . '%';
        }
        
        if (!empty($category)) {
            $query .= " AND category = :category";
            $params[':category'] = $category;
        }
        
        $stmt = $this->conn->prepare($query);
        
        foreach ($params as $key => $val) {
            $stmt->bindValue($key, $val);
        }
        
        $stmt->execute();
        $result = $stmt->fetch();
        
        return $result['total'];
    }
    
    // Get single product
    public function getById($id) {
        $query = "SELECT p.*, u.username as creator_name 
                  FROM " . $this->table . " p 
                  LEFT JOIN users u ON p.created_by = u.id 
                  WHERE p.id = :id LIMIT 1";
        
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        
        return $stmt->fetch();
    }
    
    // Create product
    public function create($data) {
        $query = "INSERT INTO " . $this->table . " 
                  (name, description, category, price, stock, image_url, created_by) 
                  VALUES (:name, :description, :category, :price, :stock, :image_url, :created_by)";
        
        $stmt = $this->conn->prepare($query);
        
        $stmt->bindParam(':name', $data['name']);
        $stmt->bindParam(':description', $data['description']);
        $stmt->bindParam(':category', $data['category']);
        $stmt->bindParam(':price', $data['price']);
        $stmt->bindParam(':stock', $data['stock']);
        $stmt->bindParam(':image_url', $data['image_url']);
        $stmt->bindParam(':created_by', $data['created_by']);
        
        return $stmt->execute();
    }
    
    // Update product
    public function update($id, $data) {
        $query = "UPDATE " . $this->table . " 
                  SET name = :name, description = :description, 
                      category = :category, price = :price, 
                      stock = :stock, image_url = :image_url 
                  WHERE id = :id";
        
        $stmt = $this->conn->prepare($query);
        
        $stmt->bindParam(':name', $data['name']);
        $stmt->bindParam(':description', $data['description']);
        $stmt->bindParam(':category', $data['category']);
        $stmt->bindParam(':price', $data['price']);
        $stmt->bindParam(':stock', $data['stock']);
        $stmt->bindParam(':image_url', $data['image_url']);
        $stmt->bindParam(':id', $id);
        
        return $stmt->execute();
    }
    
    // Delete product
    public function delete($id) {
        $query = "DELETE FROM " . $this->table . " WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        
        return $stmt->execute();
    }
    
    // Get categories
    public function getCategories() {
        $query = "SELECT DISTINCT category FROM " . $this->table . " WHERE category IS NOT NULL";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        
        return $stmt->fetchAll(PDO::FETCH_COLUMN);
    }
}
?>