<?php
$title = 'Login - Beauty Store';

// PERBAIKAN PATH HEADER: dari 'views/auth/layouts/' ke 'views/layouts/'
require_once 'views/layouts/header.php';
?>

<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-5">
            <div class="card login-card">
                <div class="card-header login-header">
                    <h3><i class="fas fa-sign-in-alt"></i> Login</h3>
                    <p class="mb-0">Masuk ke akun Anda</p>
                </div>
                <div class="card-body login-body">
                    <!-- PERBAIKI ACTION FORM JIKA PERLU -->
                    <form method="POST" action="<?php echo BASE_URL; ?>auth/login">
                        <div class="mb-3">
                            <label for="username" class="form-label">Username</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="fas fa-user"></i></span>
                                <input type="text" class="form-control" id="username" name="username" 
                                       placeholder="Masukkan username" required autofocus>
                            </div>
                        </div>
                        
                        <div class="mb-4">
                            <label for="password" class="form-label">Password</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="fas fa-lock"></i></span>
                                <input type="password" class="form-control" id="password" name="password" 
                                       placeholder="Masukkan password" required>
                            </div>
                        </div>
                        
                        <div class="d-grid mb-3">
                            <button type="submit" class="btn btn-primary btn-lg">
                                <i class="fas fa-sign-in-alt"></i> Login
                            </button>
                        </div>
                        
                        <div class="text-center">
                            <p class="mb-2">Belum punya akun? 
                                <a href="<?php echo BASE_URL; ?>auth/register" class="text-decoration-none">
                                    Daftar di sini
                                </a>
                            </p>
                            <hr class="my-4">
                            <p class="text-muted small mb-0">
                                <strong>Akun Demo:</strong><br>
                                <strong>Admin:</strong> admin / admin123<br>
                                <strong>User:</strong> user1 / user123
                            </p>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php 
// PERBAIKAN PATH FOOTER: dari 'views/auth/layouts/' ke 'views/layouts/'
require_once 'views/layouts/footer.php'; 
?>