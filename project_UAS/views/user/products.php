<?php
$title = 'Produk Kami - Beauty Store';
$active_menu = 'products';
require_once '../layouts/header.php';
?>

<!-- Hero Section -->
<div class="jumbotron jumbotron-fluid bg-primary text-white py-5">
    <div class="container text-center">
        <h1 class="display-4">Koleksi Produk Beauty</h1>
        <p class="lead">Temukan produk skincare dan makeup terbaik dengan kualitas premium</p>
        <form class="d-flex justify-content-center mt-4">
            <div class="input-group w-50">
                <input type="text" class="form-control" placeholder="Cari produk...">
                <button class="btn btn-light" type="submit">
                    <i class="fas fa-search"></i>
                </button>
            </div>
        </form>
    </div>
</div>

<div class="container py-5">
    <!-- Category Filter -->
    <div class="row mb-4">
        <div class="col-md-12">
            <div class="d-flex justify-content-center flex-wrap">
                <button class="btn btn-outline-primary m-1 active" data-filter="all">Semua</button>
                <button class="btn btn-outline-info m-1" data-filter="skincare">Skincare</button>
                <button class="btn btn-outline-warning m-1" data-filter="makeup">Makeup</button>
            </div>
        </div>
    </div>

    <!-- Products Grid -->
    <div class="row" id="productsGrid">
        <?php
        // Data produk
        $products = [
            [
                'id' => 1,
                'name' => 'Sunscreen SPF 50',
                'category' => 'skincare',
                'price' => 85000,
                'stock' => 45,
                'image' => 'sunscreen.png',
                'description' => 'Sun protection dengan tekstur ringan, tidak lengket'
            ],
            [
                'id' => 2,
                'name' => 'Serum Vitamin C',
                'category' => 'skincare',
                'price' => 125000,
                'stock' => 30,
                'image' => 'serum.png',
                'description' => 'Mencerahkan kulit, mengurangi flek hitam'
            ],
            [
                'id' => 3,
                'name' => 'Toner',
                'category' => 'skincare',
                'price' => 75000,
                'stock' => 60,
                'image' => 'toner.png',
                'description' => 'Menyegarkan dan menyeimbangkan pH kulit'
            ],
            [
                'id' => 4,
                'name' => 'Moisturizer',
                'category' => 'skincare',
                'price' => 90000,
                'stock' => 25,
                'image' => 'moist.png',
                'description' => 'Melembabkan kulit sepanjang hari'
            ],
            [
                'id' => 5,
                'name' => 'Facial Wash',
                'category' => 'skincare',
                'price' => 65000,
                'stock' => 40,
                'image' => 'facial wash.png',
                'description' => 'Membersihkan wajah tanpa membuat kering'
            ],
            [
                'id' => 6,
                'name' => 'Sheet Mask',
                'category' => 'skincare',
                'price' => 25000,
                'stock' => 100,
                'image' => 'sheet mask.png',
                'description' => 'Masker wajah sekali pakai'
            ],
            [
                'id' => 7,
                'name' => 'Lip Matte',
                'category' => 'makeup',
                'price' => 55000,
                'stock' => 35,
                'image' => 'lip matte.png',
                'description' => 'Lipstik matte tahan lama'
            ],
            [
                'id' => 8,
                'name' => 'Eyeliner',
                'category' => 'makeup',
                'price' => 45000,
                'stock' => 50,
                'image' => 'eyliner.png',
                'description' => 'Eyeliner waterproof'
            ],
            [
                'id' => 9,
                'name' => 'Foundation',
                'category' => 'makeup',
                'price' => 120000,
                'stock' => 20,
                'image' => 'fondi.png',
                'description' => 'Foundation full coverage'
            ],
            [
                'id' => 10,
                'name' => 'Blush On',
                'category' => 'makeup',
                'price' => 65000,
                'stock' => 45,
                'image' => 'blus on.png',
                'description' => 'Blush on natural'
            ],
            [
                'id' => 11,
                'name' => 'Eyeshadow',
                'category' => 'makeup',
                'price' => 85000,
                'stock' => 30,
                'image' => 'eyes shedow.png',
                'description' => 'Palet eyeshadow warna-warni'
            ],
            [
                'id' => 12,
                'name' => 'Highlighter',
                'category' => 'makeup',
                'price' => 75000,
                'stock' => 40,
                'image' => 'higlatter.png',
                'description' => 'Highlighter glowing natural'
            ]
        ];

        foreach ($products as $product):
        ?>
        <div class="col-lg-3 col-md-4 col-sm-6 mb-4 product-item" data-category="<?php echo $product['category']; ?>">
            <div class="card h-100 product-card">
                <!-- Image -->
                <div class="card-img-top text-center p-3" style="height: 200px; background: #f8f9fa;">
                    <img src="../images/<?php echo $product['image']; ?>" 
                         alt="<?php echo htmlspecialchars($product['name']); ?>"
                         class="img-fluid" style="max-height: 150px; object-fit: contain;">
                </div>
                
                <!-- Card Body -->
                <div class="card-body">
                    <!-- Category Badge -->
                    <div class="mb-2">
                        <span class="badge <?php echo $product['category'] == 'skincare' ? 'bg-info' : 'bg-warning'; ?>">
                            <?php echo ucfirst($product['category']); ?>
                        </span>
                    </div>
                    
                    <!-- Product Name -->
                    <h5 class="card-title"><?php echo htmlspecialchars($product['name']); ?></h5>
                    
                    <!-- Description -->
                    <p class="card-text text-muted small">
                        <?php echo htmlspecialchars($product['description']); ?>
                    </p>
                    
                    <!-- Price -->
                    <h4 class="text-primary">
                        Rp <?php echo number_format($product['price'], 0, ',', '.'); ?>
                    </h4>
                    
                    <!-- Stock -->
                    <p class="small mb-3">
                        <i class="fas fa-box"></i> Stok: 
                        <span class="<?php echo $product['stock'] > 20 ? 'text-success' : 
                                               ($product['stock'] > 5 ? 'text-warning' : 'text-danger'); ?>">
                            <?php echo $product['stock']; ?> pcs
                        </span>
                    </p>
                </div>
                
                <!-- Card Footer -->
                <div class="card-footer bg-white border-top-0">
                    <div class="d-grid gap-2">
                        <button class="btn btn-primary btn-add-to-cart" 
                                data-id="<?php echo $product['id']; ?>"
                                data-name="<?php echo htmlspecialchars($product['name']); ?>"
                                data-price="<?php echo $product['price']; ?>">
                            <i class="fas fa-shopping-cart"></i> Tambah ke Keranjang
                        </button>
                        <a href="#" class="btn btn-outline-secondary">
                            <i class="fas fa-info-circle"></i> Detail
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <?php endforeach; ?>
    </div>
