<?php
$title = 'Beauty Store - Home';
require_once '../layouts/header.php';
?>

<!-- Hero Section -->
<section class="hero-section bg-gradient-primary text-white py-5">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-6">
                <h1 class="display-4 fw-bold">Temukan Kecantikan Sejatimu</h1>
                <p class="lead">Koleksi skincare dan makeup terbaik dengan kualitas premium untuk kulit sehat dan cantik alami.</p>
                <a href="products.php" class="btn btn-light btn-lg mt-3">
                    <i class="fas fa-shopping-bag"></i> Belanja Sekarang
                </a>
            </div>
            <div class="col-md-6 text-center">
                <img src="../images/sunscreen.png" alt="Beauty Products" class="img-fluid rounded shadow" style="max-height: 300px;">
            </div>
        </div>
    </div>
</section>

<!-- Featured Products -->
<section class="py-5">
    <div class="container">
        <h2 class="text-center mb-5">Produk Unggulan</h2>
        <div class="row">
            <?php
            $featured_products = [
                ['sunscreen.png', 'Sunscreen SPF 50', 'Rp 85.000'],
                ['serum.png', 'Serum Vitamin C', 'Rp 125.000'],
                ['toner.png', 'Toner', 'Rp 75.000'],
                ['moist.png', 'Moisturizer', 'Rp 90.000']
            ];
            
            foreach ($featured_products as $product):
            ?>
            <div class="col-md-3 col-sm-6 mb-4">
                <div class="card text-center h-100">
                    <div class="card-img-top p-3" style="height: 200px; background: #f8f9fa;">
                        <img src="../images/<?php echo $product[0]; ?>" 
                             alt="<?php echo $product[1]; ?>" 
                             class="img-fluid" style="max-height: 150px; object-fit: contain;">
                    </div>
                    <div class="card-body">
                        <h5 class="card-title"><?php echo $product[1]; ?></h5>
                        <p class="text-primary fw-bold"><?php echo $product[2]; ?></p>
                        <a href="products.php" class="btn btn-outline-primary">Lihat Detail</a>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<?php require_once '../layouts/footer.php'; ?>