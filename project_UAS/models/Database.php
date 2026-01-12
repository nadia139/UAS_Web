<?php
class Database {
    private $conn;
    
    public function connect() {
        // Load config
        require_once __DIR__ . '/../config/database.php';
        
        try {
            $this->conn = new PDO(
                'mysql:host=' . DB_HOST . ';dbname=' . DB_NAME,
                DB_USER,
                DB_PASS
            );
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $this->conn;
            
        } catch(PDOException $e) {
            die("Connection error: " . $e->getMessage());
        }
    }
    
    // Alias untuk getConnection
    public function getConnection() {
        return $this->connect();
    }
}
?>