</div>

<!-- Success Modal -->
<div class="modal fade" id="successModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Sukses!</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <p>Produk berhasil ditambahkan ke keranjang!</p>
            </div>
        </div>
    </div>
</div>

<?php
$custom_css = "
<style>
.product-card {
    transition: transform 0.3s, box-shadow 0.3s;
    border: 1px solid #eaeaea;
}
.product-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 5px 15px rgba(0,0,0,0.1);
}
.card-img-top {
    border-bottom: 1px solid #eaeaea;
}
</style>
";

$custom_js = "
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Category filter
    const filterButtons = document.querySelectorAll('[data-filter]');
    const productItems = document.querySelectorAll('.product-item');
    
    filterButtons.forEach(button => {
        button.addEventListener('click', function() {
            // Update active button
            filterButtons.forEach(btn => btn.classList.remove('active'));
            this.classList.add('active');
            
            const filter = this.getAttribute('data-filter');
            
            // Filter products
            productItems.forEach(item => {
                if (filter === 'all' || item.getAttribute('data-category') === filter) {
                    item.style.display = 'block';
                } else {
                    item.style.display = 'none';
                }
            });
        });
    });
    
    // Add to cart functionality
    const addToCartButtons = document.querySelectorAll('.btn-add-to-cart');
    const successModal = new bootstrap.Modal(document.getElementById('successModal'));
    
    addToCartButtons.forEach(button => {
        button.addEventListener('click', function() {
            const productId = this.getAttribute('data-id');
            const productName = this.getAttribute('data-name');
            const productPrice = this.getAttribute('data-price');
            
            // Show success message
            const modalBody = document.querySelector('#successModal .modal-body');
            modalBody.innerHTML = `Produk <strong>\${productName}</strong> (Rp \${parseInt(productPrice).toLocaleString('id-ID')}) berhasil ditambahkan ke keranjang!`;
            successModal.show();
            
            // Update cart count (simulated)
            const cartCount = document.getElementById('cartCount');
            if (cartCount) {
                let count = parseInt(cartCount.textContent) || 0;
                cartCount.textContent = count + 1;
            }
        });
    });
});
</script>
";

require_once '../layouts/footer.php';
?>