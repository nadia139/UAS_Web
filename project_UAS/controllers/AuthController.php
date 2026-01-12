<?php
// File: controllers/AuthController.php

class AuthController {
    private $db;
    private $userModel;
    
    public function __construct() {
        $database = new Database();
        $this->db = $database->getConnection();
        $this->userModel = new User($this->db);
    }
    
    public function login() {
        // Redirect if already logged in
        if (isset($_SESSION['user_id'])) {
            $this->redirectBasedOnRole();
            return;
        }
        
        $error = '';
        
        // Process login form
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $username = $_POST['username'] ?? '';
            $password = $_POST['password'] ?? '';
            
            if (empty($username) || empty($password)) {
                $error = 'Username dan password harus diisi!';
            } else {
                $user = $this->userModel->login($username, $password);
                
                if ($user) {
                    // Set session
                    $_SESSION['user_id'] = $user['id'];
                    $_SESSION['username'] = $user['username'];
                    $_SESSION['fullname'] = $user['fullname'] ?? $user['username'];
                    $_SESSION['role'] = $user['role'];
                    
                    // Redirect based on role
                    $this->redirectBasedOnRole();
                    return;
                } else {
                    $error = 'Username atau password salah!';
                }
            }
        }
        
        // Show login page
        $title = 'Login - Beauty Store';
        require_once 'views/auth/login.php';
    }
    
    public function register() {
        // Redirect if already logged in
        if (isset($_SESSION['user_id'])) {
            $this->redirectBasedOnRole();
            return;
        }
        
        $error = '';
        
        // Process registration form
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $username = $_POST['username'] ?? '';
            $password = $_POST['password'] ?? '';
            $confirm_password = $_POST['confirm_password'] ?? '';
            $fullname = $_POST['fullname'] ?? '';
            
            // Validation
            if (empty($username) || empty($password) || empty($fullname)) {
                $error = 'Semua field harus diisi!';
            } elseif ($password !== $confirm_password) {
                $error = 'Password tidak sama!';
            } elseif (strlen($password) < 6) {
                $error = 'Password minimal 6 karakter!';
            } elseif ($this->userModel->usernameExists($username)) {
                $error = 'Username sudah terdaftar!';
            } else {
                // Create user
                $data = [
                    'username' => $username,
                    'password' => $password,
                    'fullname' => $fullname,
                    'role' => 'user'
                ];
                
                if ($this->userModel->create($data)) {
                    $_SESSION['success'] = 'Registrasi berhasil! Silakan login.';
                    header('Location: ' . BASE_URL . 'auth/login');
                    exit();
                } else {
                    $error = 'Registrasi gagal. Silakan coba lagi.';
                }
            }
        }
        
        // Show registration page
        $title = 'Register - Beauty Store';
        require_once 'views/auth/register.php';
    }
    
    public function logout() {
        // Clear session
        session_destroy();
        
        // Redirect to login
        header('Location: ' . BASE_URL . 'auth/login');
        exit();
    }
    
    private function redirectBasedOnRole() {
        // Require both user_id and role to be present to avoid partial-session redirects
        if (empty($_SESSION['user_id']) || empty($_SESSION['role'])) {
            header('Location: ' . BASE_URL . 'auth/login');
            exit();
        }

        if ($_SESSION['role'] === 'admin') {
            header('Location: ' . BASE_URL . 'admin/dashboard');
        } else {
            header('Location: ' . BASE_URL . 'user/dashboard');
        }
        exit();
    }
}
?>