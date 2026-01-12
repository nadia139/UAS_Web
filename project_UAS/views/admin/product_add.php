<?php
$title = 'Tambah Produk Baru - Beauty Store';
$active_menu = 'add_product';
require_once 'views/layouts/header.php';
?>

<div class="row">
    <?php require_once 'views/admin/sidebar.php'; ?>
    
    <div class="col-md-9">
        <div class="card">
            <div class="card-header">
                <h4 class="mb-0"><i class="fas fa-plus-circle"></i> Tambah Produk Baru</h4>
                <p class="text-muted mb-0">Tambahkan produk kosmetik/skincare baru ke sistem</p>
            </div>
            <div class="card-body">
                <form method="POST" action="<?php echo BASE_URL; ?>admin/product_create" enctype="multipart/form-data">
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
                                               placeholder="Contoh: Serum Vitamin C 20%" required>
                                        <div class="form-text">Nama produk yang jelas dan deskriptif</div>
                                    </div>
                                    
                                    <div class="mb-3">
                                        <label for="category" class="form-label">Kategori <span class="text-danger">*</span></label>
                                        <select class="form-select" id="category" name="category" required>
                                            <option value="">Pilih Kategori</option>
                                            <option value="Skincare">Skincare</option>
                                            <option value="Makeup">Makeup</option>
                                            <option value="Body Care">Body Care</option>
                                            <option value="Hair Care">Hair Care</option>
                                        </select>
                                    </div>
                                    
                                    <div class="mb-3">
                                        <label for="price" class="form-label">Harga (Rp) <span class="text-danger">*</span></label>
                                        <div class="input-group">
                                            <span class="input-group-text">Rp</span>
                                            <input type="number" class="form-control" id="price" name="price" 
                                                   placeholder="100000" min="1000" step="1000" required>
                                        </div>
                                        <div class="form-text">
                                            Harga satuan dalam Rupiah. 
                                            <span id="priceFormatted" class="text-primary fw-bold"></span>
                                        </div>
                                    </div>
                                    
                                    <div class="mb-3">
                                        <label for="stock" class="form-label">Stok Awal <span class="text-danger">*</span></label>
                                        <div class="input-group">
                                            <input type="number" class="form-control" id="stock" name="stock" 
                                                   placeholder="50" min="0" required>
                                            <span class="input-group-text">pcs</span>
                                        </div>
                                        <div class="form-text">Jumlah stok yang tersedia untuk dijual</div>
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
                                                  rows="5" placeholder="Deskripsi detail tentang produk..."></textarea>
                                        <div class="form-text">
                                            Jelaskan manfaat, bahan, cara penggunaan, dll. 
                                            <span id="charCount" class="text-muted">0/500 karakter</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-md-4">
                            <!-- Image Upload -->
                            <div class="card mb-4">
                                <div class="card-header bg-light">
                                    <h5 class="mb-0">Gambar Produk</h5>
                                </div>
                                <div class="card-body">
                                    <div class="mb-3">
                                        <label for="image" class="form-label">Upload Gambar</label>
                                        <input type="file" class="form-control" id="image" name="image" 
                                               accept="image/*">
                                        <div class="form-text">
                                            Format: JPG, PNG, GIF. Max: 2MB
                                        </div>
                                    </div>
                                    
                                    <!-- Image Preview -->
                                    <div class="text-center mt-3">
                                        <div class="border rounded p-3 mb-3" style="background-color: #f8f9fa;">
                                            <img id="imagePreview" src="<?php echo BASE_URL; ?>assets/images/no-image.png" 
                                                 alt="Preview" class="img-fluid rounded" style="max-height: 200px;">
                                        </div>
                                        <small class="text-muted">Preview gambar akan muncul di sini</small>
                                    </div>
                                    
                                    <!-- Alternative Image URL -->
                                    <div class="mb-3 mt-4">
                                        <label for="image_url" class="form-label">Atau URL Gambar</label>
                                        <input type="url" class="form-control" id="image_url" name="image_url" 
                                               placeholder="https://example.com/image.jpg">
                                        <div class="form-text">Jika tidak upload, gunakan URL gambar eksternal</div>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Action Buttons -->
                            <div class="card">
                                <div class="card-body">
                                    <div class="d-grid gap-2">
                                        <button type="submit" class="btn btn-primary btn-lg">
                                            <i class="fas fa-save"></i> Simpan Produk
                                        </button>
                                        <a href="<?php echo BASE_URL; ?>admin/products" class="btn btn-secondary">
                                            <i class="fas fa-times"></i> Batal
                                        </a>
                                    </div>
                                    
                                    <hr class="my-3">
                                    
                                    <div class="alert alert-info small">
                                        <i class="fas fa-info-circle"></i> <strong>Tips:</strong><br>
                                        1. Isi semua field wajib (*)<br>
                                        2. Gunakan gambar berkualitas tinggi<br>
                                        3. Harga harus realistis<br>
                                        4. Deskripsi harus informatif
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
$custom_js = "
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Price formatting
    const priceInput = document.getElementById('price');
    const priceFormatted = document.getElementById('priceFormatted');
    
    priceInput.addEventListener('input', function() {
        const value = parseFloat(this.value);
        if (!isNaN(value)) {
            priceFormatted.textContent = 'Rp ' + new Intl.NumberFormat('id-ID').format(value);
        }
    });
    
    // Character count for description
    const descriptionInput = document.getElementById('description');
    const charCount = document.getElementById('charCount');
    
    descriptionInput.addEventListener('input', function() {
        const count = this.value.length;
        charCount.textContent = count + '/500 karakter';
        if (count > 500) {
            charCount.className = 'text-danger';
        } else if (count > 400) {
            charCount.className = 'text-warning';
        } else {
            charCount.className = 'text-muted';
        }
    });
    
    // Image preview
    const imageInput = document.getElementById('image');
    const imagePreview = document.getElementById('imagePreview');
    
    imageInput.addEventListener('change', function() {
        const file = this.files[0];
        if (file) {
            if (file.size > 2 * 1024 * 1024) {
                alert('Ukuran file terlalu besar! Maksimal 2MB.');
                this.value = '';
                return;
            }
            
            const reader = new FileReader();
            reader.onload = function(e) {
                imagePreview.src = e.target.result;
            }
            reader.readAsDataURL(file);
            
            // Clear URL field if file is uploaded
            document.getElementById('image_url').value = '';
        }
    });
    
    // Clear image preview if URL is entered
    document.getElementById('image_url').addEventListener('input', function() {
        if (this.value) {
            imagePreview.src = this.value;
            imageInput.value = '';
        }
    });
});
</script>
";

require_once 'views/layouts/footer.php'; 
?>