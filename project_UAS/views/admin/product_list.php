<?php
$title = 'Kelola Produk - Beauty Store';
$active_menu = 'products';
require_once 'views/layouts/header.php';
?>

<div class="row">
    <?php require_once 'views/admin/sidebar.php'; ?>
    
    <div class="col-md-9">
        <!-- Header -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h4><i class="fas fa-boxes"></i> Daftar Produk</h4>
                <p class="text-muted mb-0">Kelola produk kosmetik dan skincare</p>
            </div>
            <a href="<?php echo BASE_URL; ?>admin/product_create" class="btn btn-primary">
                <i class="fas fa-plus-circle"></i> Tambah Produk Baru
            </a>
        </div>
        
        <!-- Search & Filter -->
        <div class="card mb-4">
            <div class="card-body">
                <form method="GET" action="<?php echo BASE_URL; ?>admin/products" class="row g-3">
                    <div class="col-md-5">
                        <div class="input-group">
                            <span class="input-group-text"><i class="fas fa-search"></i></span>
                            <input type="text" name="search" class="form-control" 
                                   placeholder="Cari produk..." value="<?php echo htmlspecialchars($search ?? ''); ?>"
                                   id="searchInput">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <select name="category" class="form-select">
                            <option value="">Semua Kategori</option>
                            <option value="Skincare" <?php echo ($category ?? '') == 'Skincare' ? 'selected' : ''; ?>>Skincare</option>
                            <option value="Makeup" <?php echo ($category ?? '') == 'Makeup' ? 'selected' : ''; ?>>Makeup</option>
                            <option value="Body Care" <?php echo ($category ?? '') == 'Body Care' ? 'selected' : ''; ?>>Body Care</option>
                            <option value="Hair Care" <?php echo ($category ?? '') == 'Hair Care' ? 'selected' : ''; ?>>Hair Care</option>
                        </select>
                    </div>
                    <div class="col-md-2">
                        <button type="submit" class="btn btn-primary w-100">
                            <i class="fas fa-filter"></i> Filter
                        </button>
                    </div>
                    <div class="col-md-2">
                        <a href="<?php echo BASE_URL; ?>admin/products" class="btn btn-secondary w-100">
                            <i class="fas fa-redo"></i> Reset
                        </a>
                    </div>
                </form>
                
                <!-- Category Filter Chips -->
                <div class="mt-3">
                    <small class="text-muted me-2">Filter cepat:</small>
                    <a href="<?php echo BASE_URL; ?>admin/products" class="badge bg-secondary text-decoration-none me-2">Semua</a>
                    <a href="<?php echo BASE_URL; ?>admin/products?category=Skincare" class="badge bg-info text-decoration-none me-2">Skincare</a>
                    <a href="<?php echo BASE_URL; ?>admin/products?category=Makeup" class="badge bg-warning text-decoration-none me-2">Makeup</a>
                </div>
            </div>
        </div>
        
        <!-- Products Table -->
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0">Daftar Produk dengan Gambar</h5>
                <div class="text-muted small">
                    Total: 15 produk
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th width="50">#</th>
                                <th>Produk</th>
                                <th>Kategori</th>
                                <th>Harga</th>
                                <th>Stok</th>
                                <th>Gambar</th>
                                <th width="120">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                            // Data produk dengan gambar dari folder images
                            $products = [
                                [
                                    'id' => 1, 
                                    'name' => 'Sunscreen SPF 50', 
                                    'category' => 'Skincare',
                                    'price' => 85000, 
                                    'stock' => 45,
                                    'image' => 'sunscream.png',
                                    'description' => 'Sun protection dengan tekstur ringan, tidak lengket'
                                ],
                                [
                                    'id' => 2, 
                                    'name' => 'Serum Vitamin C', 
                                    'category' => 'Skincare',
                                    'price' => 125000, 
                                    'stock' => 30,
                                    'image' => 'serum_vitc.png',
                                    'description' => 'Mencerahkan kulit, mengurangi flek hitam'
                                ],
                                [
                                    'id' => 3, 
                                    'name' => 'Toner', 
                                    'category' => 'Skincare',
                                    'price' => 75000, 
                                    'stock' => 60,
                                    'image' => 'toner.png',
                                    'description' => 'Menyegarkan dan menyeimbangkan pH kulit'
                                ],
                                [
                                    'id' => 4, 
                                    'name' => 'Moisturizer', 
                                    'category' => 'Skincare',
                                    'price' => 90000, 
                                    'stock' => 25,
                                    'image' => 'moisturizer.png',
                                    'description' => 'Melembabkan kulit sepanjang hari'
                                ],
                                [
                                    'id' => 5, 
                                    'name' => 'Facial Wash', 
                                    'category' => 'Skincare',
                                    'price' => 65000, 
                                    'stock' => 40,
                                    'image' => 'facewash.png',
                                    'description' => 'Membersihkan wajah tanpa membuat kering'
                                ],
                                [
                                    'id' => 6, 
                                    'name' => 'Sheet Mask', 
                                    'category' => 'Skincare',
                                    'price' => 25000, 
                                    'stock' => 100,
                                    'image' => 'facemask.png',
                                    'description' => 'Masker wajah sekali pakai'
                                ],
                                [
                                    'id' => 7, 
                                    'name' => 'Lip Matte', 
                                    'category' => 'Makeup',
                                    'price' => 55000, 
                                    'stock' => 35,
                                    'image' => 'lipcream.png',
                                    'description' => 'Lipstik matte tahan lama'
                                ],
                                [
                                    'id' => 8, 
                                    'name' => 'Eyeliner', 
                                    'category' => 'Makeup',
                                    'price' => 45000, 
                                    'stock' => 50,
                                    'image' => 'eyeliner.png',
                                    'description' => 'Eyeliner waterproof'
                                ],
                                [
                                    'id' => 9, 
                                    'name' => 'Foundation', 
                                    'category' => 'Makeup',
                                    'price' => 120000, 
                                    'stock' => 20,
                                    'image' => 'fondation.png',
                                    'description' => 'Foundation full coverage'
                                ],
                                [
                                    'id' => 10, 
                                    'name' => 'Blush On', 
                                    'category' => 'Makeup',
                                    'price' => 65000, 
                                    'stock' => 45,
                                    'image' => 'blushon.png',
                                    'description' => 'Blush on natural'
                                ]
                            ];
                            
                            foreach($products as $index => $row):
                                $stock_class = $row['stock'] > 20 ? 'bg-success' : 
                                            ($row['stock'] > 5 ? 'bg-warning' : 'bg-danger');
                            ?>
                            <tr>
                                <td><?php echo $index + 1; ?></td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="me-3">
                                            <!-- GAMBAR LANGSUNG DARI FOLDER IMAGES -->
                                            <img src="<?php echo BASE_URL; ?>images/<?php echo $row['image']; ?>" 
                                                 alt="<?php echo htmlspecialchars($row['name']); ?>"
                                                 class="rounded" width="60" height="60"
                                                 style="object-fit: cover; border: 1px solid #ddd;">
                                        </div>
                                        <div>
                                            <strong><?php echo htmlspecialchars($row['name']); ?></strong><br>
                                            <small class="text-muted">
                                                <?php echo htmlspecialchars($row['description']); ?>
                                            </small>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <span class="badge <?php echo $row['category'] == 'Skincare' ? 'bg-info' : 
                                                       ($row['category'] == 'Makeup' ? 'bg-warning' : 
                                                       ($row['category'] == 'Body Care' ? 'bg-success' : 'bg-secondary')); ?>">
                                        <?php echo $row['category']; ?>
                                    </span>
                                </td>
                                <td>
                                    <strong class="text-primary">
                                        Rp <?php echo number_format($row['price'], 0, ',', '.'); ?>
                                    </strong>
                                </td>
                                <td>
                                    <span class="badge <?php echo $stock_class; ?>">
                                        <?php echo $row['stock']; ?> pcs
                                    </span>
                                </td>
                                <td>
                                    <img src="<?php echo BASE_URL; ?>images/<?php echo $row['image']; ?>" 
                                         alt="<?php echo htmlspecialchars($row['name']); ?>"
                                         class="rounded" width="50" height="50"
                                         style="object-fit: cover;">
                                </td>
                                <td>
                                    <div class="btn-group btn-group-sm" role="group">
                                        <a href="<?php echo BASE_URL; ?>admin/product_edit/<?php echo $row['id']; ?>" 
                                           class="btn btn-warning" title="Edit">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <a href="<?php echo BASE_URL; ?>admin/product_delete/<?php echo $row['id']; ?>" 
                                           class="btn btn-danger" 
                                           onclick="return confirm('Hapus produk <?php echo htmlspecialchars($row['name']); ?>?')"
                                           title="Hapus">
                                            <i class="fas fa-trash"></i>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
                
                <!-- Info Total -->
                <div class="text-center text-muted small mt-4">
                    <i class="fas fa-info-circle"></i> Menampilkan <?php echo count($products); ?> produk dari folder images
                </div>
            </div>
        </div>
    </div>
</div>

<?php 
$custom_js = "
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Quick filter by category
    document.querySelectorAll('.badge.category-filter').forEach(badge => {
        badge.addEventListener('click', function(e) {
            e.preventDefault();
            const category = this.getAttribute('data-category');
            window.location.href = '" . BASE_URL . "admin/products?category=' + category;
        });
    });
    
    // Image hover effect
    const images = document.querySelectorAll('table img');
    images.forEach(img => {
        img.addEventListener('mouseenter', function() {
            this.style.transform = 'scale(1.5)';
            this.style.transition = 'transform 0.3s';
            this.style.zIndex = '1000';
            this.style.boxShadow = '0 0 10px rgba(0,0,0,0.3)';
        });
        
        img.addEventListener('mouseleave', function() {
            this.style.transform = 'scale(1)';
            this.style.boxShadow = 'none';
        });
    });
});
</script>
";

require_once 'views/layouts/footer.php'; 
?>