<!-- File: views/admin/sidebar.php -->
<div class="col-md-3 mb-4">
    <div class="sidebar">
        <h5><i class="fas fa-tachometer-alt"></i> Menu Admin</h5>
        
        <div class="list-group list-group-flush">
            <a href="<?php echo BASE_URL; ?>admin/dashboard" 
               class="sidebar-link <?php echo (isset($active_menu) && $active_menu == 'dashboard') ? 'active' : ''; ?>">
                <i class="fas fa-home"></i> Dashboard
            </a>
            
            <a href="<?php echo BASE_URL; ?>admin/products" 
               class="sidebar-link <?php echo (isset($active_menu) && $active_menu == 'products') ? 'active' : ''; ?>">
                <i class="fas fa-boxes"></i> Kelola Produk
            </a>
            
            <a href="<?php echo BASE_URL; ?>admin/product_create" 
               class="sidebar-link <?php echo (isset($active_menu) && $active_menu == 'add_product') ? 'active' : ''; ?>">
                <i class="fas fa-plus-circle"></i> Tambah Produk
            </a>
            
            <div class="dropdown-divider my-3"></div>
            
            <h6 class="sidebar-subtitle">Kategori</h6>
            <a href="<?php echo BASE_URL; ?>admin/products?category=Skincare" class="sidebar-link">
                <i class="fas fa-spa"></i> Skincare
            </a>
            <a href="<?php echo BASE_URL; ?>admin/products?category=Makeup" class="sidebar-link">
                <i class="fas fa-paint-brush"></i> Makeup
            </a>
            
            <div class="dropdown-divider my-3"></div>
            
            <h6 class="sidebar-subtitle">Laporan</h6>
            <a href="#" class="sidebar-link">
                <i class="fas fa-chart-bar"></i> Statistik
            </a>
            <a href="#" class="sidebar-link">
                <i class="fas fa-file-invoice"></i> Laporan Stok
            </a>
            
            <div class="dropdown-divider my-3"></div>
            
            <a href="<?php echo BASE_URL; ?>auth/logout" class="sidebar-link text-danger">
                <i class="fas fa-sign-out-alt"></i> Logout
            </a>
        </div>
        
        <div class="mt-4">
            <div class="card bg-light">
                <div class="card-body">
                    <h6><i class="fas fa-info-circle"></i> Info Admin</h6>
                    <p class="small mb-1">Nama: <?php echo $_SESSION['fullname']; ?></p>
                    <p class="small mb-1">Role: <span class="badge bg-primary">Administrator</span></p>
                    <p class="small mb-0">Username: <?php echo $_SESSION['username']; ?></p>
                </div>
            </div>
        </div>
    </div>
</div>