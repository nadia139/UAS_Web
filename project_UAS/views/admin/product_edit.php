<?php
$title = 'Edit Produk - Beauty Store';
$active_menu = 'products';
require_once 'views/layouts/header.php';
?>

<div class="row">
    <?php require_once 'views/admin/sidebar.php'; ?>
    
    <div class="col-md-9">
        <div class="card">
            <div class="card-header">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h4 class="mb-0"><i class="fas fa-edit"></i> Edit Produk</h4>
                        <p class="text-muted mb-0">Ubah informasi produk: <?php echo htmlspecialchars($product['name']); ?></p>
                    </div>
                    <a href="<?php echo BASE_URL; ?>admin/products" class="btn btn-secondary btn-sm">
                        <i class="fas fa-arrow-left"></i> Kembali
                    </a>
                </div>
            </div>
            <div class="card-body">
                <form method="POST" action="<?php echo BASE_URL; ?>admin/product_edit/<?php echo $product['id']; ?>" 
                        enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-md-8">
                            <!-- Basic Information -->
                            <div class="card mb-4">
                                <div class="card-header bg-light">
                                    <h5 class="mb-0">Informasi Dasar Produk</h5>
                                </div>
                                <div class="card-body">
                                    <div class="mb-3">
                                        <label for="name" class="form-label">Nama Produk <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" id="name" name="name" 
                                                value="<?php echo htmlspecialchars($product['name']); ?>" required>
                                    </div>
                                    
                                    <div class="mb-3">
                                        <label for="category" class="form-label">Kategori <span class="text-danger">*</span></label>
                                        <select class="form-select" id="category" name="category" required>
                                            <option value="Skincare" <?php echo $product['category'] == 'Skincare' ? 'selected' : ''; ?>>Skincare</option>
                                            <option value="Makeup" <?php echo $product['category'] == 'Makeup' ? 'selected' : ''; ?>>Makeup</option>
                                            <option value="Body Care" <?php echo $product['category'] == 'Body Care' ? 'selected' : ''; ?>>Body Care</option>
                                            <option value="Hair Care" <?php echo $product['category'] == 'Hair Care' ? 'selected' : ''; ?>>Hair Care</option>
                                        </select>
                                    </div>
                                    
                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <label for="price" class="form-label">Harga (Rp) <span class="text-danger">*</span></label>
                                            <div class="input-group">
                                                <span class="input-group-text">Rp</span>
                                                <input type="number" class="form-control" id="price" name="price" 
                                                        value="<?php echo $product['price']; ?>" min="1000" step="1000" required>
                                            </div>
                                            <div class="form-text">
                                                <span id="priceFormatted" class="text-primary fw-bold">
                                                    Rp <?php echo number_format($product['price'], 0, ',', '.'); ?>
                                                </span>
                                            </div>
                                        </div>
                                        
                                        <div class="col-md-6 mb-3">
                                            <label for="stock" class="form-label">Stok <span class="text-danger">*</span></label>
                                            <div class="input-group">
                                                <input type="number" class="form-control" id="stock" name="stock" 
                                                        value="<?php echo $product['stock']; ?>" min="0" required>
                                                <span class="input-group-text">pcs</span>
                                            </div>
                                            <div class="form-text">
                                                Status: 
                                                <span class="badge <?php 
                                                    echo $product['stock'] > 20 ? 'bg-success' : 
                                                            ($product['stock'] > 5 ? 'bg-warning' : 'bg-danger');
                                                ?>">
                                                    <?php echo $product['stock'] > 20 ? 'Aman' : 
                                                            ($product['stock'] > 5 ? 'Hampir Habis' : 'Stok Habis'); ?>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Description -->
                            <div class="card mb-4">
                                <div class="card-header bg-light">
                                    <h5 class="mb-0">Deskripsi Produk</h5>
                                </div>
                                <div class="card-body">
                                    <div class="mb-3">
                                        <label for="description" class="form-label">Deskripsi Lengkap</label>
                                        <textarea class="form-control" id="description" name="description" 
                                                    rows="6"><?php echo htmlspecialchars($product['description']); ?></textarea>
                                        <div class="form-text">
                                            <span id="charCount" class="text-muted">
                                                <?php echo strlen($product['description']); ?>/500 karakter
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-md-4">
                            <!-- Image Section -->
                            <div class="card mb-4">
                                <div class="card-header bg-light">
                                    <h5 class="mb-0">Gambar Produk</h5>
                                </div>
                                <div class="card-body">
                                    <!-- Current Image -->
                                    <div class="text-center mb-4">
                                        <h6>Gambar Saat Ini</h6>
                                        <?php if($product['image_url']): ?>
                                            <img src="<?php echo BASE_URL; ?>images/<?php echo $product['image_url']; ?>" 
                                                    alt="<?php echo htmlspecialchars($product['name']); ?>"
                                                    class="img-fluid rounded border" style="max-height: 200px;">
                                            <p class="small text-muted mt-2"><?php echo $product['image_url']; ?></p>
                                        <?php else: ?>
                                            <div class="border rounded p-5 text-center" style="background-color: #f8f9fa;">
                                                <i class="fas fa-image fa-3x text-muted mb-3"></i>
                                                <p class="text-muted">Tidak ada gambar</p>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                    
                                    <!-- New Image Upload -->
                                    <div class="mb-3">
                                        <label for="image" class="form-label">Ganti Gambar</label>
                                        <input type="file" class="form-control" id="image" name="image" 
                                                accept="images/*">
                                        <div class="form-text">Kosongkan jika tidak ingin mengganti</div>
                                    </div>
                                    
                                    <!-- Image URL -->
                                    <div class="mb-3">
                                        <label for="image_url" class="form-label">Atau URL Gambar Baru</label>
                                        <input type="url" class="form-control" id="image_url" name="image_url" 
                                                value="<?php echo htmlspecialchars($product['image_url']); ?>"
                                                placeholder="https://example.com/image.jpg">
                                    </div>
                                    
                                    <!-- Image Preview -->
                                    <div class="text-center mt-3">
                                        <h6>Preview Gambar Baru</h6>
                                        <div class="border rounded p-3" style="background-color: #f8f9fa;">
                                            <img id="imagePreview" src="<?php 
                                                echo $product['image_url'] ? BASE_URL . 'images/' . $product['image_url'] : BASE_URL . 'images/no-image.png'; 
                                            ?>" 
                                                    alt="Preview" class="img-fluid rounded" style="max-height: 150px;">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Product Info -->
                            <div class="card mb-4">
                                <div class="card-body">
                                    <h6><i class="fas fa-info-circle"></i> Informasi Produk</h6>
                                    <ul class="list-group list-group-flush small">
                                        <li class="list-group-item d-flex justify-content-between px-0">
                                            <span>ID Produk:</span>
                                            <strong>#<?php echo $product['id']; ?></strong>
                                        </li>
                                        <li class="list-group-item d-flex justify-content-between px-0">
                                            <span>Dibuat:</span>
                                            <span><?php echo date('d/m/Y', strtotime($product['created_at'])); ?></span>
                                        </li>
                                        <li class="list-group-item d-flex justify-content-between px-0">
                                            <span>Diperbarui:</span>
                                            <span><?php echo date('d/m/Y', strtotime($product['updated_at'])); ?></span>
                                        </li>
                                        <li class="list-group-item d-flex justify-content-between px-0">
                                            <span>Dibuat Oleh:</span>
                                            <span><?php echo $product['creator_name'] ?? 'Admin'; ?></span>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            
                            <!-- Action Buttons -->
                            <div class="card">
                                <div class="card-body">
                                    <div class="d-grid gap-2">
                                        <button type="submit" class="btn btn-primary btn-lg">
                                            <i class="fas fa-save"></i> Update Produk
                                        </button>
                                        <a href="<?php echo BASE_URL; ?>admin/product_delete/<?php echo $product['id']; ?>" 
                                            class="btn btn-danger btn-delete"
                                            data-name="<?php echo htmlspecialchars($product['name']); ?>">
                                            <i class="fas fa-trash"></i> Hapus Produk
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?php 
$custom_js = '
<script>
document.addEventListener("DOMContentLoaded", function() {
    // Price formatting
    const priceInput = document.getElementById("price");
    const priceFormatted = document.getElementById("priceFormatted");

    if (priceInput) {
        priceInput.addEventListener("input", function() {
            const value = parseInt(this.value || 0);
            priceFormatted.textContent = "Rp " + value.toLocaleString("id-ID");
        });
    }

    // Image preview
    const imageInput = document.getElementById("image");
    const imagePreview = document.getElementById("imagePreview");

    if (imageInput) {
        imageInput.addEventListener("change", function(e) {
            const file = e.target.files[0];
            if (!file) return;

            const reader = new FileReader();
            reader.onload = function(event) {
                imagePreview.src = event.target.result;
            };
            reader.readAsDataURL(file);
        });
    }
});
</script>
';
?>
